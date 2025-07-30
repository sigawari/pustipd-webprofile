<!-- resources/views/admin/manage-content/about/profile.blade.php -->
<x-admin.layouts>
    @section('page-title', 'Profil PUSTIPD')
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
    @endsection

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Organization Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Organisasi
                        </label>
                        <input type="text" name="organization_name" value="PUSTIPD"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: PUSTIPD, PPID, dll">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi untuk Halaman Profil
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Deskripsi organisasi yang akan ditampilkan di halaman profil website..."></textarea>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea name="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Alamat lengkap organisasi..."></textarea>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" name="email"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="email@example.com">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Instagram
                                    </label>
                                    <input type="url" name="instagram_url"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://instagram.com/username">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Facebook
                                    </label>
                                    <input type="url" name="facebook_url"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://facebook.com/pagename">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        YouTube
                                    </label>
                                    <input type="url" name="youtube_url"
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
                            Foto Profil untuk Beranda
                        </label>
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
                                        Upload foto profil
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
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Daftar Aplikasi
                            </label>
                            <div id="applications-list" class="space-y-2">
                                <div class="flex gap-2 items-end">
                                    <div class="flex-1">
                                        <input type="text" name="applications[0][name]" placeholder="Nama Aplikasi"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div class="flex-1">
                                        <input type="url" name="applications[0][url]"
                                            placeholder="https://link-aplikasi.com"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <button type="button" onclick="removeListItem(this)"
                                        class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button"
                                onclick="addListItem('applications', 'Nama Aplikasi', 'https://link-aplikasi.com')"
                                class="mt-2 text-sm text-blue-600 hover:text-blue-700 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Aplikasi
                            </button>
                        </div>

                        <!-- Institutions List -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Daftar Lembaga
                            </label>
                            <div id="institutions-list" class="space-y-2">
                                <div class="flex gap-2 items-end">
                                    <div class="flex-1">
                                        <input type="text" name="institutions[0][name]" placeholder="Nama Lembaga"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div class="flex-1">
                                        <input type="url" name="institutions[0][url]"
                                            placeholder="https://link-lembaga.com"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <button type="button" onclick="removeListItem(this)"
                                        class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button"
                                onclick="addListItem('institutions', 'Nama Lembaga', 'https://link-lembaga.com')"
                                class="mt-2 text-sm text-blue-600 hover:text-blue-700 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Lembaga
                            </button>
                        </div>

                        <!-- Universities/Faculties List -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Daftar Fakultas Universitas
                            </label>
                            <div id="universities-list" class="space-y-2">
                                <div class="flex gap-2 items-end">
                                    <div class="flex-1">
                                        <input type="text" name="universities[0][faculty]"
                                            placeholder="Nama Fakultas"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div class="flex-1">
                                        <input type="url" name="universities[0][url]"
                                            placeholder="https://fakultas.univ.ac.id"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <button type="button" onclick="removeListItem(this)"
                                        class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button"
                                onclick="addListItem('universities', 'Nama Fakultas', 'https://fakultas.univ.ac.id')"
                                class="mt-2 text-sm text-blue-600 hover:text-blue-700 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Fakultas
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <button type="button"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-custom-blue transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk dynamic lists dan image preview -->
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
            const index = container.children.length;

            let nameField = listType === 'universities' ? 'faculty' : 'name';

            const newItem = document.createElement('div');
            newItem.className = 'flex gap-2 items-end';
            newItem.innerHTML = `
        <div class="flex-1">
            <input type="text" name="${listType}[${index}][${nameField}]" placeholder="${namePlaceholder}"
                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div class="flex-1">
            <input type="url" name="${listType}[${index}][url]" placeholder="${urlPlaceholder}"
                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <button type="button" onclick="removeListItem(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;

            container.appendChild(newItem);
        }

        // Remove list item
        function removeListItem(button) {
            button.closest('.flex').remove();

            // Re-index remaining items
            const container = button.closest('.space-y-2');
            const items = container.querySelectorAll('.flex');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input');
                inputs.forEach(input => {
                    const name = input.name;
                    const newName = name.replace(/\[\d+\]/, `[${index}]`);
                    input.name = newName;
                });
            });
        }
    </script>

</x-admin.layouts>
