<?php

namespace App\Exports;

use App\Models\Dokumen\Sop;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class SopExport 
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
        $templatePath = storage_path('app/templates/temp-export-dokumen-sop.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query Sop
        $query = Sop::select('id', 'title', 'description', 'year_published', 'status')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            });

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('title', 'like', "%{$word}%")
                      ->orWhere('description', 'like', "%{$word}%");
                }
            });
        }

        $sops = $query->orderBy('id', 'asc')->get();

        // dd($sops);

        // Hitung total
        $totalSop = $sops->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalSop); // Total Sop
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Mulai dari baris 8
        $startRow = 8;
        foreach ($sops as $index => $sop) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_STRING); // No
            $sheet->setCellValue("C{$row}", $sop->title); // Title
            $sheet->setCellValue("D{$row}", $sop->description); // Description
            $sheet->setCellValue("E{$row}", $sop->year_published); // Year Published
            $sheet->setCellValue("F{$row}", ucfirst($sop->status)); // Status
        }

        // Simpan file sementara
        $exportDir = storage_path('app/public/exports');
        if (!File::isDirectory($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['sop'];
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
