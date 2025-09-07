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
    protected $search;

    public function __construct($role = null, $search = null)
    {
        $this->role = $role;
        $this->search = $search;
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

        if ($this->role === 'admin') {
            $query->where('role', 'admin');
        } elseif ($this->role === 'user_public') {
            $query->where('role', 'user_public');
        } else {
            // null / all → ambil semua
            $query->whereIn('role', ['admin', 'user_public']);
        }

        // 🔍 Filter search (opsional)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('name', 'like', "%{$word}%")
                      ->orWhere('email', 'like', "%{$word}%");
                }
            });
        }

        $users = $query->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END")->get();

        // Hitung total
        $totalUser = $users->count();
        $totalAdmin = $users->where('role', 'admin')->count();
        $totalUserPublic = $users->where('role', 'user_public')->count();

        // Tulis ke cell sesuai template
        $sheet->setCellValue('D25', ': ' . $totalUser . ' Orang'); // TOTAL USER
        $sheet->setCellValue('D26', ': ' . $totalAdmin . ' Orang'); // ADMIN
        $sheet->setCellValue('D27', ': ' . $totalUserPublic . ' Orang'); // USER PUBLIC

        // Mulai baris data dari baris 8
        $startRow = 8;

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

        // 🔥 Tentukan label nama file
        switch ($this->role) {
            case 'admin':
                $roleName = 'Admin';
                break;
            case 'user_public':
                $roleName = 'User-Public';
                break;
            default:
                $roleName = 'Semua-Role';
                break;
        }

        // Kalau ada search, tambahkan ke nama file
        $searchLabel = $this->search ? '-Search-' . str_replace(' ', '-', $this->search) : '';

        $currentDate = Carbon::now();
        $dateFormatted = $currentDate->format('dmY_His');

        // Nama file final
        $tempFile = $tempDir . '/Export-User-' . $roleName . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
