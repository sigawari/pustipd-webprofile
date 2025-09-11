<?php

namespace App\Exports;

use App\Models\InformasiTerkini\KelolaTutorial;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class TutorialExport
{
    protected $status;
    protected $category;
    protected $is_featured;
    protected $search;

    public function __construct($status = null, $category = null, $is_featured = null, $search = null)
    {
        $this->status     = $status;
        $this->category   = $category;
        $this->is_featured = $is_featured;
        $this->search     = $search;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-kelola-tutorial.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // 🔧 Query KelolaTutorial
        $query = KelolaTutorial::select('id', 'title', 'excerpt', 'category', 'date', 'status', 'content_blocks')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            })
            ->when($this->category && $this->category !== '', function ($q) {
                $q->where('category', $this->category);
            });

        // 🔍 Filter search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('title', 'like', "%{$word}%")
                        ->orWhere('excerpt', 'like', "%{$word}%")
                        ->orWhere('category', 'like', "%{$word}%");
                }
            });
        }

        $tutorials = $query->orderBy('id', 'asc')->get();

        // dd($tutorials);

        // Hitung total data
        $totalTutorial = $tutorials->count();
        $now           = Carbon::now();

        // Tuliskan summary
        $sheet->setCellValue('D26', $totalTutorial); // Total Tutorial
        $sheet->setCellValue('D27', $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Isi data ke spreadsheet
        $startRow = 9; // Mulai dari baris 9
        foreach ($tutorials as $index => $tutorial) {
            $row = $startRow + $index;

            // Hitung jumlah langkah & tips dari content_blocks
            $contentBlocks = collect($tutorial->content_blocks ?? []);
            $steps = $contentBlocks->where('type', 'step')->count();
            $tips  = $contentBlocks->where('type', 'tip')->count();

            // Excerpt dengan fallback
            $excerpt = $tutorial->excerpt;
            if (!$excerpt) {
                if ($tutorial->content_blocks && count($tutorial->content_blocks) > 0) {
                    $firstBlock = collect($tutorial->content_blocks)->first();
                    if (isset($firstBlock['title'])) {
                        $excerpt = $firstBlock['title'];
                    } elseif (isset($firstBlock['content'])) {
                        $excerpt = strip_tags($firstBlock['content']);
                    }
                } elseif ($tutorial->content) {
                    $excerpt = strip_tags($tutorial->content);
                } else {
                    $excerpt = 'Tidak ada konten';
                }
            }

            $sheet->setCellValueExplicit('B' . $row, $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValueExplicit('C' . $row, $tutorial->title ?? '-', DataType::TYPE_STRING); // Title
            $sheet->setCellValueExplicit('D' . $row, $excerpt, DataType::TYPE_STRING); // Excerpt
            $sheet->setCellValueExplicit('E' . $row, $tutorial->category ?? '-', DataType::TYPE_STRING); // Category
            $sheet->setCellValueExplicit('F' . $row, $steps > 0 ? $steps . ' langkah' : '-', DataType::TYPE_STRING); // Langkah
            $sheet->setCellValueExplicit('G' . $row, $tips > 0 ? $tips . ' tips' : '-', DataType::TYPE_STRING); // Tips
            $sheet->setCellValueExplicit('H' . $row, $tutorial->date ? Carbon::parse($tutorial->date)->format('d-m-Y') : '-', DataType::TYPE_STRING); // Date
            $sheet->setCellValueExplicit('I' . $row, ucfirst($tutorial->status ?? '-'), DataType::TYPE_STRING); // Status
        }


        // Simpan ke file sementara
        $exportDir = storage_path('app/public/exports');
        if (!File::exists($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['kelola-tutorial'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = 'status-' . strtolower($this->status);
        }
        if ($this->category && $this->category !== '') {
            $fileNameParts[] = 'category-' . strtolower($this->category);
        }
        if ($this->search) {
            $fileNameParts[] = 'search-' . preg_replace('/\s+/', '_', strtolower($this->search));
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');
        $fileName       = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $exportDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
