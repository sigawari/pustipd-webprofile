<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Dashboard;
use App\Models\Dokumen\Sop;
use Illuminate\Http\Request;
use App\Models\Dokumen\Panduan;
use App\Models\Dokumen\Regulasi;
use App\Models\Dokumen\Ketetapan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// Add other content models as needed
// use App\Models\Tutorial;
// use App\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use App\Models\InformasiTerkini\KelolaBerita;
use App\Models\InformasiTerkini\KelolaTutorial;
use App\Models\InformasiTerkini\KelolaPengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        // Total counts
        $totalBerita = KelolaBerita::count();
        $totalKetetapan = Ketetapan::count();
        $totalRegulasi = Regulasi::count();
        $totalPanduan = Panduan::count();
        $totalSop = Sop::count();
        $totalDokumen = $totalPanduan + $totalRegulasi + $totalKetetapan + $totalSop;
        
        // Only count published announcements
        $totalPengumuman = KelolaPengumuman::where('status', 'published')->count();

        // Real-time statistics
        $beritaMingguan = KelolaBerita::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $dokumenBaru = collect([
            Panduan::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            Regulasi::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            Ketetapan::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            Sop::where('created_at', '>=', Carbon::now()->subWeek())->count()
        ])->sum();

        $pengumumanUrgent = KelolaPengumuman::where('status', 'published')
                                          ->where(function($query) {
                                              $query->where('urgency', 'penting')
                                                    ->orWhere('is_priority', true);
                                          })
                                          ->count();

        // Content status - includes all content types with status
        $contentStatus = [
            'draft' => $this->getTotalContentByStatus('draft'),
            'published' => $this->getTotalContentByStatus('published'),
            'scheduled' => $this->getTotalContentByStatus('scheduled')
        ];

        // Recent activities
        $recentActivities = $this->getRecentActivities();

        $visitorsToday = 1284; 
        $visitorsGrowth = '+15.3%';

        // System health (you can integrate with actual system monitoring)
        $systemHealth = [
            'database' => $this->checkDatabaseHealth(),
            'server' => 'Normal',
            'storage' => $this->getStorageUsage(),
            'backup' => $this->getLastBackupStatus()
        ];

        return view('admin.dashboard', compact(
            'title',
            'totalBerita',
            'totalKetetapan', 
            'totalRegulasi',
            'totalPanduan',
            'totalSop',
            'totalPengumuman',
            'totalDokumen',
            'beritaMingguan',
            'dokumenBaru',
            'pengumumanUrgent',
            'contentStatus',
            'recentActivities',
            'visitorsToday',
            'visitorsGrowth',
            'systemHealth'
        ));
    }

    /**
     * Get total content by status across all content types
     */
    /**
 * Get total content by status across all content types
 */
    private function getTotalContentByStatus($status)
    {
        $total = 0;
        
        // Berita
        $total += KelolaBerita::where('status', $status)->count();
        
        // Pengumuman - with special handling for scheduled
        if ($status === 'scheduled') {
            // For announcements, "scheduled" means published with valid_until in the future
            $total += KelolaPengumuman::where('status', 'published')
                                    ->whereNotNull('valid_until')
                                    ->where('valid_until', '>=', now())
                                    ->count();
        } else {
            // For draft and published, use regular status check
            if ($status === 'published') {
                // Published announcements are those that are published AND either have no valid_until 
                // OR valid_until is in the future (still active)
                $total += KelolaPengumuman::where('status', 'published')
                                        ->where(function($query) {
                                            $query->whereNull('valid_until')
                                                ->orWhere('valid_until', '>=', now());
                                        })
                                        ->count();
            } else {
                // For draft status
                $total += KelolaPengumuman::where('status', $status)->count();
            }
        }
        
            if (class_exists('\App\Models\Tutorial')) {
            $total += KelolaTutorial::where('status', $status)->count();
        }
        
        // FAQ (if exists)
        if (class_exists('\App\Models\FAQ')) {
            $total += Faq::where('status', $status)->count();
        }
        
        return $total;
    }


    /**
     * Get recent activities
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Recent news
        $recentNews = KelolaBerita::latest()->limit(2)->get();
        foreach ($recentNews as $news) {
            $activities[] = [
                'type' => 'news',
                'message' => 'Berita "' . \Str::limit($news->name, 30) . '" dipublish',
                'time' => $news->created_at->diffForHumans(),
                'color' => 'blue'
            ];
        }

        // Recent announcements (only published)
        $recentAnnouncements = KelolaPengumuman::where('status', 'published')
                                              ->latest()
                                              ->limit(2)
                                              ->get();
        foreach ($recentAnnouncements as $announcement) {
            $activities[] = [
                'type' => 'announcement',
                'message' => 'Pengumuman "' . \Str::limit($announcement->title, 30) . '" diperbarui',
                'time' => $announcement->updated_at->diffForHumans(),
                'color' => 'yellow'
            ];
        }

        // Recent documents
        $recentDocs = collect();
        $recentDocs = $recentDocs->merge(Panduan::latest()->limit(1)->get()->map(function($item) {
            return ['type' => 'Panduan', 'title' => $item->judul, 'created_at' => $item->created_at];
        }));
        
        foreach ($recentDocs as $doc) {
            $activities[] = [
                'type' => 'document',
                'message' => $doc['type'] . ' "' . \Str::limit($doc['title'], 30) . '" ditambahkan',
                'time' => $doc['created_at']->diffForHumans(),
                'color' => 'green'
            ];
        }

        // Sort by time and limit to 4 most recent
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 4);
    }

    /**
     * Check database health
     */
    private function checkDatabaseHealth()
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'Online', 'color' => 'green'];
        } catch (\Exception $e) {
            return ['status' => 'Offline', 'color' => 'red'];
        }
    }

    /**
     * Get storage usage percentage
     */
    private function getStorageUsage()
    {
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;
        $percentage = round(($usedSpace / $totalSpace) * 100);
        
        $color = 'green';
        if ($percentage > 80) $color = 'red';
        elseif ($percentage > 60) $color = 'yellow';
        
        return ['percentage' => $percentage . '%', 'color' => $color];
    }

    /**
     * Get last backup status
     */
    private function getLastBackupStatus()
    {
        // Replace with actual backup monitoring
        return ['status' => 'Updated', 'color' => 'green', 'time' => '5 jam yang lalu'];
    }

    /**
     * AJAX method for real-time updates
     */
    public function getRealTimeData()
    {
        return response()->json([
            'totalBerita' => KelolaBerita::count(),
            'totalDokumen' => Panduan::count() + Regulasi::count() + Ketetapan::count() + Sop::count(),
            'totalPengumuman' => KelolaPengumuman::where('status', 'published')->count(),
            'visitorsToday' => rand(1200, 1400),
            'recentActivities' => $this->getRecentActivities(),
            'systemHealth' => [
                'database' => $this->checkDatabaseHealth(),
                'storage' => $this->getStorageUsage()
            ],
            'contentStatus' => [
                'draft' => $this->getTotalContentByStatus('draft'),
                'published' => $this->getTotalContentByStatus('published'),
                'scheduled' => $this->getTotalContentByStatus('scheduled')
            ]
        ]);
    }
}
