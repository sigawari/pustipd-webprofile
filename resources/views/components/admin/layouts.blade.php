<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUSTIPD | {{ $title }}</title>

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('description', 'Sistem Manajemen Konten PUSTIPD UIN Raden Fatah Palembang')">
        <meta name="keywords" content="@yield('keywords', 'PUSTIPD, UIN Raden Fatah, CMS, Admin')">

        <!-- Script -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- CSS -->

    </head>

    <body class="bg-gray-50">
        <div x-data="{
            sidebarToggle: localStorage.getItem('sidebarToggle') === 'true' || false,
            darkMode: localStorage.getItem('darkMode') === 'true' || false
        }"
            @toggle-sidebar.window="sidebarToggle = !sidebarToggle; localStorage.setItem('sidebarToggle', sidebarToggle)"
            x-init="$watch('sidebarToggle', value => {
                localStorage.setItem('sidebarToggle', value);
                console.log('Sidebar state:', value ? 'COLLAPSED (Mini)' : 'EXPANDED (Full)');
            });
            $watch('darkMode', value => localStorage.setItem('darkMode', value));
            console.log('Initial sidebar state:', sidebarToggle ? 'COLLAPSED' : 'EXPANDED');" class="flex flex-col min-h-screen">

            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Sidebar -->
            <x-admin.sidebar />

            <!-- Main Content Area - PERBAIKAN DI SINI -->
            <div class="transition-all duration-300 ease-in-out"
                :class="{
                    'ml-0 lg:ml-[90px]': sidebarToggle, // Sidebar COLLAPSED (mini) - margin kecil
                    'ml-0 lg:ml-[290px]': !sidebarToggle // Sidebar EXPANDED (full) - margin besar
                }">

                <!-- Header -->
                @if (Route::currentRouteName() === 'admin.dashboard.index')
                    {{-- Tampilkan welcome header hanya di dashboard --}}
                    @include('components.admin.header-welcome')
                @else
                    {{-- Tampilkan header biasa di halaman lain --}}
                    @include('components.admin.header-default', [
                        'pageData' => [
                            'pageName' => $title ?? 'Halaman',
                            'title' => $title ?? 'Judul Halaman',
                            'description' => 'Kelola konten sesuai kebutuhan Anda.'
                        ]
                    ])
                @endif


                <!-- Page Content -->
                <main class="min-h-screen mb">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <x-admin.footer />
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarToggle && window.innerWidth < 1024" @click="sidebarToggle = false"
                class="fixed inset-0 z-25 lg:hidden" style="background-color: rgba(0, 0, 0, 0.15);"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            </div>
        </div>

        <!-- JavaScript - LENGKAP dengan SEMUA FITUR -->
        <script>
            console.log('Achievement management script loaded');

            // Modal Management
            function openAddModal() {
                console.log('openAddModal called');

                const modal = document.getElementById('achievementModal');
                if (!modal) {
                    console.error('Modal not found!');
                    alert('Error: Modal tidak ditemukan');
                    return;
                }

                // Show modal
                modal.classList.remove('hidden');
                modal.style.display = 'flex';

                // Reset form
                document.getElementById('modalTitle').textContent = 'Tambah mitra Baru';
                document.getElementById('achievementForm').reset();
                clearLogoSelection();

                console.log('Modal opened successfully');
            }

            function closeModal() {
                const modal = document.getElementById('achievementModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.style.display = 'none';
                }
            }

            function closePreviewModal() {
                const previewModal = document.getElementById('previewModal');
                if (previewModal) {
                    previewModal.classList.add('hidden');
                    previewModal.style.display = 'none';
                }
            }

            // Logo Selection Functions
            function clearLogoSelection() {
                document.querySelectorAll('.logo-option').forEach(btn => {
                    btn.classList.remove('border-blue-500', 'bg-blue-50');
                    btn.classList.add('border-gray-200');
                });
                document.getElementById('selectedLogo').value = '';
            }

            // CRUD Functions
            function editAchievement(id) {
                console.log('Edit achievement:', id);
                openAddModal();
                document.getElementById('modalTitle').textContent = 'Edit mitra';
                // TODO: Load existing data
            }

            function previewAchievement(id) {
                console.log('Preview achievement:', id);
                const previewModal = document.getElementById('previewModal');
                if (previewModal) {
                    previewModal.classList.remove('hidden');
                    previewModal.style.display = 'flex';
                }
            }

            function duplicateAchievement(id) {
                if (confirm('Duplikasi mitra ini?')) {
                    alert('mitra berhasil diduplikasi! (Demo)');
                }
            }

            function deleteAchievement(id) {
                if (confirm('Apakah Anda yakin ingin menghapus mitra ini?')) {
                    alert('mitra berhasil dihapus! (Demo)');
                }
            }

            // Bulk Actions Functions
            function applyBulkAction() {
                const selectedIds = getSelectedIds();
                const action = document.getElementById('bulkAction').value;

                if (selectedIds.length === 0) {
                    alert('Pilih minimal 1 item untuk melakukan aksi bulk');
                    return;
                }

                if (!action) {
                    alert('Pilih aksi yang akan diterapkan');
                    return;
                }

                let actionText = '';
                switch (action) {
                    case 'publish':
                        actionText = 'publikasikan';
                        break;
                    case 'draft':
                        actionText = 'jadikan draft';
                        break;
                    case 'schedule':
                        actionText = 'jadwalkan';
                        break;
                    case 'archive':
                        actionText = 'arsipkan';
                        break;
                    case 'delete':
                        actionText = 'hapus';
                        break;
                }

                if (confirm(`Apakah Anda yakin ingin ${actionText} ${selectedIds.length} item yang dipilih?`)) {
                    console.log('Bulk action:', action, 'IDs:', selectedIds);
                    alert(`${selectedIds.length} item berhasil ${actionText}! (Demo)`);

                    // Reset selections
                    document.getElementById('selectAll').checked = false;
                    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
                    updateSelectedCount();
                }
            }

            function getSelectedIds() {
                const checkboxes = document.querySelectorAll('.row-checkbox:checked');
                return Array.from(checkboxes).map(cb => cb.dataset.id);
            }

            function updateSelectedCount() {
                const selected = document.querySelectorAll('.row-checkbox:checked').length;
                document.getElementById('selected-count').textContent = selected;

                // Enable/disable bulk action button
                const bulkBtn = document.getElementById('bulkActionBtn');
                bulkBtn.disabled = selected === 0;

                // Update select all checkbox
                const selectAll = document.getElementById('selectAll');
                const allCheckboxes = document.querySelectorAll('.row-checkbox');

                if (selected === 0) {
                    selectAll.indeterminate = false;
                    selectAll.checked = false;
                } else if (selected === allCheckboxes.length) {
                    selectAll.indeterminate = false;
                    selectAll.checked = true;
                } else {
                    selectAll.indeterminate = true;
                }
            }

            // Form Validation
            function validateForm() {
                const logo = document.getElementById('selectedLogo').value;
                const title = document.getElementById('title').value.trim();
                const description = document.getElementById('description').value.trim();

                if (!logo) {
                    alert('Silakan pilih logo untuk mitra ini');
                    return false;
                }

                if (!title) {
                    alert('Judul tidak boleh kosong');
                    return false;
                }

                if (!description) {
                    alert('Keterangan tidak boleh kosong');
                    return false;
                }

                return true;
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Initializing achievement management...');

                // Logo selection event listeners
                document.querySelectorAll('.logo-option').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Clear previous selections
                        clearLogoSelection();

                        // Select this logo
                        this.classList.add('border-blue-500', 'bg-blue-50');
                        this.classList.remove('border-gray-200');

                        // Set hidden input
                        document.getElementById('selectedLogo').value = this.dataset.logo;

                        console.log('Logo selected:', this.dataset.logo);
                    });
                });

                // Select all checkbox
                document.getElementById('selectAll').addEventListener('change', function() {
                    const isChecked = this.checked;
                    document.querySelectorAll('.row-checkbox').forEach(cb => {
                        cb.checked = isChecked;
                    });
                    updateSelectedCount();
                });

                // Individual checkboxes
                document.querySelectorAll('.row-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectedCount);
                });

                // Status change handler for scheduled date
                document.getElementById('status').addEventListener('change', function() {
                    const scheduleDiv = document.getElementById('scheduleDate');
                    if (this.value === 'scheduled') {
                        scheduleDiv.classList.remove('hidden');
                        document.getElementById('publish_date').required = true;
                    } else {
                        scheduleDiv.classList.add('hidden');
                        document.getElementById('publish_date').required = false;
                    }
                });

                // Form submission
                document.getElementById('achievementForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!validateForm()) {
                        return;
                    }

                    const formData = new FormData(this);
                    console.log('Form data:', Object.fromEntries(formData));

                    // Simulate success
                    closeModal();
                    alert('mitra berhasil disimpan! (Demo)');
                });

                // Keyboard shortcuts
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        if (!document.getElementById('achievementModal').classList.contains('hidden')) {
                            closeModal();
                        }
                        if (!document.getElementById('previewModal').classList.contains('hidden')) {
                            closePreviewModal();
                        }
                    }
                });

                console.log('Achievement management initialization complete');
            });

            // Debug helpers
            window.debugAchievement = {
                openModal: () => openAddModal(),
                closeModal: () => closeModal(),
                testModal: () => {
                    console.log('Modal element:', document.getElementById('achievementModal'));
                    console.log('Form element:', document.getElementById('achievementForm'));
                    console.log('Logo options:', document.querySelectorAll('.logo-option').length);
                }
            };

            console.log('Debug helper available: window.debugAchievement.testModal()');
        </script>
    </body>
</html>
