<?php

namespace App\Http\Controllers\admin\Sistem;

use App\Models\Sistem\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Pengguna';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $adminQuery = User::where('role', 'admin');
        $user_publicQuery = User::where('role', 'user_public');
        
        // Apply search jika ada
        if ($search){
            $adminQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word){
                    $q->where(function ($q) use ($word){
                        $q->where('name', 'Like', "%{$word}%")
                        ->orWhere('email', 'Like', "%{$word}%");
                    });
                }
            });
            $user_publicQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word){
                    $q->where(function ($q) use ($word){
                        $q->where('name', 'Like', "%{$word}%")
                        ->orWhere('email', 'Like', "%{$word}%");
                    });
                }
            });
        }

        // Ambil data sesuai filter
        if ($filter == 'admin'){
            $admins = $adminQuery->get();
            $user_publics = collect(); // Kosong
        } elseif ($filter == 'user_public'){
            $admins = collect(); // Kosong
            $user_publics = $user_publicQuery->get();
        } else { // All
            $admins = $adminQuery->get();
            $user_publics = $user_publicQuery->get();
        }

        // Merge + Pagination
        $merged = $admins->concat($user_publics);

        // Tentukan halaman sekarang dulu
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Kalau perPage 'all', set ke total
        if ($perPage === 'all') {
            $perPage = $merged->count();
        }

        // Minimal 1
        $perPage = max(1, (int) $perPage);

        if ($merged->isEmpty()) {
            // Paginator kosong
            $users = new LengthAwarePaginator([], 0, $perPage, $currentPage, [
                'path' => request()->url(),
                'query' => request()->query(),
            ]);
        } else {
            $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

            // ⚡ Kalau hasil slice kosong → total = 0
            $total = $currentItems->isEmpty() ? 0 : $merged->count();

            $users = new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
                'path' => request()->url(),
                'query' => request()->query(),
            ]);
        }

        // AJAX response
        if ($request->ajax()){
            return view('admin.Sistem.Manage-users.partials.table_body', compact('title', 'admins', 'user_publics', 'users', 'keywords', 'filter'))->render();
        }

        // View Utama
        return view('admin.Sistem.Manage-users.index', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // uncomment untuk debug

        // Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,user_public',
            'password' => 'required|string|min:8',
        ]);

        // Ambil nama depan dari inputan name
        $firstName = strtolower(strtok($request->name, " "));
        $role = $request->role;

        // Buat Email secara otomatis
        $email = "{$firstName}.{$role}@pustipd.radenfatah.ac.id";

        // Validasi agar email juga unik
        if (User::where('email', $email)->exists()){
            return back()->withErrors(['email' => 'Email otomatis sudah digunakan. Silakan ubah nama atau role.'])->withInput();
        }

        // Simpan ke DB users
        User::create([
            'name' => $request->name,
            'email' => $email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman Manage User
        return redirect()->route('admin.sistem.manage-users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // dd($request->all()); // uncomment untuk debug
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all()); // uncomment untuk debug
        // Cari data berdasarkan ID
        $user = User::findOrFail($id);
        // Jika data tidak ditemukan, maka akan menampilkan pesan error
        if (!$user) {
            return back()->withErrors(['user' => 'Pengguna tidak ditemukan.'])->with('error', 'Data tidak ditemukan.');
        }

        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|in:admin,user_public',
            'password' => 'nullable|string|min:8',
        ]);
        
        // Ambil nama depan & generate ulang email
        $firstName = strtolower(strtok($request->name, " "));
        $role = $request->role;
        
        // Buat Ulang Email secara otomatis
        $email = "{$firstName}.{$role}@pustipd.radenfatah.ac.id";

        // Cek jika email sudah dipakai oleh user lain
        if (User::where('email', $email)->exists()){
            return back()->withErrors(['email' => 'Email otomatis sudah digunakan. Silakan ubah nama atau role.'])->withInput();
        }

        // Update data
        $user->name = $request->name;
        $user->role = $request->role;

        // Optional: Auto-generate email (kalau kamu gak ambil dari input)
        $firstName = strtolower(strtok($request->name, ' '));
        $user->email = $firstName . '.' . $request->role . '@pustipd.radenfatah.ac.id';

        // Password hanya diubah kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.sistem.manage-users.index')->with('success', 'Data pengguna berhasil diperbaharui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id); // uncomment untuk debug
        // Cari data berdasarkan ID
        $user = User::findOrFail($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$user) {
            return redirect()->route('admin.sistem.manage-users.index')->with('error', 'Data tidak ditemukan.');
        }
        // Hapus data Pengguna
        $user->delete();
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.sistem.manage-users.index')->with('success', 'Data berhasil dihapus.');
    }
}
