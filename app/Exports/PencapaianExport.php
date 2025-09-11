<?php

namespace App\Exports;

use App\Models\Beranda\Pencapaian;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class PencapaianExport
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
        $templatePath = storage_path('app/templates/temp-export-beranda-pencapaian.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query Pencapaian
        $query = Pencapaian::select('id', 'name', 'description', 'status')
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

        $pencapaians = $query->orderBy('id', 'asc')->get();

        // dd($pencapaians);

        // Hitung total
        $totalPencapaian = $pencapaians->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalPencapaian); // Total Pencapaian
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Mulai dari baris ke-8
        $startRow = 8;
        foreach ($pencapaians as $index => $pencapaian) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValueExplicit("C{$row}", $pencapaian->name, DataType::TYPE_STRING); // Name
            $sheet->setCellValueExplicit("D{$row}", $pencapaian->description, DataType::TYPE_STRING); // Description
            $sheet->setCellValueExplicit("E{$row}", ucfirst($pencapaian->status), DataType::TYPE_STRING); // Status
        }

        // Simpan ke file sementara
        $tempDir = storage_path('app/public/exports');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['pencapaian'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = 'status-' . $this->status;
        }
        if ($this->search) {
            $sanitizedSearch = preg_replace('/[^a-zA-Z0-9-_]/', '_', substr($this->search, 0, 20));
            $fileNameParts[] = 'search-' . $sanitizedSearch;
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');
        $fileName = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $tempDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
