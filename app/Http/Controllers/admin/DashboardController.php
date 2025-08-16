<?php

namespace App\Http\Controllers\admin;

use App\Models\Dashboard;
use App\Models\Dokumen\Sop;
use Illuminate\Http\Request;
use App\Models\Dokumen\Panduan;
use App\Models\Dokumen\Regulasi;
use App\Models\Dokumen\Ketetapan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\InformasiTerkini\KelolaBerita;
use App\Models\InformasiTerkini\KelolaPengumuman;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';

        // Total
        $totalBerita = KelolaBerita::count();
        $totalKetetapan = Ketetapan::count();
        $totalRegulasi = Regulasi::count();
        $totalPanduan = Panduan::count();
        $totalSop = Sop::count();
        // Total Dokumen
        $totalDokumen = Panduan::count() + Regulasi::count() + Ketetapan::count() + Sop::count();
        $totalPengumuman = KelolaPengumuman::count();

        return view('admin.dashboard', compact('title', 'totalBerita', 'totalKetetapan', 'totalRegulasi', 'totalPanduan', 'totalSop', 'totalPengumuman', 'totalDokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
