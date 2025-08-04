<?php

namespace App\Http\Controllers\admin\ManageContent\Dokumen;

use App\Models\Sop;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSopRequest;
use App\Http\Requests\UpdateSopRequest;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "SOP";

        return view('admin.manage-content.dokumen.sop.sop', compact('title'));
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
    public function store(StoreSopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sop $sop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sop $sop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSopRequest $request, Ketetapan $sop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sop $sop)
    {
        //
    }
}
