<?php

namespace App\Http\Controllers;

use App\Models\ManageContent;
use App\Http\Requests\StoreManageContentRequest;
use App\Http\Requests\UpdateManageContentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    // === CUSTOM METHODS UNTUK tentang SECTION ===
    public function tentangProfil()
    {
        // Ambil data existing jika ada
        $profileData = ManageContent::where('type', 'organization_profile')->first();
        
        return view('admin.manage-content.tentang.profil', compact('profileData'));
    }
    
    /**
     * Update organization profile data
     */
    public function tentangProfilUpdate(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
            'applications' => 'nullable|array',
            'applications.*.name' => 'required_with:applications|string',
            'applications.*.url' => 'required_with:applications|url',
            'institutions' => 'nullable|array',
            'institutions.*.name' => 'required_with:institutions|string',
            'institutions.*.url' => 'required_with:institutions|url',
            'universities' => 'nullable|array',
            'universities.*.faculty' => 'required_with:universities|string',
            'universities.*.url' => 'required_with:universities|url',
        ]);

        // Find or create organization profile
        $profileData = ManageContent::firstOrNew(['type' => 'organization_profile']);
        
        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($profileData->profile_photo && Storage::exists($profileData->profile_photo)) {
                Storage::delete($profileData->profile_photo);
            }
            
            // Store new photo
            $profileData->profile_photo = $request->file('profile_photo')->store('profile-photos', 'public');
        }
        
        // Update basic fields
        $profileData->organization_name = $request->organization_name;
        $profileData->description = $request->description;
        $profileData->address = $request->address;
        $profileData->email = $request->email;
        $profileData->instagram_url = $request->instagram_url;
        $profileData->facebook_url = $request->facebook_url;
        $profileData->youtube_url = $request->youtube_url;
        
        // Handle dynamic lists (store as JSON)
        $profileData->applications = $request->applications ? array_filter($request->applications, function($app) {
            return !empty($app['name']) && !empty($app['url']);
        }) : [];
        
        $profileData->institutions = $request->institutions ? array_filter($request->institutions, function($inst) {
            return !empty($inst['name']) && !empty($inst['url']);
        }) : [];
        
        $profileData->universities = $request->universities ? array_filter($request->universities, function($univ) {
            return !empty($univ['faculty']) && !empty($univ['url']);
        }) : [];
        
        $profileData->save();
        
        return redirect()->route('admin.manage-content.tentang.profil')
                        ->with('success', 'Profil organisasi berhasil diperbarui!');
    }
    
    /**
     * Preview organization profile
     */
    public function berandaPencapaian()
    {
        $pageData = [
            'title' => 'Kelola Pencapaian',
            'pageName' => 'Beranda', // Untuk breadcrumb
            'description' => 'Kelola konten pencapaian yang ditampilkan di beranda website',
            'breadcrumbs' => [
                ['name' => 'Kelola Konten', 'url' => '#'],
                ['name' => 'Beranda', 'url' => '#'],
                ['name' => 'Pencapaian', 'url' => null]
            ]
        ];
        
        return view('admin.manage-content.beranda.pencapaian', compact('pageData'));
    }

    public function berandaMitra()
    {
        $pageData = [
            'title' => 'Kelola Mitra',
            'pageName' => 'Beranda', // Untuk breadcrumb
            'description' => 'Kelola konten mitra yang ditampilkan di beranda website',
            'breadcrumbs' => [
                ['name' => 'Kelola Konten', 'url' => '#'],
                ['name' => 'Beranda', 'url' => '#'],
                ['name' => 'Mitra', 'url' => null]
            ]
        ];
        
        return view('admin.manage-content.beranda.mitra', compact('pageData'));
    }

    public function berandaLayanan()
    {
        $pageData = [
            'title' => 'Kelola Layanan',
            'pageName' => 'Beranda', // Untuk breadcrumb
            'description' => 'Kelola konten Layanan yang ditampilkan di beranda website',
            'breadcrumbs' => [
                ['name' => 'Kelola Konten', 'url' => '#'],
                ['name' => 'Beranda', 'url' => '#'],
                ['name' => 'Layanan', 'url' => null]
            ]
        ];
        
        return view('admin.manage-content.beranda.layanan', compact('pageData'));
    }
    
    public function tentangProfilPreview()
    {
        $profileData = ManageContent::where('type', 'organization_profile')->first();
        
        // Return view untuk preview (bisa redirect ke halaman publik website)
        return view('admin.manage-content.tentang.profil-preview', compact('profileData'));
    }
    
    public function tentangGaleri()
    {
        return view('admin.manage-content.tentang.galeri');
    }
    public function tentangVisiMisi()
    {
        return view('admin.manage-content.tentang.visi-misi');
    }
    
    public function tentangOrganisasi()
    {
        return view('admin.manage-content.tentang.organisasi');
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

    public function applayanan()
    {
        return view('admin.manage-content.layanan.applayanan');
    }
}