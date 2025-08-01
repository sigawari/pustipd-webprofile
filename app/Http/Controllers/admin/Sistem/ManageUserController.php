<?php

namespace App\Http\Controllers\admin\Sistem;

use App\Models\Sistem\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengguna';
        $users = User::paginate(10);
        return view('admin.manage-users.index', compact('title', 'users'));
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
            'role' => 'required|string|in:admin,user',
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
        return redirect()->route('admin.sistem.users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
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
            'role' => 'required|string|in:admin,user',
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
        return redirect()->route('admin.sistem.users.index')->with('success', 'Data pengguna berhasil diperbaharui.');

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
            return redirect()->route('admin.sistem.users.index')->with('error', 'Data tidak ditemukan.');
        }
        // Hapus data Pengguna
        $user->delete();
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.sistem.users.index')->with('success', 'Data berhasil dihapus.');
    }
}
