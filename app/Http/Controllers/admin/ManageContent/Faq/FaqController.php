<?php

namespace App\Http\Controllers\admin\ManageContent\Faq;

use App\Http\Controllers\Controller;
use App\Models\ManageContent\Faq;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "FAQ";

        return view('admin.manage-content.faq.faq', compact('title'));
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
    public function store(Faq $faq)
    {
        $validated = $faq->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:draft,published,archived'
        ]);

        Faq::create($validated);

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Faq $faq, Faq $faq)
    {
        $validated = $faq->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:draft,published,archived'
        ]);

        $faq->update($validated);

        return redirect()->back()->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ berhasil dihapus!');
    }
}