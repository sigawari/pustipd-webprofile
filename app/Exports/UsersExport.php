<?php

namespace App\Exports;

use App\Models\Sistem\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UsersExport
{
    protected $role;

    public function __construct($role = null)
    {
        $this->role = $role;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-user.xlsx');
        
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔧 Query user sesuai role
        $query = User::select('id', 'name', 'email', 'role');

        if ($this->role) {
            $query->where('role', $this->role);
        } else {
            $query->whereIn('role', ['admin', 'user_public']);
        }

        // $query->whereDate('created_at', Carbon::today());
        $users = $query->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END")->get();

        // Hitung total
        $totalUser = $users->count();
        $totalAdmin = $users->where('role', 'admin')->count();
        $totalUserPublic = $users->where('role', 'user_public')->count();

        // Tulis ke cell sesuai template
        $sheet->setCellValue('D25', ': ' . $totalUser . ' Orang'); // TOTAL USER
        $sheet->setCellValue('D26', ': ' . $totalAdmin . ' Orang'); // ADMIN
        $sheet->setCellValue('D27', ': ' . $totalUserPublic . ' Orang'); // OPERATOR

        // Mulai baris data dari baris 8
        $startRow = 8;
        // dd($users->toArray());

        foreach ($users as $i => $user) {
            $row = $startRow + $i;

            $sheet->setCellValue('B'.$row, $user->id); // NO (ID)
            $sheet->setCellValue('C'.$row, $user->name); // NAME
            $sheet->setCellValueExplicit('D'.$row, $user->email, DataType::TYPE_STRING); // EMAIL
            $sheet->setCellValue('E'.$row, $user->role); // ROLE
        }

        // Tentukan folder sementara
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // 🔥 Tentukan nama role di file
        $roleName = $this->role ? strtoupper($this->role) : 'ALL';

        $currentDate = Carbon::now();

        // Nama file dengan ROLE + Tanggal
        $dateFormatted = $currentDate->format('dmY_His');
        $tempFile = $tempDir . '/Export-User-' . $roleName . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

         // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
