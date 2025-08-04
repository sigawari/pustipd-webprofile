<?php

namespace App\Http\Controllers\admin\ManageContent\Dokumen;

use App\Models\Panduan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePanduanRequest;
use App\Http\Requests\UpdatePanduanRequest;

class PanduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Panduan";

        return view('admin.manage-content.dokumen.panduan.panduan', compact('title'));
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
    public function store(StorePanduanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Panduan $panduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panduan $panduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePanduanRequest $request, Ketetapan $panduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panduan $panduan)
    {
        //
    }
}
