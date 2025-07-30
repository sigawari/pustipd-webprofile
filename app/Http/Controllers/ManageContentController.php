<?php

namespace App\Http\Controllers;

use App\Models\ManageContent;
use App\Http\Requests\StoreManageContentRequest;
use App\Http\Requests\UpdateManageContentRequest;
use Illuminate\Http\Request;

class ManageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.manage-content.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManageContentRequest $request)
    {
        // Implementation for storing content
        return redirect()->route('admin.manage-content.index')->with('success', 'Content created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageContent $manageContent)
    {
        return view('admin.manage-content.show', compact('manageContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageContent $manageContent)
    {
        return view('admin.manage-content.edit', compact('manageContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManageContentRequest $request, ManageContent $manageContent)
    {
        // Implementation for updating content
        return redirect()->route('admin.manage-content.index')->with('success', 'Content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageContent $manageContent)
    {
        // Implementation for deleting content
        return redirect()->route('admin.manage-content.index')->with('success', 'Content deleted successfully');
    }

    // === CUSTOM METHODS UNTUK ABOUT SECTION ===
    
    public function aboutProfile()
    {
        return view('admin.manage-content.about.profile');
    }
    
    public function aboutVisionMission()
    {
        return view('admin.manage-content.about.vision-mission');
    }
    
    public function aboutOrganization()
    {
        return view('admin.manage-content.about.organization');
    }

    // === CUSTOM METHODS UNTUK CONTENT LAINNYA ===
    
    public function hero()
    {
        return view('admin.manage-content.hero');
    }
    
    public function news()
    {
        return view('admin.manage-content.news');
    }
    
    public function announcements()
    {
        return view('admin.manage-content.announcements');
    }
    
    public function tutorials()
    {
        return view('admin.manage-content.tutorials');
    }
    
    public function faq()
    {
        return view('admin.manage-content.faq');
    }
}
