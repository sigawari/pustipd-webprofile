<?php

namespace App\Exports;

use App\Models\Faq;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\File;

class FaqExport
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
        $templatePath = storage_path('app/templates/temp-export-faq.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query FAQ
        $query = Faq::select('id', 'question', 'answer', 'status')
            ->when($this->status && $this->status !== 'all', function ($q) {
                $q->where('status', $this->status);
            });

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('question', 'like', "%{$word}%")
                      ->orWhere('answer', 'like', "%{$word}%");
                }
            });
        }

        $faqs = $query->orderBy('id', 'asc')->get();

        // dd($faqs);

        // Hitung total
        $totalFaq = $faqs->count();
        $now = Carbon::now();

        // Tulis ke spreadsheet
        $sheet->setCellValue('D25', $totalFaq); // Total FAQ
        $sheet->setCellValue('D26', $now->format('d-m-Y H:i:s')); // Tanggal export

        // Tulis data ke spreadsheet
        $startRow = 8; 
        foreach ($faqs as $index => $faq) {
            $row = $startRow + $index;

            $sheet->setCellValueExplicit("B{$row}", $index + 1, DataType::TYPE_NUMERIC); 
            $sheet->setCellValue("C{$row}", $faq->question); 
            $sheet->setCellValue("D{$row}", $faq->answer); 
            $sheet->setCellValue("E{$row}", ucwords($faq->status)); 
        }

        // Pastikan folder temp ada
        $tempDir = storage_path('app/public/exports');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        // Nama file
        $fileNameParts = ['faqs'];
        if ($this->status && $this->status !== 'all') {
            $fileNameParts[] = $this->status;
        }
        if ($this->search) {
            $fileNameParts[] = 'search';
        }
        $fileNameParts[] = $now->format('Ymd_His');
        $fileName = implode('_', $fileNameParts) . '.xlsx';

        $tempFile = $tempDir . '/' . $fileName;

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return download response
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
