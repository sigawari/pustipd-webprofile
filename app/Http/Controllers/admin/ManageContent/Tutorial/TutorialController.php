<?php

namespace App\Http\Controllers\admin\ManageContent\Tutorial;

use App\Models\Tutorial;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTutorialRequest;
use App\Http\Requests\UpdateTutorialRequest;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Tutorial";

        return view('admin.manage-content.tutorial.kelolatutorial', compact('title'));
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
    public function store(StoreTutorialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutorial $kelolatutorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tutorial $kelolatutorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTutorialRequest $request, Tutorial $kelolatutorial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutorial $kelolatutorial)
    {
        //
    }
}
