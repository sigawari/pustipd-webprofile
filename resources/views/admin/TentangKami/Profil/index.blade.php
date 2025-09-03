<!-- resources/views/admin/manage-content/about/profil.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <form
            action="{{ isset($profilData)
                ? route('admin.tentang-kami.profil.update', $profilData)
                : route('admin.tentang-kami.profil.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($profilData))
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
                            value="{{ old('organization_name', $profilData->organization_name ?? 'PUSTIPD') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: PUSTIPD, PPID, dll">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi untuk Halaman {{ $title }}
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Deskripsi organisasi yang akan ditampilkan di halaman {{ $title }} website...">{{ old('description', $profilData->description ?? '') }}</textarea>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea name="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Alamat lengkap organisasi...">{{ old('address', $profilData->address ?? '') }}</textarea>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email"
                                    value="{{ old('email', $profilData->email ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="email@example.com">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                                    <input type="url" name="instagram_url"
                                        value="{{ old('instagram_url', $profilData->instagram_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://instagram.com/username">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                                    <input type="url" name="facebook_url"
                                        value="{{ old('facebook_url', $profilData->facebook_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://facebook.com/pagename">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                                    <input type="url" name="youtube_url"
                                        value="{{ old('youtube_url', $profilData->youtube_url ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://youtube.com/channel">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto {{ $title }} untuk Hero
                        </label>

                        <!-- Current Hero Photo Preview -->
                        @if (isset($profilData->hero_image) && $profilData->hero_image)
                            <div class="mb-4">
                                <img src="{{ Storage::url($profilData->hero_image) }}" alt="Current Hero Photo"
                                    class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <div id="hero-preview" class="hidden mb-4">
                                <img id="hero-preview-img" src="" alt="Preview"
                                    class="mx-auto h-32 w-auto rounded-lg object-cover">
                            </div>
                            <svg id="hero-upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0
                     01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172
                     a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                            </svg>
                            <div class="mt-4">
                                <label for="hero-photo-upload" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-gray-900">
                                        {{ isset($profilData->hero_image) ? 'Ganti foto hero' : 'Upload foto hero' }}
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        PNG, JPG up to 5MB (disarankan 1200x800px)
                                    </span>
                                </label>
                                <input id="hero-photo-upload" name="hero_image" type="file" class="sr-only"
                                    accept="image/*" onchange="previewHeroImage(this)">
                            </div>
                        </div>
                    </div>

                    <script>
                        function previewHeroImage(input) {
                            const file = input.files[0];
                            const previewContainer = document.getElementById('hero-preview');
                            const previewImg = document.getElementById('hero-preview-img');
                            const uploadIcon = document.getElementById('hero-upload-icon');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = e => {
                                    previewImg.src = e.target.result;
                                    previewContainer.classList.remove('hidden');
                                    if (uploadIcon) uploadIcon.style.display = 'none';
                                };
                                reader.readAsDataURL(file);
                            } else {
                                previewContainer.classList.add('hidden');
                                if (uploadIcon) uploadIcon.style.display = 'block';
                            }
                        }
                    </script>

                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Profile Photo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto {{ $title }} untuk Tentang Kami
                        </label>

                        <!-- Current Photo Preview -->
                        @if (isset($profilData->profil_photo) && $profilData->profil_photo)
                            <div class="mb-4">
                                <img src="{{ Storage::url($profilData->profil_photo) }}" alt="Current Photo"
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
                                        {{ isset($profilData->profil_photo) ? 'Ganti foto profile' : 'Upload foto profile' }}
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        PNG, JPG up to 5MB (disarankan 1200x800px)
                                    </span>
                                </label>
                                <input id="profile-photo-upload" name="profil_photo" type="file" class="sr-only"
                                    accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>
                    </div>

                    <!-- Lists Section -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Daftar Links</h3>
                        <x-admin.linkList label="Daftar Aplikasi" type="applications" placeholderName="Nama Aplikasi"
                            placeholderUrl="https://link-aplikasi.com" :items="$profilData->applications ?? []"
                            emptyText="Belum ada aplikasi. Klik 'Tambah' untuk menambahkan." />

                        <x-admin.linkList label="Daftar Lembaga" type="institutions" placeholderName="Nama Lembaga"
                            placeholderUrl="https://link-lembaga.com" :items="$profilData->institutions ?? []"
                            emptyText="Belum ada lembaga. Klik 'Tambah' untuk menambahkan." />

                        <x-admin.linkList label="Daftar Fakultas Universitas" type="universities"
                            placeholderName="Nama Fakultas" placeholderUrl="https://fakultas.univ.ac.id"
                            :items="$profilData->universities ?? []" emptyText="Belum ada fakultas. Klik 'Tambah' untuk menambahkan." />
                    </div>
                </div>
            </div>

            <!-- Button Save and Delete -->
             <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-200">
                <!-- Save and Update -->
                 @if (isset($profilData))
                    <!-- Tombol Update -->
                    <button type="submit"
                        class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-custom-blue transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                        Simpan Perubahan
                    </button>
                @else
                    <!-- Tombol Create -->
                    <button type="submit"
                        class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-custom-blue transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                        Simpan Data {{ $title }}
                    </button>
                @endif
                <!-- Delete -->
                @if (isset($profilData))
                    <button type="button" onclick="openDeleteModal('{{ $profilData->id }}')"
                        class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors duration-200 text-sm sm:text-base">
                        Hapus Semua
                    </button>
                @endif
            </div>
        </form>
    </div>
    @include('admin.TentangKami.Profil.delete')

</x-admin.layouts>
