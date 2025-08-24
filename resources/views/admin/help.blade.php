<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow rounded-lg p-6">

            <div class="space-y-4">
                <x-help-accordion title="Pengenalan CMS">
                    CMS PUSTIPD berfungsi untuk mengelola konten website profil dengan fitur utama seperti Berita,
                    Pengumuman,
                    Layanan, Dokumen, Struktur Organisasi, dan Manajemen Pengguna. CMS memudahkan admin menambah,
                    mengubah,
                    dan menghapus konten tanpa perlu mengubah kode program.
                </x-help-accordion>

                <x-help-accordion title="Akses dan Login">
                    Admin harus login menggunakan email/NIP dan password. Login memastikan hanya akun resmi yang dapat
                    mengakses CMS.
                    Setelah login akan diarahkan ke dashboard utama.
                </x-help-accordion>

                <x-help-accordion title="Dashboard Admin">
                    Dashboard menampilkan ringkasan informasi, tombol aksi cepat, aktivitas terbaru, dan navigasi
                    sidebar
                    menuju seluruh fitur pengelolaan konten di CMS.
                </x-help-accordion>

                <x-help-accordion title="Manajemen Konten">
                    Fitur unggulan untuk mengatur halaman Beranda dan Tentang Kami dengan status konten Draft maupun
                    Published.
                    Pengelolaan konten meliputi berita, pengumuman, tutorial, dokumen, galeri, visi misi, dan struktur
                    organisasi.
                </x-help-accordion>

                <x-help-accordion title="Manajemen Berita dan Pengumuman">
                    Tambah, edit, hapus berita dan pengumuman dengan status Draft atau Published. Berita menggunakan
                    Quill Editor
                    dan dapat menambahkan gambar utama. Pengumuman dapat bertipe Biasa atau Penting dengan tanggal
                    berakhir.
                </x-help-accordion>

                <x-help-accordion title="Manajemen Dokumen">
                    Kelola dokumen resmi seperti SOP, regulasi, panduan dengan informasi nama, deskripsi, tahun terbit,
                    dan upload file PDF.
                    Dokumen dapat diunduh satuan atau bulk dalam format ZIP.
                </x-help-accordion>

                <x-help-accordion title="Manajemen Pengguna">
                    Pengelolaan akun admin dan user public dengan hak akses berbeda. Admin dapat menambah, mengedit,
                    reset password,
                    menonaktifkan atau menghapus akun sesuai kebijakan.
                </x-help-accordion>

                <x-help-accordion title="Penutup dan Harapan">
                    CMS dibuat agar mudah dioperasikan dan konten selalu update. Disarankan update konten rutin,
                    manajemen pengguna disiplin,
                    serta prosedur input dan publikasi konten diikuti dengan baik.
                </x-help-accordion>

            </div>
        </div>
    </div>
</x-admin.layouts>
