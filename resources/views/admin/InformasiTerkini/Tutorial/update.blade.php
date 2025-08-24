<!-- Modal Edit Tutorial -->
@foreach ($kelolaTutorials as $tutorial)
    <div id="UpdateModal-{{ $tutorial->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
                </div>

                <button onclick="closeUpdateModal('{{ $tutorial->id }}')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="editForm-{{ $tutorial->id }}" method="POST"
                action="{{ route('admin.informasi-terkini.kelola-tutorial.update', $tutorial->id) }}" class="space-y-6"
                onsubmit="return validateAndSubmitUpdate(event, '{{ $tutorial->id }}')" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Info Dasar Tutorial -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Judul Tutorial -->
                        <div class="md:col-span-2">
                            <label for="title-{{ $tutorial->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Tutorial <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title-{{ $tutorial->id }}" name="title" required
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                                value="{{ old('title', $tutorial->title) }}"
                                onkeyup="autoSlug('#title-{{ $tutorial->id }}', '#slug-{{ $tutorial->id }}')">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug-{{ $tutorial->id }}"
                                class="block text-sm font-medium text-gray-700 mb-2">Slug URL</label>
                            <input type="text" id="slug-{{ $tutorial->id }}" name="slug" readonly
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                value="{{ old('slug', $tutorial->slug) }}">
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category-{{ $tutorial->id }}"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select id="category-{{ $tutorial->id }}" name="category" required
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                <option value="sistem_informasi_akademik" @selected($tutorial->category == 'sistem_informasi_akademik')>📚 Sistem
                                    Informasi Akademik</option>
                                <option value="e_learning" @selected($tutorial->category == 'e_learning')>💻 E-Learning</option>
                                <option value="layanan_digital_mahasiswa" @selected($tutorial->category == 'layanan_digital_mahasiswa')>🎓 Layanan
                                    Digital Mahasiswa</option>
                                <option value="pengelolaan_data_akun" @selected($tutorial->category == 'pengelolaan_data_akun')>🔑 Pengelolaan Data
                                    Akun</option>
                                <option value="jaringan_konektivitas" @selected($tutorial->category == 'jaringan_konektivitas')>🌐 Jaringan &
                                    Konektivitas</option>
                                <option value="software_aplikasi" @selected($tutorial->category == 'software_aplikasi')>🛠️ Software & Aplikasi
                                </option>
                                <option value="keamanan_digital" @selected($tutorial->category == 'keamanan_digital')>🔒 Keamanan Digital
                                </option>
                                <option value="penelitian_akademik" @selected($tutorial->category == 'penelitian_akademik')>📖 Penelitian Akademik
                                </option>
                                <option value="layanan_publik" @selected($tutorial->category == 'layanan_publik')>🏛️ Layanan Publik</option>
                            </select>
                        </div>

                        <!-- Tanggal Publish -->
                        <div>
                            <label for="date-{{ $tutorial->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Publikasi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="date-{{ $tutorial->id }}" name="date" required
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                                value="{{ old('date', $tutorial->date ? date('Y-m-d', strtotime($tutorial->date)) : date('Y-m-d')) }}">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status-{{ $tutorial->id }}"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status-{{ $tutorial->id }}" name="status" required
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="draft" @selected($tutorial->status == 'draft')>📝 Draft</option>
                                <option value="published" @selected($tutorial->status == 'published')>✅ Published</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Content Builder Section -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Konten Tutorial
                    </h3>

                    <!-- Content Blocks Container -->
                    <div id="contentBlocks-{{ $tutorial->id }}" class="space-y-3">
                        @if ($tutorial->content_blocks)
                            @php
                                $contentBlocks = $tutorial->content_blocks;

                                if (is_null($contentBlocks)) {
                                    $contentBlocks = [];
                                } elseif (!is_array($contentBlocks)) {
                                    // Kalau entah kenapa masih string JSON
                                    $decoded = json_decode((string) $contentBlocks, true);
                                    $contentBlocks = is_array($decoded) ? $decoded : [];
                                }

                                usort($contentBlocks, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
                            @endphp

                            @foreach ($contentBlocks as $index => $block)
                                @php
                                    $blockType = $block['type'] ?? null;
                                @endphp
                                @if ($blockType === 'step')
                                    <div class="content-block bg-white border border-gray-200 rounded-lg p-4"
                                        data-type="step" data-id="{{ $block['id'] }}" draggable="true">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">
                                                    {{ $loop->iteration }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">Langkah Tutorial</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button type="button"
                                                    class="drag-handle cursor-move text-gray-400 hover:text-gray-600 p-1"
                                                    title="Drag untuk mengatur urutan">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 8V4m0 0h4M4 4l5 5m11-5v4m0-4h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="delete-block-btn text-red-400 hover:text-red-600 p-1"
                                                    data-block-id="{{ $block['id'] }}" title="Hapus langkah">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="space-y-3">
                                            <input type="hidden" name="content_blocks[{{ $block['id'] }}][type]"
                                                value="step">
                                            <input type="hidden" name="content_blocks[{{ $block['id'] }}][order]"
                                                value="{{ $block['order'] ?? $index + 1 }}" class="block-order">

                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Judul
                                                    Langkah</label>
                                                <input type="text"
                                                    name="content_blocks[{{ $block['id'] }}][title]"
                                                    class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                                                    value="{{ $block['title'] ?? '' }}"
                                                    placeholder="Contoh: Persiapan Awal">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Deskripsi
                                                    Langkah</label>
                                                <textarea name="content_blocks[{{ $block['id'] }}][content]" rows="3"
                                                    class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                                                    placeholder="Jelaskan langkah ini secara detail...">{{ $block['content'] ?? '' }}</textarea>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Gambar
                                                    (Opsional)
                                                </label>
                                                @if (isset($block['image']))
                                                    <div class="mb-2">
                                                        <img src="{{ asset($block['image']) }}" alt="Step Image"
                                                            class="w-20 h-20 object-cover rounded border">
                                                        <p class="text-xs text-gray-500">Gambar saat ini</p>
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    name="content_blocks[{{ $block['id'] }}][image]"
                                                    accept="image/*"
                                                    class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal
                                                    2MB. Kosongkan jika tidak ingin ganti.</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($blockType === 'tip')
                                    <div class="content-block bg-yellow-50 border border-yellow-200 rounded-lg p-4"
                                        data-type="tip" data-id="{{ $block['id'] }}" draggable="true">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-xs mr-2">
                                                    💡
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">Tips & Highlight</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button type="button"
                                                    class="drag-handle cursor-move text-gray-400 hover:text-gray-600 p-1"
                                                    title="Drag untuk mengatur urutan">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 8V4m0 0h4M4 4l5 5m11-5v4m0-4h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="delete-block-btn text-red-400 hover:text-red-600 p-1"
                                                    data-block-id="{{ $block['id'] }}" title="Hapus tips">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="space-y-3">
                                            <input type="hidden" name="content_blocks[{{ $block['id'] }}][type]"
                                                value="tip">
                                            <input type="hidden" name="content_blocks[{{ $block['id'] }}][order]"
                                                value="{{ $block['order'] ?? $index + 1 }}" class="block-order">

                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Tipe
                                                    Tips</label>
                                                <select name="content_blocks[{{ $block['id'] }}][tip_type]"
                                                    class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                                                    <option value="tips" @selected(($block['tip_type'] ?? '') == 'tips')>💡 Tips
                                                        Penting
                                                    </option>
                                                    <option value="perhatian" @selected(($block['tip_type'] ?? '') == 'perhatian')>⚠️
                                                        Perhatian</option>
                                                    <option value="warning" @selected(($block['tip_type'] ?? '') == 'warning')>🚨 Warning
                                                    </option>
                                                    <option value="info" @selected(($block['tip_type'] ?? '') == 'info')>ℹ️ Informasi
                                                    </option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Konten
                                                    Tips</label>
                                                <textarea name="content_blocks[{{ $block['id'] }}][content]" rows="2"
                                                    class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                                                    placeholder="Masukkan tips atau informasi penting...">{{ $block['content'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Tombol Tambah Content -->
                    <div class="flex gap-2 mt-4">
                        <button type="button" id="addStepBtn-{{ $tutorial->id }}"
                            class="flex-1 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Langkah
                        </button>
                        <button type="button" id="addTipBtn-{{ $tutorial->id }}"
                            class="flex-1 px-3 py-2 text-sm bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            Tambah Tips
                        </button>
                    </div>

                    <!-- Info Helper -->
                    <div class="mt-3 p-3 bg-white rounded border border-blue-200">
                        <p class="text-xs text-blue-700">
                            <strong>Petunjuk:</strong> Anda dapat menambahkan langkah-langkah tutorial dan tips dalam
                            urutan yang diinginkan.
                            Gunakan drag & drop untuk mengatur ulang urutan konten.
                        </p>
                    </div>
                </div>

                <!-- Tombol Action -->
                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" onclick="closeUpdateModal('{{ $tutorial->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Update Tutorial
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk setiap modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize update functionality untuk tutorial {{ $tutorial->id }}
            initializeUpdateModal('{{ $tutorial->id }}');
        });

        function initializeUpdateModal(tutorialId) {
            // Event listener untuk tombol tambah step/tip
            const addStepBtn = document.getElementById(`addStepBtn-${tutorialId}`);
            const addTipBtn = document.getElementById(`addTipBtn-${tutorialId}`);

            if (addStepBtn) {
                addStepBtn.addEventListener('click', () => {
                    addContentBlockToUpdate('step', tutorialId);
                });
            }

            if (addTipBtn) {
                addTipBtn.addEventListener('click', () => {
                    addContentBlockToUpdate('tip', tutorialId);
                });
            }

            // Event delegation untuk delete buttons
            document.addEventListener('click', (e) => {
                if (e.target.closest('.delete-block-btn') &&
                    e.target.closest(`#UpdateModal-${tutorialId}`)) {
                    e.preventDefault();
                    const button = e.target.closest('.delete-block-btn');
                    const blockId = button.getAttribute('data-block-id');
                    removeContentBlockFromUpdate(blockId, tutorialId);
                }
            });
        }

        function addContentBlockToUpdate(type, tutorialId) {
            const container = document.getElementById(`contentBlocks-${tutorialId}`);
            if (!container) return;

            const blockId = `new_block_${Date.now()}`;
            let blockHtml = '';

            if (type === 'step') {
                const stepNumber = container.querySelectorAll('[data-type="step"]').length + 1;
                blockHtml = createStepBlockHtml(blockId, stepNumber);
            } else if (type === 'tip') {
                blockHtml = createTipBlockHtml(blockId);
            }

            container.insertAdjacentHTML('beforeend', blockHtml);
            updateStepNumbersInModal(tutorialId);
        }

        function removeContentBlockFromUpdate(blockId, tutorialId) {
            const block = document.querySelector(`#UpdateModal-${tutorialId} [data-id="${blockId}"]`);
            if (block) {
                block.remove();
                updateStepNumbersInModal(tutorialId);
            }
        }

        function updateStepNumbersInModal(tutorialId) {
            const container = document.getElementById(`contentBlocks-${tutorialId}`);
            const stepBlocks = container.querySelectorAll('[data-type="step"]');
            stepBlocks.forEach((block, index) => {
                const numberElement = block.querySelector('.w-6.h-6.bg-blue-600');
                if (numberElement) {
                    numberElement.textContent = index + 1;
                }
            });
        }

        function validateAndSubmitUpdate(event, tutorialId) {
            const blocks = document.querySelectorAll(`#UpdateModal-${tutorialId} .content-block`);
            if (blocks.length === 0) {
                alert('Minimal tambahkan 1 langkah tutorial!');
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Helper functions untuk create HTML blocks
        function createStepBlockHtml(blockId, stepNumber) {
            return `
                <div class="content-block bg-white border border-gray-200 rounded-lg p-4" data-type="step" data-id="${blockId}" draggable="true">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">
                                ${stepNumber}
                            </div>
                            <span class="text-sm font-medium text-gray-700">Langkah Tutorial</span>
                        </div>
                        <button type="button" class="delete-block-btn text-red-400 hover:text-red-600 p-1" data-block-id="${blockId}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <input type="hidden" name="content_blocks[${blockId}][type]" value="step">
                        <input type="hidden" name="content_blocks[${blockId}][order]" value="${stepNumber}" class="block-order">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Judul Langkah</label>
                            <input type="text" name="content_blocks[${blockId}][title]" class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Persiapan Awal">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Deskripsi Langkah</label>
                            <textarea name="content_blocks[${blockId}][content]" rows="3" class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Jelaskan langkah ini secara detail..."></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Gambar (Opsional)</label>
                            <input type="file" name="content_blocks[${blockId}][image]" accept="image/*" class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            `;
        }

        function createTipBlockHtml(blockId) {
            return `
                <div class="content-block bg-yellow-50 border border-yellow-200 rounded-lg p-4" data-type="tip" data-id="${blockId}" draggable="true">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-xs mr-2">💡</div>
                            <span class="text-sm font-medium text-gray-700">Tips & Highlight</span>
                        </div>
                        <button type="button" class="delete-block-btn text-red-400 hover:text-red-600 p-1" data-block-id="${blockId}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <input type="hidden" name="content_blocks[${blockId}][type]" value="tip">
                        <input type="hidden" name="content_blocks[${blockId}][order]" value="1" class="block-order">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Tipe Tips</label>
                            <select name="content_blocks[${blockId}][tip_type]" class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                                <option value="tips">💡 Tips Penting</option>
                                <option value="perhatian">⚠️ Perhatian</option>
                                <option value="warning">🚨 Warning</option>
                                <option value="info">ℹ️ Informasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Konten Tips</label>
                            <textarea name="content_blocks[${blockId}][content]" rows="2" class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Masukkan tips atau informasi penting..."></textarea>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
@endforeach
