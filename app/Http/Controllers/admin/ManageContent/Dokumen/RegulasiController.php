<?php

namespace App\Http\Controllers\admin\ManageContent\Dokumen;

use App\Models\Regulasi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegulasiRequest;
use App\Http\Requests\UpdateRegulasiRequest;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Regulasi";

        return view('admin.manage-content.dokumen.regulasi.regulasi', compact('title'));
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
    public function store(StoreRegulasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Regulasi $regulasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regulasi $regulasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegulasiRequest $request, Ketetapan $regulasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulasi $regulasi)
    {
        //
    }
}
