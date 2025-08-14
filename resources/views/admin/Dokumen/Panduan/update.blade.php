@foreach ($panduans as $panduan)
    <!-- Modal Edit Panduan -->
    <div id="UpdateModal-{{ $panduan->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

            <!-- Form -->
            <form id="editForm" method="POST"
                action="{{ route('admin.dokumen.panduan.update', $panduan->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Panduan -->
                <div class="mb-4">
                    <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-2">Judul Panduan</label>
                    <input type="text" name="title" id="edit_title" required
                        value="{{ old('title', $panduan->title) }}" placeholder="Masukkan judul panduan..."
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="edit_description" rows="4" required placeholder="Tulis deskripsi panduan..."
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $panduan->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="mb-4">
                    <label for="edit_file" class="block text-sm font-medium text-gray-700 mb-2">
                        File Dokumen (Opsional)
                    </label>

                    <!-- Input File -->
                    <input type="file" name="file" id="edit_file" accept=".pdf,.doc,.docx"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                    <p class="mt-1 text-xs text-gray-500">
                        Kosongkan jika tidak ingin mengganti file. Format: PDF, DOC, DOCX. Maksimal 10MB
                    </p>

                    <!-- File Sebelumnya -->
                    @if ($panduan->file_path)
                        <div class="mt-2 p-2 bg-gray-50 border border-gray-200 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">File saat ini:</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.5L14.5 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <a href="{{ asset('storage/' . $panduan->file_path) }}" target="_blank"
                                    class="text-blue-600 text-sm truncate max-w-[200px] hover:underline">
                                    {{ $panduan->original_filename }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @error('file')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Terbit -->
                <div class="mb-4">
                    <label for="edit_year_published" class="block text-sm font-medium text-gray-700 mb-2">
                        Tahun Terbit <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <input type="number" name="year_published" id="edit_year_published" min="1900"
                        max="{{ date('Y') + 1 }}" value="{{ old('year_published', $panduan->year_published) }}"
                        placeholder="{{ date('Y') }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('year_published')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status (Hidden - Default Draft) -->
                <input type="hidden" name="status" value="{{ old('status', $panduan->status) }}">

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $panduan->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <!-- Icon X -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                        <!-- Icon Update -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $panduan->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
