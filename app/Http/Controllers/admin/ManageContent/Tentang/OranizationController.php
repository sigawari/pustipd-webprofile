<?php

namespace App\Http\Controllers\admin\ManageContent\Tentang;

use App\Models\ManageContent\AboutUs\Oranization;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOranizationRequest;
use App\Http\Requests\UpdateOranizationRequest;

class OranizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Organisasi';

        return view('admin.manage-content.tentang.organization.organization', compact('title'));
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
    public function store(StoreOranizationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Oranization $oranization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oranization $oranization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOranizationRequest $request, Oranization $oranization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oranization $oranization)
    {
        //
    }
}
