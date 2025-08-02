<?php

namespace App\Http\Controllers\admin\Sistem;

use App\Models\Sistem\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        // Cari data berdasarkan ID
        $user = User::findOrFail($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$user) {
            return redirect()->route('admin.manage-users.index')->with('error', 'Data tidak ditemukan.');
        }
        // Hapus data Pengguna
        $user->delete();
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.manage-users.index')->with('success', 'Data berhasil dihapus.');
    }
}
