<?php

namespace App\Exports;

use App\Models\InformasiTerkini\KelolaBerita;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class BeritaExport
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
        $templatePath = storage_path('app/templates/temp-export-kelola-berita.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // 🔧 Query KelolaBerita
        $query = KelolaBerita::select('id', 'name', 'category', 'content', 'publish_date', 'status', 'created_at')
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
                    $q->orWhere('name', 'like', "%{$word}%")
                        ->orWhere('content', 'like', "%{$word}%")
                        ->orWhere('category', 'like', "%{$word}%");
                }
            });
        }

        $beritas = $query->orderBy('id', 'asc')->get();

        // dd($beritas);

        // Hitung total data
        $totalBerita = $beritas->count();
        $now         = Carbon::now();

        // Tuliskan summary
        $sheet->setCellValue('D25', $totalBerita); // Total Berita
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal Export

        // Mulai dari baris ke-8
        $startRow = 8;
        foreach ($beritas as $index => $berita) {
            $row = $startRow + $index;

            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); // No
            $sheet->setCellValueExplicit("C{$row}", $berita->name, DataType::TYPE_STRING); // Judul Berita
            $sheet->setCellValueExplicit("D{$row}", strip_tags($berita->content), DataType::TYPE_STRING); // Isi Berita
            $sheet->setCellValueExplicit("E{$row}", $berita->category, DataType::TYPE_STRING); // Kategori

            // Dibuat pada (created_at)
            $sheet->setCellValueExplicit(
                "F{$row}",
                $berita->created_at ? Carbon::parse($berita->created_at)->format('d-m-Y') : '-',
                DataType::TYPE_STRING
            );

            // Tanggal publikasi
            $sheet->setCellValueExplicit(
                "G{$row}",
                $berita->publish_date ? Carbon::parse($berita->publish_date)->format('d-m-Y') : '-',
                DataType::TYPE_STRING
            );

            // Status
            $sheet->setCellValueExplicit("H{$row}", ucfirst($berita->status), DataType::TYPE_STRING);
        }

        // Simpan ke file sementara
        $exportDir = storage_path('app/public/exports');
        if (!File::exists($exportDir)) {
            File::makeDirectory($exportDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['kelola-berita'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = 'status-' . $this->status;
        }
        if ($this->category && $this->category !== '') {
            $fileNameParts[] = 'category-' . preg_replace('/\s+/', '-', strtolower($this->category));
        }
        if ($this->search && $this->search !== '') {
            $fileNameParts[] = 'search-' . preg_replace('/\s+/', '-', strtolower($this->search));
        }
        $fileNameParts[] = $now->format('Ymd_His');
        $fileName        = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $exportDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Kembalikan path file untuk diunduh
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
