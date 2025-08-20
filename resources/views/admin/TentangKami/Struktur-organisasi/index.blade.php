<!-- resources/views/admin/TentangKami/struktur-organisasi/index.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Struktur Organisasi PUSTIPD')
    @section('page-description', 'Kelola Struktur Organisasi PUSTIPD')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Struktur {{ $title }}</h2>
                <p class="text-gray-600 mt-1">Kelola deskripsi, kepala organisasi, dan divisi PUSTIPD</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button onclick="saveOrganization()" type="button"
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>

        <form id="organizationForm" enctype="multipart/form-data">
            @csrf

            <!-- Deskripsi Struktur Organisasi -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Deskripsi Struktur Organisasi</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Page Info</span>
                </div>

                <div>
                    <label for="structureDesc" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Halaman Struktur Organisasi
                    </label>
                    <textarea id="structureDesc" name="structure_desc" rows="4"
                        class="w-full px-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                        placeholder="Deskripsi tentang halaman struktur organisasi PUSTIPD...">{{ $description ?? '' }}</textarea>
                </div>
            </div>

            <!-- Kepala Organisasi -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Kepala PUSTIPD</h3>
                    <span class="text-xs text-gray-500 bg-red-100 px-2 py-1 rounded">Single Entry</span>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Foto Kepala</label>
                            <div class="flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4 overflow-hidden"
                                    id="headPhotoPreview">
                                    @if ($headData && $headData->foto_kepala)
                                        <img id="headPhotoImg" class="w-full h-full object-cover"
                                            src="{{ asset('storage/' . $headData->foto_kepala) }}"
                                            alt="{{ $headData->nama_kepala }}">
                                    @else
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <input type="file" id="headPhoto" name="foto_kepala" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('headPhoto').click()"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                                    Upload Foto
                                </button>
                            </div>
                        </div>

                        <!-- Head Info -->
                        <div class="space-y-4">
                            <div>
                                <label for="headName" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="headName" name="nama_kepala" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nama Kepala PUSTIPD" value="{{ $headData->nama_kepala ?? '' }}">
                            </div>

                            <div>
                                <label for="headPosition"
                                    class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                <input type="text" id="headPosition" name="jabatan_kepala" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Kepala PUSTIPD"
                                    value="{{ $headData->jabatan_kepala ?? 'Kepala PUSTIPD' }}">
                            </div>

                            <div>
                                <label for="headEmail"
                                    class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="headEmail" name="email_kepala"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="kepala@pustipd.uinrf.ac.id"
                                    value="{{ $headData->email_kepala ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divisi Management -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Divisi & Staff</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 bg-green-100 px-2 py-1 rounded">Multiple Entries</span>
                        <button type="button" onclick="addDivisionEntry()"
                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Divisi
                        </button>
                    </div>
                </div>

                <!-- Existing Divisions -->
                <div id="divisionsContainer" class="space-y-6">
                    @if ($structure && $structure->count() > 0)
                        @foreach ($structure as $divisionName => $staffs)
                            <div class="division-entry bg-gray-50 rounded-lg p-4 border">
                                <div class="flex items-center justify-between mb-3">
                                    <input type="text" name="divisions[{{ $loop->index }}][nama_divisi]"
                                        value="{{ $divisionName }}"
                                        class="font-medium bg-transparent border-b border-gray-300 focus:border-blue-500 focus:outline-none"
                                        placeholder="Nama Divisi">
                                    <input type="hidden" name="divisions[{{ $loop->index }}][divisi_order]"
                                        value="{{ $staffs->first()->divisi_order }}">
                                    <button type="button" onclick="removeDivisionEntry(this)"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                        Hapus Divisi
                                    </button>
                                </div>

                                <div class="staff-container space-y-3">
                                    @foreach ($staffs as $staff)
                                        <div
                                            class="staff-entry grid grid-cols-1 md:grid-cols-4 gap-3 p-3 bg-white rounded">
                                            <input type="text"
                                                name="divisions[{{ $loop->parent->index }}][staff][{{ $loop->index }}][nama]"
                                                value="{{ $staff->nama }}" class="px-2 py-1 border rounded"
                                                placeholder="Nama Staff">
                                            <input type="text"
                                                name="divisions[{{ $loop->parent->index }}][staff][{{ $loop->index }}][jabatan]"
                                                value="{{ $staff->jabatan }}" class="px-2 py-1 border rounded"
                                                placeholder="Jabatan">
                                            <input type="email"
                                                name="divisions[{{ $loop->parent->index }}][staff][{{ $loop->index }}][email]"
                                                value="{{ $staff->email }}" class="px-2 py-1 border rounded"
                                                placeholder="Email">
                                            <div class="flex items-center gap-2">
                                                <input type="file"
                                                    name="divisions[{{ $loop->parent->index }}][staff][{{ $loop->index }}][foto]"
                                                    accept="image/*" class="hidden"
                                                    id="staff_photo_{{ $loop->parent->index }}_{{ $loop->index }}">
                                                <button type="button"
                                                    onclick="document.getElementById('staff_photo_{{ $loop->parent->index }}_{{ $loop->index }}').click()"
                                                    class="text-xs bg-gray-200 px-2 py-1 rounded">Foto</button>
                                                <button type="button" onclick="removeStaffEntry(this)"
                                                    class="text-red-600 text-xs">Hapus</button>
                                            </div>
                                            <input type="hidden"
                                                name="divisions[{{ $loop->parent->index }}][staff][{{ $loop->index }}][staff_order]"
                                                value="{{ $staff->staff_order }}">
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" onclick="addStaffEntry(this)"
                                    class="mt-3 text-blue-600 text-sm hover:text-blue-800">
                                    + Tambah Staff
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Empty State -->
                <div id="divisionsEmptyState"
                    class="text-center py-8 border-2 border-dashed border-gray-200 rounded-lg"
                    style="display: {{ $structure && $structure->count() > 0 ? 'none' : 'block' }}">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm mb-3">Belum ada divisi yang ditambahkan</p>
                    <button type="button" onclick="addDivisionEntry()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Tambah Divisi Pertama
                    </button>
                </div>
            </div>

            <!-- Status Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Status Aktif</label>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500 mr-2">Terakhir disimpan:</span>
                        <span id="lastSavedTime" class="text-xs text-green-600 font-medium">
                            {{ $headData ? $headData->updated_at->format('d M Y H:i') : 'Belum disimpan' }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="isActive" name="is_active" value="1"
                        {{ $headData && $headData->is_active ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="isActive" class="ml-2 text-sm text-gray-700">
                        Aktifkan struktur organisasi (akan tampil di website)
                    </label>
                </div>
            </div>
        </form>
    </div>

    <script>
        window.routes = {
            'admin.tentang-kami.struktur-organisasi.store': '{{ route('admin.tentang-kami.struktur-organisasi.store') }}',
            'admin.tentang-kami.struktur-organisasi.get-data': '{{ route('admin.tentang-kami.struktur-organisasi.get-data') }}'
        };

        // JavaScript functions untuk menambah/mengurangi divisi dan staff
        let divisionCounter = {{ $structure ? $structure->count() : 0 }};

        function addDivisionEntry() {
            document.getElementById('divisionsEmptyState').style.display = 'none';

            const container = document.getElementById('divisionsContainer');
            const divisionHtml = `
                <div class="division-entry bg-gray-50 rounded-lg p-4 border-gray-300">
                    <div class="flex items-center justify-between mb-3">
                        <input type="text" name="divisions[${divisionCounter}][nama_divisi]" 
                            class="font-medium bg-transparent border-b border-gray-300 focus:border-blue-500 focus:outline-none"
                            placeholder="Nama Divisi" required>
                        <input type="hidden" name="divisions[${divisionCounter}][divisi_order]" value="${divisionCounter + 1}">
                        <button type="button" onclick="removeDivisionEntry(this)"
                            class="text-red-600 hover:text-red-800 text-sm">
                            Hapus Divisi
                        </button>
                    </div>
                    
                    <div class="staff-container space-y-3">
                        <div class="staff-entry grid grid-cols-1 md:grid-cols-4 gap-3 p-3 bg-white rounded border-gray-300">
                            <input type="text" name="divisions[${divisionCounter}][staff][0][nama]" 
                                class="px-2 py-1 border-gray-300 border rounded focus:border-blue-500 focus:outline-none" placeholder="Nama Staff" required>
                            <input type="text" name="divisions[${divisionCounter}][staff][0][jabatan]" 
                                class="px-2 py-1 border-gray-300 border rounded focus:border-blue-500 focus:outline-none" placeholder="Jabatan" required>
                            <input type="email" name="divisions[${divisionCounter}][staff][0][email]" 
                                class="px-2 py-1 border-gray-300 border rounded focus:border-blue-500 focus:outline-none" placeholder="Email">
                            <div class="flex items-center gap-2">
                                <input type="file" name="divisions[${divisionCounter}][staff][0][foto]" 
                                    accept="image/*" class="hidden" id="staff_photo_${divisionCounter}_0">
                                <button type="button" onclick="document.getElementById('staff_photo_${divisionCounter}_0').click()"
                                    class="text-xs bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded transition-colors">Foto</button>
                                <button type="button" onclick="removeStaffEntry(this)"
                                    class="text-red-600 hover:text-red-800 text-xs transition-colors">Hapus</button>
                            </div>
                            <input type="hidden" name="divisions[${divisionCounter}][staff][0][staff_order]" value="1">
                        </div>
                    </div>
                    
                    <button type="button" onclick="addStaffEntry(this)"
                        class="mt-3 text-blue-600 text-sm hover:text-blue-800 transition-colors">
                        + Tambah Staff
                    </button>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', divisionHtml);
            divisionCounter++;
        }

        function removeDivisionEntry(button) {
            button.closest('.division-entry').remove();

            if (document.getElementById('divisionsContainer').children.length === 0) {
                document.getElementById('divisionsEmptyState').style.display = 'block';
            }
        }

        function addStaffEntry(button) {
            const divisionEntry = button.closest('.division-entry');
            const staffContainer = divisionEntry.querySelector('.staff-container');
            const divisionIndex = Array.from(divisionEntry.parentNode.children).indexOf(divisionEntry);
            const staffCount = staffContainer.children.length;

            const staffHtml = `
                <div class="staff-entry grid grid-cols-1 md:grid-cols-4 gap-3 p-3 bg-white rounded border">
                    <input type="text" name="divisions[${divisionIndex}][staff][${staffCount}][nama]" 
                           class="px-2 py-1 border rounded" placeholder="Nama Staff" required>
                    <input type="text" name="divisions[${divisionIndex}][staff][${staffCount}][jabatan]" 
                           class="px-2 py-1 border rounded" placeholder="Jabatan" required>
                    <input type="email" name="divisions[${divisionIndex}][staff][${staffCount}][email]" 
                           class="px-2 py-1 border rounded" placeholder="Email">
                    <div class="flex items-center gap-2">
                        <input type="file" name="divisions[${divisionIndex}][staff][${staffCount}][foto]" 
                               accept="image/*" class="hidden" id="staff_photo_${divisionIndex}_${staffCount}">
                        <button type="button" onclick="document.getElementById('staff_photo_${divisionIndex}_${staffCount}').click()"
                            class="text-xs bg-gray-200 px-2 py-1 rounded">Foto</button>
                        <button type="button" onclick="removeStaffEntry(this)"
                            class="text-red-600 text-xs">Hapus</button>
                    </div>
                    <input type="hidden" name="divisions[${divisionIndex}][staff][${staffCount}][staff_order]" value="${staffCount + 1}">
                </div>
            `;

            staffContainer.insertAdjacentHTML('beforeend', staffHtml);
        }

        function removeStaffEntry(button) {
            button.closest('.staff-entry').remove();
        }

        function saveOrganization() {
            const form = document.getElementById('organizationForm');
            const formData = new FormData(form);

            // Show loading state
            const saveButton = document.querySelector('button[onclick="saveOrganization()"]');
            const originalText = saveButton.innerHTML;
            saveButton.innerHTML =
                '<svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menyimpan...';
            saveButton.disabled = true;

            fetch(window.routes['admin.tentang-kami.struktur-organisasi.store'], {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('lastSavedTime').textContent = new Date().toLocaleString('id-ID');
                        // Show success message
                        alert('Data berhasil disimpan!');
                    } else {
                        alert('Gagal menyimpan data: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                })
                .finally(() => {
                    saveButton.innerHTML = originalText;
                    saveButton.disabled = false;
                });
        }

        // Preview image when selected
        document.getElementById('headPhoto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('headPhotoPreview');
                    preview.innerHTML =
                        `<img class="w-full h-full object-cover" src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin.layouts>
