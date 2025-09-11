<?php

namespace App\Exports;

use App\Models\Beranda\Layanan;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class LayananExport 
{
    protected $status;
    protected $search;

    public function __construct($status = null, $search = null)
    {
        $this->status = $status;
        $this->search = $search;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-beranda-layanan.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query Layanan
        $query = Layanan::select('id', 'name', 'description', 'status')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            });

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('name', 'like', "%{$word}%")
                      ->orWhere('description', 'like', "%{$word}%");
                }
            });
        }

        $layanans = $query->orderBy('id', 'asc')->get();

        // dd($layanans);

        // Hitung total
        $totalLayanan = $layanans->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalLayanan); // Total Layanan
        $sheet->setCellValue('D26', $now->translatedFormat('d-m-Y H:i:s')); // Tanggal Export

        // Mulai dari baris ke-8
        $startRow = 8;
        foreach ($layanans as $index => $layanan) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValue("C{$row}", $layanan->name); // Nama Layanan
            $sheet->setCellValue("D{$row}", $layanan->description); // Deskripsi
            $sheet->setCellValue("E{$row}", ucfirst($layanan->status)); // Status
        }

        // Simpan file ke storage/app/exports
        $exportDir = storage_path('app/public/exports');
        if (!File::exists($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['layanan'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = $this->status;
        }
        if ($this->search) {
            $sanitizedSearch = preg_replace('/\s+/', '_', trim($this->search));
            $fileNameParts[] = $sanitizedSearch;
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');
        $fileName = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $exportDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
