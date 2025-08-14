<!-- Modal Edit Pengumuman -->
@foreach ($kelolaPengumumans as $pengumuman)
    <!-- Modal Tambah pengumuman Lengkap -->
    <div id="UpdateModal-{{ $pengumuman->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto md:max-h-none md:overflow-visible">

            <!-- Header -->
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-secondary mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.671a.75.75 0 01-.92-.92l.67-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                </svg>
                <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form -->
            <form id="editForm-{{ $pengumuman->id }}" method="POST"
                action="{{ route('admin.informasi-terkini.kelola-pengumuman.update', $pengumuman->id) }}"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Judul Pengumuman -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required
                            value="{{ old('title', $pengumuman->title) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: Maintenance Server SIMAK Terjadwal"
                            onkeyup="autoSlug('#title', '#slug')">
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug URL</label>
                        <input type="text" id="slug" name="slug"
                            value="{{ old('slug', $pengumuman->slug) }}"
                            readonly
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Kategori</option>
                            <option value="maintenance" {{ old('category', $pengumuman->category) == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                            <option value="layanan" {{ old('category', $pengumuman->category) == 'layanan' ? 'selected' : '' }}>💡 Layanan IT</option>
                            <option value="infrastruktur" {{ old('category', $pengumuman->category) == 'infrastruktur' ? 'selected' : '' }}>🌐 Infrastruktur</option>
                            <option value="administrasi" {{ old('category', $pengumuman->category) == 'administrasi' ? 'selected' : '' }}>📋 Administrasi</option>
                            <option value="darurat" {{ old('category', $pengumuman->category) == 'darurat' ? 'selected' : '' }}>🚨 Darurat</option>
                        </select>
                    </div>

                    <!-- Urgency -->
                    <div>
                        <label for="urgency" class="block text-sm font-medium text-gray-700 mb-2">
                            Prioritas <span class="text-red-500">*</span>
                        </label>
                        <select id="urgency" name="urgency" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="normal" {{ old('urgency', $pengumuman->urgency) == 'normal' ? 'selected' : '' }}>📢 Normal</option>
                            <option value="penting" {{ old('urgency', $pengumuman->urgency) == 'penting' ? 'selected' : '' }}>⚠️ Penting</option>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="date" name="date" required
                            value="{{ old('date', $pengumuman->date) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Berlaku Sampai -->
                    <div>
                        <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-2">
                            Berlaku Sampai
                        </label>
                        <input type="datetime-local" id="valid_until" name="valid_until"
                            value="{{ old('valid_until', $pengumuman->valid_until ? \Carbon\Carbon::parse($pengumuman->valid_until)->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Opsional - kosongkan jika permanen</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="draft" {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                            <option value="published" {{ old('status', $pengumuman->status) == 'published' ? 'selected' : '' }}>✅ Published</option>
                            <option value="archived" {{ old('status', $pengumuman->status) == 'archived' ? 'selected' : '' }}>📦 Archived</option>
                        </select>
                    </div>
                </div>

                <!-- Content Editor -->
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Pengumuman <span class="text-red-500">*</span>
                        </label>

                        {{-- Editor Quill --}}
                        <div id="editor" style="height: 200px;">{!! old('content', $pengumuman->content) !!}</div>

                        {{-- Hidden textarea untuk submit --}}
                        <textarea id="content" name="content" class="hidden" required>{!! old('content', $pengumuman->content) !!}</textarea>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeUpdateModal('{{ $pengumuman->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-secondary rounded-lg hover:bg-gray-600 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X -->
            <button onclick="closeUpdateModal('{{ $pengumuman->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
