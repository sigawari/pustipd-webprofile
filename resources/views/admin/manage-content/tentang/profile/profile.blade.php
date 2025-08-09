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
        <form action="#" method="POST" enctype="multipart/form-data">
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
                        <x-admin.link_list 
                            label="Daftar Aplikasi"
                            type="applications"
                            placeholderName="Nama Aplikasi"
                            placeholderUrl="https://link-aplikasi.com"
                            :items="$profileData->applications ?? []"
                            emptyText="Belum ada aplikasi. Klik 'Tambah' untuk menambahkan."
                        />

                        <x-admin.link_list 
                            label="Daftar Lembaga"
                            type="institutions"
                            placeholderName="Nama Lembaga"
                            placeholderUrl="https://link-lembaga.com"
                            :items="$profileData->institutions ?? []"
                            emptyText="Belum ada lembaga. Klik 'Tambah' untuk menambahkan."
                        />

                        <x-admin.link_list 
                            label="Daftar Fakultas Universitas"
                            type="universities"
                            placeholderName="Nama Fakultas"
                            placeholderUrl="https://fakultas.univ.ac.id"
                            :items="$profileData->universities ?? []"
                            emptyText="Belum ada fakultas. Klik 'Tambah' untuk menambahkan."
                        />
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

</x-admin.layouts>
