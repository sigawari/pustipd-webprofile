<?php

namespace App\Http\Controllers\admin\ManageContent\Pengumuman;

use App\Models\Pengumuman;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pengumuman";

        return view('admin.manage-content.pengumuman.kelolapengumuman', compact('title'));
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
    public function store(StorePengumumanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $kelolapengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $kelolapengumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengumumanRequest $request, Pengumuman $kelolapengumuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $kelolapengumuman)
    {
        //
    }
}
