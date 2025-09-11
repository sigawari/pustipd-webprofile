<?php

namespace App\Exports;

use App\Models\InformasiTerkini\KelolaPengumuman;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class PengumumanExport
{
    protected $status;
    protected $category;
    protected $search;

    public function __construct($status = null, $category = null, $search = null)
    {
        $this->status   = $status;
        $this->category = $category;
        $this->search   = $search;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-kelola-pengumuman.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // 🔧 Query KelolaPengumuman
        $query = KelolaPengumuman::select('id', 'title', 'content', 'category', 'urgency', 'date','valid_until', 'status')
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
                        ->orWhere('content', 'like', "%{$word}%")
                        ->orWhere('category', 'like', "%{$word}%");
                }
            });
        }

        $pengumumans = $query->orderBy('id', 'asc')->get();

        // dd($pengumumans);

        // Hitung total data
        $totalPengumuman = $pengumumans->count();
        $now             = Carbon::now();

        // Tuliskan summary
        $sheet->setCellValue('D25', 'Total Data: ' . $totalPengumuman); // Total Pengumuman
        $sheet->setCellValue('D26', 'Tanggal Export: ' . $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Isi data ke spreadsheet
        $startRow = 8; // Mulai dari baris ke-8
        foreach ($pengumumans as $index => $pengumuman) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValueExplicit("C{$row}", $pengumuman->title, DataType::TYPE_STRING); // Title
            $sheet->setCellValueExplicit("D{$row}", strip_tags($pengumuman->content), DataType::TYPE_STRING); // Content
            $sheet->setCellValueExplicit("E{$row}", $pengumuman->category, DataType::TYPE_STRING); // Category
            $sheet->setCellValueExplicit("F{$row}", strip_tags($pengumuman->urgency), DataType::TYPE_STRING); // Urgensi
            $sheet->setCellValueExplicit("G{$row}", $pengumuman->date ? Carbon::parse($pengumuman->date)->format('d-m-Y') : '', DataType::TYPE_STRING); // Date
            $sheet->setCellValueExplicit("H{$row}", $pengumuman->valid_until ? Carbon::parse($pengumuman->valid_until)->format('d-m-Y') : '', DataType::TYPE_STRING); // Valid Until
            $sheet->setCellValueExplicit("I{$row}", $pengumuman->status, DataType::TYPE_STRING); // Status
        }

        // Simpan ke file sementara
        $exportDir = storage_path('app/public/exports');
        if (!File::exists($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['kelola-pengumuman'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = 'status-' . $this->status;
        }
        if ($this->category && $this->category !== '') {
            $fileNameParts[] = 'category-' . $this->category;
        }
        if ($this->search) {
            $fileNameParts[] = 'search-' . preg_replace('/\s+/', '_', trim($this->search));
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');
        $fileName        = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $exportDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
