<?php

namespace App\Http\Controllers\admin\ManageContent\Tentang;

use App\Models\ManageContent\AboutUs\VisiMisi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisiMisiRequest;
use App\Http\Requests\UpdateVisiMisiRequest;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Visi Misi';

        return view('admin.manage-content.tentang.visi-misi.visi-misi', compact('title'));
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
    public function store(StoreVisiMisiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisiMisiRequest $request, VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        //
    }
}
