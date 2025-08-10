<x-admin.layouts>
    <x-slot:title>Kelola Visi & Misi</x-slot:title>
    @section('page-title', 'Visi & Misi PUSTIPD')
    @section('page-description', 'Kelola Visi dan Misi UIN Raden Fatah Palembang')

    <!-- Content Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Visi & Misi</h2>
                <p class="text-gray-600 mt-1 text-sm">Kelola visi dan misi yang akan ditampilkan di halaman publik</p>
            </div>
            <button onclick="OpenCreateModal()"
                class="w-full sm:w-auto bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary/80 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Misi
            </button>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- RESPONSIVE GRID: Stack pada mobile, side-by-side pada desktop --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
            <!-- VISI Section -->
            <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6">
                <div class="flex justify-center items-center mb-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 text-center">Visi</h3>
                </div>

                <form action="{{ route('admin.manage-content.tentang.visi-misi.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <textarea name="visi" rows="8"
                            class="w-full px-3 py-2 text-sm sm:text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent {{ $errors->has('visi') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Masukkan visi..." required>{{ old('visi', $visiMisi->visi) }}</textarea>
                        @error('visi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-secondary text-white px-4 py-2 text-sm sm:text-base rounded-lg hover:bg-secondary/80 transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Visi
                    </button>
                </form>
            </div>

            <!-- MISI Section - RESPONSIVE IMPROVEMENTS -->
            <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6">
                {{-- HEADER RESPONSIVE dengan badge yang adaptif --}}
                <div class="relative flex flex-col sm:flex-row sm:items-center justify-center mb-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 text-center mb-2 sm:mb-0">Daftar Misi</h3>

                    {{-- Badge jumlah misi - responsive positioning --}}
                    @if ($visiMisi->misi && count($visiMisi->misi) > 0)
                        <span
                            class="inline-block sm:absolute sm:right-0 bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-1 rounded-full self-center">
                            <span class="sm:hidden">Total: </span>{{ count($visiMisi->misi) }} Misi
                        </span>
                    @endif
                </div>

                {{-- RESPONSIVE MISI LIST --}}
                <div class="space-y-3 max-h-80 sm:max-h-96 overflow-y-auto">
                    @if ($visiMisi->misi && count($visiMisi->misi) > 0)
                        @foreach ($visiMisi->misi as $index => $misiText)
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 sm:p-4 hover:shadow-md transition-shadow duration-200">
                                {{-- RESPONSIVE LAYOUT untuk item misi --}}
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                    <div class="flex-1">
                                        {{-- Header item dengan nomor dan label --}}
                                        <div class="flex items-center justify-between sm:justify-start mb-2">
                                            <div class="flex items-center">
                                                <span
                                                    class="inline-flex items-center justify-center w-6 h-6 bg-secondary text-white text-xs font-bold rounded-full mr-2 sm:mr-3">
                                                    {{ $index + 1 }}
                                                </span>
                                                <span class="text-xs sm:text-sm text-gray-500">Misi
                                                    #{{ $index + 1 }}</span>
                                            </div>
                                            {{-- Action buttons untuk mobile --}}
                                            <div class="flex space-x-1 sm:hidden">
                                                <button onclick="OpenUpdateModal('{{ $index }}')"
                                                    class="p-1.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
                                                    title="Edit Misi">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button onclick="OpenDeleteModal('{{ $index }}')"
                                                    class="p-1.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
                                                    title="Hapus Misi">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Konten misi dengan responsive text --}}
                                        <p class="text-gray-700 text-xs sm:text-sm leading-relaxed">
                                            {{ Str::limit($misiText, 120) }}
                                        </p>
                                    </div>

                                    {{-- Action buttons untuk desktop --}}
                                    <div class="hidden sm:flex space-x-1 ml-3 flex-shrink-0">
                                        <button onclick="OpenUpdateModal('{{ $index }}')"
                                            class="p-1.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
                                            title="Edit Misi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button onclick="OpenDeleteModal('{{ $index }}')"
                                            class="p-1.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
                                            title="Hapus Misi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Empty state responsive --}}
                        <div class="text-center py-6 sm:py-8">
                            <div
                                class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-500 mb-3 sm:mb-4 text-sm sm:text-base">Belum ada misi yang ditambahkan.
                            </p>
                            <button onclick="OpenCreateModal()"
                                class="bg-secondary text-white px-4 py-2 text-sm sm:text-base rounded-lg hover:bg-secondary/80 transition-colors duration-200">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Misi Pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Include Modal Files -->
    @include('admin.manage-content.tentang.visi-misi.create')
    @include('admin.manage-content.tentang.visi-misi.update')
    @include('admin.manage-content.tentang.visi-misi.delete')

    <!-- <script>
        // PERBAIKAN: Function dengan naming yang konsisten dan ID yang benar
        function OpenCreateModal() {
            console.log('🔍 Opening create modal');
            const modal = document.getElementById('createMisiModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                console.log('✅ Create modal Opened');
            } else {
                console.error('❌ Create modal not found');
            }
        }

        // PERBAIKAN: Gunakan ID yang benar sesuai HTML
        function OpenUpdateModal(index) {
            console.log('🔍 Trying to Open update modal for index:', index);

            // FIXED: Gunakan format ID yang sesuai dengan HTML
            const modalId = 'updateMisiModal-' + index;
            const modal = document.getElementById(modalId);

            if (modal) {
                // Tutup semua modal lain dulu
                CloseAllModals();

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';

                console.log('✅ Update modal Opened for index:', index);
            } else {
                console.error('❌ Update modal not found for ID:', modalId);

                // Debug: List available modals
                const availableModals = document.querySelectorAll('[id^="updateMisiModal-"]');
                console.log('📋 Available update modals:', Array.from(availableModals).map(m => m.id));
            }
        }

        function OpenDeleteModal(index) {
            console.log('🔍 Trying to Open delete modal for index:', index);

            const modalId = 'deleteMisiModal-' + index;
            const modal = document.getElementById(modalId);

            if (modal) {
                CloseAllModals();
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                console.log('✅ Delete modal Opened for index:', index);
            } else {
                console.error('❌ Delete modal not found for ID:', modalId);
            }
        }

        // Close functions
        function CloseCreateModal() {
            const modal = document.getElementById('createMisiModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }

        function CloseUpdateModal(index) {
            const modalId = 'updateMisiModal-' + index;
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                console.log('✅ Update modal Closed for index:', index);
            }
        }

        function CloseDeleteModal(index) {
            const modalId = 'deleteMisiModal-' + index;
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                console.log('✅ Delete modal Closed for index:', index);
            }
        }

        function CloseAllModals() {
            const allModals = document.querySelectorAll('.fixed.inset-0');
            allModals.forEach(modal => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
            document.body.style.overflow = 'auto';
            console.log('🔒 All modals Closed');
        }

        // HAPUS atau COMMENT bagian ini untuk menghentikan auto-Open modal
        // function TestModalSystem() {
        //     console.log('🔧 Testing modal system...');
        //     // PROBLEM: Ini yang menyebabkan modal terbuka otomatis saat reload
        //     setTimeout(() => {
        //         OpenUpdateModal(0); // ← HAPUS BARIS INI
        //     }, 1000);
        // }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ DOM ready');

            // HAPUS atau COMMENT ini untuk menghentikan auto-test
            // setTimeout(TestModalSystem, 1000); // ← HAPUS BARIS INI

            // Backdrop click handler
            document.addEventListener('click', function(event) {
                if (event.target.matches(
                        '.fixed.inset-0.bg-black\\/50, .fixed.inset-0[class*="bg-black"]')) {
                    event.target.classList.add('hidden');
                    event.target.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                    console.log('📱 Modal Closed via backdrop');
                }
            });

            // ESC key handler
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    CloseAllModals();
                    console.log('⌨️ Modal Closed via ESC');
                }
            });
        });
    </script> -->

</x-admin.layouts>
