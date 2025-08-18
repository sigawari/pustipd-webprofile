<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InformasiTerkini\KelolaPengumuman;
use Carbon\Carbon;

class ArchiveExpiredAnnouncements extends Command
{
    protected $signature = 'announcements:archive';
    protected $description = 'Archive expired announcements based on valid_until date';

    public function handle()
    {
        $now = Carbon::now();
        $this->info("Current time: {$now}");

        // Debug: Lihat semua pengumuman published
        $publishedCount = KelolaPengumuman::where('status', 'published')->count();
        $this->info("Total published announcements: {$publishedCount}");

        // Debug: Lihat yang punya valid_until
        $withValidUntil = KelolaPengumuman::where('status', 'published')
            ->whereNotNull('valid_until')
            ->count();
        $this->info("Published with valid_until: {$withValidUntil}");

        // Cari yang expired
        $expiredAnnouncements = KelolaPengumuman::where('status', 'published')
            ->whereNotNull('valid_until')
            ->where('valid_until', '<', $now)
            ->get();

        if ($expiredAnnouncements->isEmpty()) {
            $this->info("Tidak ada pengumuman expired ditemukan pada: {$now}");
            
            // Debug: Tampilkan beberapa tanggal valid_until untuk referensi
            $samples = KelolaPengumuman::where('status', 'published')
                ->whereNotNull('valid_until')
                ->limit(3)
                ->get(['title', 'valid_until']);
            
            foreach ($samples as $sample) {
                $this->info("Sample: {$sample->title} - expires: {$sample->valid_until}");
            }
            
            return 0;
        }

        $count = 0;
        foreach ($expiredAnnouncements as $announcement) {
            $this->info("Archiving: {$announcement->title} (expired: {$announcement->valid_until})");
            $announcement->update(['status' => 'archived']);
            $count++;
        }

        $this->info("Successfully archived {$count} expired announcements.");
        return 0;
    }
}
