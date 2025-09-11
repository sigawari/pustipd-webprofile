<?php

namespace App\Exports;

use App\Models\Beranda\Mitra;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class MitraExport
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
        $templatePath = storage_path('app/templates/temp-export-beranda-mitra.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query Mitra
        $query = Mitra::select('id', 'name', 'image', 'status')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            });

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('name', 'like', "%{$word}%")
                      ->orWhere('image', 'like', "%{$word}%");
                }
            });
        }

        $mitras = $query->orderBy('id', 'asc')->get();

        // dd($mitras);

        // Hitung total
        $totalMitra = $mitras->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalMitra); // Total Mitra
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Mulai dari baris ke-8
        $startRow = 8;
        foreach ($mitras as $index => $mitra) {
            $row = $startRow + $index;
            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValue("C{$row}", $mitra->name); // Name
             // Tambahkan gambar
            if (!empty($mitra->image) && file_exists(storage_path('app/public/' . $mitra->image))) {
                $drawing = new Drawing();
                $drawing->setName($mitra->name);
                $drawing->setDescription("Logo " . $mitra->name);
                $drawing->setPath(storage_path('app/public/' . $mitra->image));
                $drawing->setHeight(50); // tinggi gambar
                $drawing->setCoordinates("D{$row}");
                $drawing->setOffsetX(5); // biar ada jarak dari border kiri
                $drawing->setOffsetY(5); // biar gak nabrak cell atas
                $drawing->setWorksheet($sheet);

                // sesuaikan tinggi baris
                $sheet->getRowDimension($row)->setRowHeight(60);
            } else {
                $sheet->setCellValue("D{$row}", 'No Image');
            }
            $sheet->setCellValue("E{$row}", $mitra->status); // Status
        }

        // Simpan file sementara
        $tempDir = storage_path('app/public/exports');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['mitra'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = $this->status;
        }
        if ($this->search) {
            $fileNameParts[] = preg_replace('/\s+/', '_', trim($this->search));
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');
        $fileName = implode('_', $fileNameParts) . '.xlsx';

        $tempFilePath = $tempDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}
