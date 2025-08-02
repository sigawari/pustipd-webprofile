<?php

namespace App\Http\Controllers\admin\ManageContent\Beranda;

use App\Models\Pencapaian;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePencapaianRequest;
use App\Http\Requests\UpdatePencapaianRequest;

class PencapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kelola Pencapaian';
        // $pageData = [
        //     'title' => 'Kelola Pencapaian',
        //     'pageName' => 'Beranda', // Untuk breadcrumb
        //     'description' => 'Kelola konten pencapaian yang ditampilkan di beranda website',
        //     'breadcrumbs' => [
        //         ['name' => 'Kelola Konten', 'url' => '#'],
        //         ['name' => 'Beranda', 'url' => '#'],
        //         ['name' => 'Pencapaian', 'url' => null]
        //     ]
        // ];
        
        return view('admin.manage-content.beranda.pencapaian.pencapaian', compact('title'));
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
    public function store(StorePencapaianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePencapaianRequest $request, Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pencapaian $pencapaian)
    {
        //
    }
}
