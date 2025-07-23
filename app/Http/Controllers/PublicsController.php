<?php

namespace App\Http\Controllers;

use App\Models\Publics;
use App\Http\Requests\StorePublicsRequest;
use App\Http\Requests\UpdatePublicsRequest;

class PublicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home Page';
        $description = 'Welcome to the home page of our application.';
        $keywords = 'home, welcome, application';

        return view('public.homepage', compact('title', 'description', 'keywords'));
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
    public function store(StorePublicsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Publics $publics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publics $publics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicsRequest $request, Publics $publics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publics $publics)
    {
        //
    }
}
