<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publics;
use App\Http\Requests\StorePublicsRequest;
use App\Http\Requests\UpdatePublicsRequest;
use App\Models\Announcement;

class PublicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    if ($request->is('about')) {
        $title = 'Tentang PUSTIPD';
        $description = 'Apa itu PUSTIPD UIN Raden Fatah Palembang dan apa saja yang kami lakukan.';
        $keywords = 'tentang, news, pustipd';

        return view('public.about', compact('title', 'description', 'keywords'));
    }
    if ($request->is('berita')) {
        $title = 'Berita';
        $description = 'Semua berita terbaru PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'berita, news, pustipd';

        return view('public.news', compact('title', 'description', 'keywords'));
    }

    if ($request->is('pengumuman')) {
        $title = 'Pengumuman';
        $description = 'Semua pengumuman terbaru PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'pengumuman, announcements, pustipd';

        $announcements = Announcement::orderBy('date', 'desc')->paginate(12);

        return view('public.announcements', compact('title', 'description', 'keywords', 'announcements'));
    }

    // Default untuk beranda
    $title = 'Beranda';
    $description = 'Selamat datang di Website PUSTIPD UIN Raden Fatah Palembang';
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
        // Example implementation: Save the data from the request
        Publics::create($request->validated());
    }

    /**
     * Display the specified resource.
    public function show(Publics $publics)
    {
        // Example implementation: Return the specified resource
        return view('public.show', compact('publics'));
    }
    }

    /**
    public function edit(Publics $publics)
    {
        // Example implementation: Return the edit form for the specified resource
        return view('public.edit', compact('publics'));
    }
        //
    }

    public function update(UpdatePublicsRequest $request, Publics $publics)
    {
        // Example implementation: Update the specified resource
        $publics->update($request->validated());
        return redirect()->route('publics.index');
    }
    {
        //
    public function destroy(Publics $publics)
    {
        // Example implementation: Delete the specified resource
        $publics->delete();
        return redirect()->route('publics.index');
    }
     */
    public function destroy(Publics $publics)
    {
        //
    }
}
