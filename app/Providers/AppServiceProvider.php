<?php

namespace App\Providers;

use App\Models\TentangKami\Profil;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register admin components
        Blade::componentNamespace('App\\View\\Components\\Admin', 'admin');

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('announcements:archive')->everyMinute();
        });

        // Safety check: hanya load data jika tabel ada
        $footerData = null;
        try {
            if (Schema::hasTable('profils')) {
                $footerData = Profil::latest()->first();
            }
        } catch (\Exception $e) {
            // Log error atau handle gracefully
            \Log::info('Profils table not available: ' . $e->getMessage());
        }

        // Share variable ke seluruh view
        View::share('footerData', [
            // Alamat
            'address' => $footerData->address ?? 'Gedung Perpustakaan Lt. 4, Jl. Pangeran Ratu (Jakabaring), Kelurahan 5 Ulu, Kecamatan Seberang Ulu I, Kota Palembang, Sumatera Selatan 30267, Indonesia.',
            
            // Sosmed - Parsing URL saja
            'social_media' => [
                'instagram_url' => $footerData->instagram_url ?? null,
                'facebook_url' => $footerData->facebook_url ?? null,
                'youtube_url' => $footerData->youtube_url ?? null,
                'email' => $footerData->email ?? null,
            ],
            
            // Aplikasi
            'applications' => [
                'title' => 'Aplikasi',
                'items' => $footerData->applications ?? []
            ],
            
            // Universitas/fakultas
            'faculties' => [
                'title' => 'Universitas',
                'items' => $footerData->universities ?? []
            ],
            
            // Lembaga
            'institutions' => [
                'title' => 'Lembaga',
                'items' => $footerData->institutions ?? []
            ],
            
            // Footer Bottom
            'copyright' => '© PUSTIPD UIN RF Palembang 2025. All Rights Reserved',
            'attribution' => 'Made with',
            'developer' => 'by PUSTIPD UIN RF Palembang'
        ]);
    }

    public function register()
    {
        //
    }
}
