<!-- resources/views/admin/manage-content/about/profile.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- @section('page-title', 'Profil PUSTIPD')
    @section('page-description', 'Kelola konten profil organisasi PUSTIPD')
    @section('breadcrumb')
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Kelola Konten</span>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Profil PUSTIPD</span>
            </div>
        </li>
    @endsection -->

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <form action="#" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($profileData))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Organization Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Organisasi
                        </label>
                        <input type="text" name="organization_name"
                            value="{{ old('organization_name', $profileData->organization_name ?? 'PUSTIPD') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: PUSTIPD, PPID, dll">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi untuk Halaman {{$title}}
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Deskripsi organisasi yang akan ditampilkan di halaman {{$title}} website...">{{ old('description', $profileData->description ?? '') }}</textarea>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea name="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Alamat lengkap organisasi...">{{ old('address', $profileData->address ?? '') }}</textarea>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email"
                                    value="{{ old('email', $profileData->email ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="email@example.com">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                                    <input type="url" name="instagram_url"
                                        value="{{ old('instagram_url', $profileData->instagram_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://instagram.com/username">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                                    <input type="url" name="facebook_url"
                                        value="{{ old('facebook_url', $profileData->facebook_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://facebook.com/pagename">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                                    <input type="url" name="youtube_url"
                                        value="{{ old('youtube_url', $profileData->youtube_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://youtube.com/channel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Profile Photo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto {{$title}} untuk Beranda
                        </label>

                        <!-- Current Photo Preview -->
                        @if (isset($profileData->profile_photo) && $profileData->profile_photo)
                            <div class="mb-4">
                                <img src="{{ Storage::url($profileData->profile_photo) }}" alt="Current Photo"
                                    class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <div id="photo-preview" class="hidden mb-4">
                                <img id="preview-img" src="" alt="Preview"
                                    class="mx-auto h-32 w-auto rounded-lg object-cover">
                            </div>
                            <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4">
                                <label for="profile-photo-upload" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-gray-900">
                                        {{ isset($profileData->profile_photo) ? 'Ganti foto profile' : 'Upload foto profile' }}
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        PNG, JPG up to 5MB (disarankan 1200x800px)
                                    </span>
                                </label>
                                <input id="profile-photo-upload" name="profile_photo" type="file" class="sr-only"
                                    accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>
                    </div>

                    <!-- Lists Section -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Daftar Links</h3>

                        <!-- Applications List -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-700">Daftar Aplikasi</label>
                                <button type="button"
                                    onclick="addListItem('applications', 'Nama Aplikasi', 'https://link-aplikasi.com')"
                                    class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah
                                </button>
                            </div>
                            <div id="applications-list" class="space-y-2">
                                @if (isset($profileData->applications) && count($profileData->applications) > 0)
                                    @foreach ($profileData->applications as $index => $app)
                                        <div class="flex gap-2 items-center p-3 bg-gray-50 rounded-lg">
                                            <input type="text" name="applications[{{ $index }}][name]"
                                                value="{{ $app['name'] }}" placeholder="Nama Aplikasi" readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <input type="url" name="applications[{{ $index }}][url]"
                                                value="{{ $app['url'] }}" placeholder="https://link-aplikasi.com"
                                                readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <button type="button" onclick="editListItem(this)"
                                                class="text-sm text-blue-600 hover:text-blue-800 px-2 py-1 rounded">Edit</button>
                                            <button type="button" onclick="saveListItem(this)"
                                                class="text-sm text-green-600 hover:text-green-800 px-2 py-1 rounded hidden">Save</button>
                                            <button type="button" onclick="removeListItem(this)"
                                                class="text-sm text-red-600 hover:text-red-800 px-2 py-1 rounded">Delete</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                                        Belum ada aplikasi. Klik "Tambah" untuk menambahkan.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Institutions List -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-700">Daftar Lembaga</label>
                                <button type="button"
                                    onclick="addListItem('institutions', 'Nama Lembaga', 'https://link-lembaga.com')"
                                    class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah
                                </button>
                            </div>
                            <div id="institutions-list" class="space-y-2">
                                @if (isset($profileData->institutions) && count($profileData->institutions) > 0)
                                    @foreach ($profileData->institutions as $index => $inst)
                                        <div class="flex gap-2 items-center p-3 bg-gray-50 rounded-lg">
                                            <input type="text" name="institutions[{{ $index }}][name]"
                                                value="{{ $inst['name'] }}" placeholder="Nama Lembaga" readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <input type="url" name="institutions[{{ $index }}][url]"
                                                value="{{ $inst['url'] }}" placeholder="https://link-lembaga.com"
                                                readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <button type="button" onclick="editListItem(this)"
                                                class="text-sm text-blue-600 hover:text-blue-800 px-2 py-1 rounded">Edit</button>
                                            <button type="button" onclick="saveListItem(this)"
                                                class="text-sm text-green-600 hover:text-green-800 px-2 py-1 rounded hidden">Save</button>
                                            <button type="button" onclick="removeListItem(this)"
                                                class="text-sm text-red-600 hover:text-red-800 px-2 py-1 rounded">Delete</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                                        Belum ada lembaga. Klik "Tambah" untuk menambahkan.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Universities/Faculties List -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-700">Daftar Fakultas
                                    Universitas</label>
                                <button type="button"
                                    onclick="addListItem('universities', 'Nama Fakultas', 'https://fakultas.univ.ac.id')"
                                    class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah
                                </button>
                            </div>
                            <div id="universities-list" class="space-y-2">
                                @if (isset($profileData->universities) && count($profileData->universities) > 0)
                                    @foreach ($profileData->universities as $index => $univ)
                                        <div class="flex gap-2 items-center p-3 bg-gray-50 rounded-lg">
                                            <input type="text" name="universities[{{ $index }}][faculty]"
                                                value="{{ $univ['faculty'] }}" placeholder="Nama Fakultas" readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <input type="url" name="universities[{{ $index }}][url]"
                                                value="{{ $univ['url'] }}" placeholder="https://fakultas.univ.ac.id"
                                                readonly
                                                class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white">
                                            <button type="button" onclick="editListItem(this)"
                                                class="text-sm text-blue-600 hover:text-blue-800 px-2 py-1 rounded">Edit</button>
                                            <button type="button" onclick="saveListItem(this)"
                                                class="text-sm text-green-600 hover:text-green-800 px-2 py-1 rounded hidden">Save</button>
                                            <button type="button" onclick="removeListItem(this)"
                                                class="text-sm text-red-600 hover:text-red-800 px-2 py-1 rounded">Delete</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                                        Belum ada fakultas. Klik "Tambah" untuk menambahkan.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons - RESPONSIF -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 pt-6 border-t border-gray-200 gap-4">
                <!-- Preview Section -->
                <div class="flex justify-center sm:justify-start">
                    <a href="#" target="_blank"
                        class="w-full sm:w-auto px-4 py-2 border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-50 transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <span class="text-sm sm:text-base">Preview di Website</span>
                    </a>
                </div>

                <!-- Action Section -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:space-x-3">
                    <button type="button" onclick="window.history.back()"
                        class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 text-sm sm:text-base">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-secondary text-white rounded-lg hover:bg-custom-blue transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Preview uploaded image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('photo-preview').classList.remove('hidden');
                    document.getElementById('upload-icon').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add new list item
        function addListItem(listType, namePlaceholder, urlPlaceholder) {
            const container = document.getElementById(listType + '-list');

            // Remove empty state message if exists
            const emptyMessage = container.querySelector('.border-dashed');
            if (emptyMessage) {
                emptyMessage.remove();
            }

            const index = container.children.length;
            let nameField = listType === 'universities' ? 'faculty' : 'name';

            const newItem = document.createElement('div');
            newItem.className = 'flex gap-2 items-center p-3 bg-gray-50 rounded-lg';
            newItem.innerHTML = `
        <input type="text" name="${listType}[${index}][${nameField}]" value="" placeholder="${namePlaceholder}"
            class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="url" name="${listType}[${index}][url]" value="" placeholder="${urlPlaceholder}"
            class="flex-1 px-3 py-2 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="editListItem(this)" 
            class="text-sm text-blue-600 hover:text-blue-800 px-2 py-1 rounded hidden">Edit</button>
        <button type="button" onclick="saveListItem(this)" 
            class="text-sm text-green-600 hover:text-green-800 px-2 py-1 rounded">Save</button>
        <button type="button" onclick="removeListItem(this)" 
            class="text-sm text-red-600 hover:text-red-800 px-2 py-1 rounded">Delete</button>
    `;
            container.appendChild(newItem);

            // Focus on first input
            newItem.querySelector('input').focus();
        }

        // Enable editing mode for list item
        function editListItem(button) {
            const item = button.closest('.flex');
            const inputs = item.querySelectorAll('input');

            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.classList.remove('bg-white');
                input.classList.add('bg-yellow-50', 'border-yellow-300');
            });

            // Toggle buttons
            button.classList.add('hidden');
            item.querySelector('.text-green-600').classList.remove('hidden');

            // Focus first input
            inputs[0].focus();
        }

        // Save list item (disable editing)
        function saveListItem(button) {
            const item = button.closest('.flex');
            const inputs = item.querySelectorAll('input');

            // Validate inputs
            let isValid = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('border-red-300');
                    isValid = false;
                } else {
                    input.classList.remove('border-red-300');
                }
            });

            if (!isValid) {
                alert('Mohon isi semua field yang diperlukan.');
                return;
            }

            inputs.forEach(input => {
                input.setAttribute('readonly', true);
                input.classList.remove('bg-yellow-50', 'border-yellow-300');
                input.classList.add('bg-white');
            });

            // Toggle buttons
            button.classList.add('hidden');
            item.querySelector('.text-blue-600').classList.remove('hidden');
        }

        // Remove list item with confirmation
        function removeListItem(button) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                const item = button.closest('.flex');
                const container = item.parentNode;

                item.remove();

                // Re-index remaining items
                const items = Array.from(container.children).filter(child => child.classList.contains('flex'));
                items.forEach((item, index) => {
                    const inputs = item.querySelectorAll('input');
                    inputs.forEach(input => {
                        const name = input.name;
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        input.name = newName;
                    });
                });

                // Show empty message if no items
                if (items.length === 0) {
                    const listType = container.id.replace('-list', '');
                    const emptyMessage = document.createElement('div');
                    emptyMessage.className =
                        'text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg';
                    emptyMessage.textContent = `Belum ada ${listType}. Klik "Tambah" untuk menambahkan.`;
                    container.appendChild(emptyMessage);
                }
            }
        }

        // Auto-save draft functionality (optional)
        let autoSaveTimeout;
        document.addEventListener('input', function(e) {
            if (e.target.matches('input, textarea')) {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    console.log('Auto-saving draft...'); // Implement AJAX save here
                }, 2000);
            }
        });
    </script>


</x-admin.layouts>
