<?php

namespace App\Http\Controllers\admin\ManageContent\AppLayanan;

use App\Models\AppLayanan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppLayananRequest;
use App\Http\Requests\UpdateAppLayananRequest;

class AppLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "AppLayanan";

        return view('admin.manage-content.layanan.applayanan', compact('title'));
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
    public function store(StoreAppLayananRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AppLayanan $appLayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppLayanan $applayanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppLayananRequest $request, AppLayanan $applayanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        //
    }
}
