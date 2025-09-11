<?php

namespace App\Exports;

use App\Models\AppLayanan;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class AppLayananExport
{
    protected $status;
    protected $category;
    protected $search;
    public function __construct($status = null, $category = null, $search = null)
    {
        $this->status = $status;
        $this->category = $category;
        $this->search = $search;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-app-layanan.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query AppLayanan
        $query = AppLayanan::select('id', 'appname', 'category', 'description', 'applink', 'status')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            })
            ->when($this->category && $this->category !== '', function ($q) {
                $q->where('category', $this->category);
            });

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('appname', 'like', "%{$word}%")
                      ->orWhere('description', 'like', "%{$word}%")
                      ->orWhere('category', 'like', "%{$word}%");
                }
            });
        }

        $appLayanans = $query->orderBy('id', 'asc')->get();

        // dd($appLayanans);

        // Hitung total
        $totalAppLayanan = $appLayanans->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalAppLayanan); // Total AppLayanan
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal export

        // Mulai dari baris ke-8
        $startRow = 8;
        foreach ($appLayanans as $index => $appLayanan) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValue("C{$row}", $appLayanan->appname); // App Name
            $sheet->setCellValue("D{$row}", $appLayanan->description); // Description
            $sheet->setCellValue("E{$row}", $appLayanan->category); // Category
            $sheet->setCellValue("F{$row}", $appLayanan->applink); // App Link
            $sheet->setCellValue("G{$row}", ucfirst($appLayanan->status)); // Status
        }
        
        // Simpan ke file sementara
        $exportDir = storage_path('app/public/exports');
        if (!File::exists($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama File
        $fileNameParts = ['app-layanans'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = $this->status;
        }
        if ($this->category && $this->category !== '') {
            $fileNameParts[] = preg_replace('/\s+/', '-', strtolower($this->category));
        }
        if ($this->search) {
            $fileNameParts[] = 'search';
        }
        $fileNameParts[] = $now->format('Ymd_His');
        $fileName = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $exportDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
