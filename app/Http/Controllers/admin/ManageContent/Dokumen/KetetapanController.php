<?php

namespace App\Http\Controllers\admin\ManageContent\Dokumen;

use App\Models\Ketetapan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKetetapanRequest;
use App\Http\Requests\UpdateKetetapanRequest;

class KetetapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Ketetapan";

        return view('admin.manage-content.dokumen.ketetapan.ketetapan', compact('title'));
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
    public function store(StoreKetetapanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ketetapan $ketetapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ketetapan $ketetapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKetetapanRequest $request, Ketetapan $ketetapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ketetapan $ketetapan)
    {
        //
    }
}
