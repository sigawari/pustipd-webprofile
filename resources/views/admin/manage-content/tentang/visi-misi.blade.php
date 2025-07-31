<!-- resources/views/admin/manage-content/about/profile.blade.php -->
<x-admin.layouts>
    @section('page-title', 'Visi Misi PUSTIPD')
    @section('page-description', 'Kelola konten visi misi PUSTIPD')
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
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Visi Misi PUSTIPD</span>
            </div>
        </li>
    @endsection

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Visi & Misi</h2>
                <p class="text-gray-600 mt-1">Kelola visi dan misi PUSTIPD UIN Raden Fatah Palembang</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.manage-content.tentang.profil.preview') }}" target="_blank"
                    class="px-4 py-2 border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-50 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Preview di Website
                </a>
            </div>
        </div>

        <!-- Form Content -->
        <form id="visiMisiForm">
            <!-- Visi Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Visi PUSTIPD</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Single Entry</span>
                </div>

                <div class="space-y-3">
                    <label for="visi" class="block text-sm font-medium text-gray-700">Deskripsi Visi</label>
                    <textarea id="visi" name="visi" rows="4" required
                        class="w-full px-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                        placeholder="Tuliskan visi PUSTIPD UIN Raden Fatah Palembang..."></textarea>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Minimum 50 karakter</span>
                        <span id="visiCharCount">0 / 500 karakter</span>
                    </div>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Misi PUSTIPD</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Multiple Entries</span>
                        <button type="button" onclick="addMisiEntry()"
                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Misi
                        </button>
                    </div>
                </div>

                <!-- Misi Entries Container -->
                <div id="misiContainer" class="space-y-4">
                    <!-- Misi entries akan ditambahkan di sini -->
                </div>

                <!-- Empty State -->
                <div id="misiEmptyState" class="text-center py-8 border-2 border-dashed border-gray-200 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm mb-3">Belum ada misi yang ditambahkan</p>
                    <button type="button" onclick="addMisiEntry()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Tambah Misi Pertama
                    </button>
                </div>
            </div>

            <!-- Status Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500 mr-2">Terakhir disimpan:</span>
                        <span id="lastSavedTime" class="text-xs text-green-600 font-medium">Belum disimpan</span>
                    </div>
                </div>
                <select id="status" name="status" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="draft">Draft - Belum dipublikasikan</option>
                    <option value="published">Published - Tampil di website</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Preview Modal -->
    <div id="visiMisiPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closePreviewModal()">
            </div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="text-center mb-6">
                        <h3 class="text-xl leading-6 font-bold text-gray-900">Preview Visi & Misi PUSTIPD</h3>
                        <p class="text-sm text-gray-600 mt-2">Tampilan yang akan muncul di website</p>
                    </div>

                    <!-- Preview Content -->
                    <div class="space-y-8">
                        <!-- Visi Preview -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900">Visi</h4>
                                    <p class="text-sm text-gray-600">Pandangan masa depan PUSTIPD</p>
                                </div>
                            </div>
                            <div id="previewVisiContent" class="text-gray-700 leading-relaxed">
                                <!-- Visi content akan diisi oleh JavaScript -->
                            </div>
                        </div>

                        <!-- Misi Preview -->
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900">Misi</h4>
                                    <p class="text-sm text-gray-600">Langkah strategis mencapai visi</p>
                                </div>
                            </div>
                            <div id="previewMisiContent" class="space-y-3">
                                <!-- Misi content akan diisi oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closePreviewModal()"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                        Tutup Preview
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            'use strict';

            const VisiMisiManager = {
                misiCounter: 0,
                visiData: '',
                misiData: [],

                init() {
                    this.loadExistingData();
                    this.bindEvents();
                    this.updateUI();
                },

                loadExistingData() {
                    // Load existing data (dalam implementasi nyata, data akan dimuat dari server)
                    this.visiData =
                        'Menjadi pusat unggulan dalam pengembangan teknologi informasi dan pelayanan digital yang mendukung kemajuan pendidikan Islam di Indonesia.';
                    this.misiData = [
                        'Mengembangkan sistem informasi terintegrasi untuk mendukung operasional universitas',
                        'Menyediakan layanan teknologi informasi yang berkualitas dan mudah diakses',
                        'Meningkatkan kompetensi SDM dalam bidang teknologi informasi'
                    ];

                    // Populate form with existing data
                    document.getElementById('visi').value = this.visiData;

                    // Load existing misi
                    this.misiData.forEach((misi, index) => {
                        this.addMisiEntry(misi, index + 1);
                    });
                },

                bindEvents() {
                    // Visi character counter
                    const visiTextarea = document.getElementById('visi');
                    if (visiTextarea) {
                        visiTextarea.addEventListener('input', () => {
                            this.updateVisiCharCount();
                        });
                        this.updateVisiCharCount(); // Initial count
                    }

                    // Form auto-save (optional)
                    const form = document.getElementById('visiMisiForm');
                    if (form) {
                        // Auto-save every 30 seconds
                        setInterval(() => {
                            this.autoSave();
                        }, 30000);
                    }
                },

                updateVisiCharCount() {
                    const visiTextarea = document.getElementById('visi');
                    const charCounter = document.getElementById('visiCharCount');

                    if (visiTextarea && charCounter) {
                        const length = visiTextarea.value.length;
                        charCounter.textContent = `${length} / 500 karakter`;

                        // Update color based on character count
                        if (length > 500) {
                            charCounter.classList.add('text-red-600');
                            charCounter.classList.remove('text-gray-500');
                        } else if (length < 50) {
                            charCounter.classList.add('text-yellow-600');
                            charCounter.classList.remove('text-gray-500', 'text-red-600');
                        } else {
                            charCounter.classList.add('text-green-600');
                            charCounter.classList.remove('text-gray-500', 'text-red-600', 'text-yellow-600');
                        }
                    }
                },

                addMisiEntry(existingText = '', misiNumber = null) {
                    this.misiCounter++;
                    const number = misiNumber || this.misiCounter;
                    const container = document.getElementById('misiContainer');
                    const emptyState = document.getElementById('misiEmptyState');

                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }

                    const misiDiv = document.createElement('div');
                    misiDiv.className = 'misi-entry bg-gray-50 border border-gray-200 rounded-lg p-4';
                    misiDiv.dataset.misiId = number;

                    misiDiv.innerHTML = `
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full mr-2">${number}</span>
                                <h4 class="text-sm font-medium text-gray-900">Misi ${number}</h4>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="VisiMisiManager.editMisiEntry(${number})" 
                                        class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button type="button" onclick="VisiMisiManager.deleteMisiEntry(${number})" 
                                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="misi-content">
                            <textarea name="misi_${number}" id="misi_${number}" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                                      placeholder="Tuliskan misi ke-${number}...">${existingText}</textarea>
                            <div class="flex items-center justify-between text-xs text-gray-500 mt-2">
                                <span>Minimum 20 karakter</span>
                                <span class="misi-char-count">0 / 200 karakter</span>
                            </div>
                        </div>
                    `;

                    container.appendChild(misiDiv);

                    // Add character counter for this misi
                    const textarea = misiDiv.querySelector(`#misi_${number}`);
                    const charCounter = misiDiv.querySelector('.misi-char-count');

                    if (textarea && charCounter) {
                        const updateCharCount = () => {
                            const length = textarea.value.length;
                            charCounter.textContent = `${length} / 200 karakter`;

                            if (length > 200) {
                                charCounter.classList.add('text-red-600');
                            } else if (length < 20) {
                                charCounter.classList.add('text-yellow-600');
                            } else {
                                charCounter.classList.add('text-green-600');
                            }
                        };

                        textarea.addEventListener('input', updateCharCount);
                        updateCharCount(); // Initial count
                    }

                    this.updateUI();
                },

                editMisiEntry(misiId) {
                    const misiDiv = document.querySelector(`[data-misi-id="${misiId}"]`);
                    if (misiDiv) {
                        const textarea = misiDiv.querySelector(`#misi_${misiId}`);
                        if (textarea) {
                            textarea.focus();
                            textarea.select();
                        }
                    }
                },

                deleteMisiEntry(misiId) {
                    if (confirm(`Apakah Anda yakin ingin menghapus Misi ${misiId}?`)) {
                        const misiDiv = document.querySelector(`[data-misi-id="${misiId}"]`);
                        if (misiDiv) {
                            misiDiv.remove();
                            this.reorderMisiEntries();
                            this.updateUI();
                        }
                    }
                },

                reorderMisiEntries() {
                    const misiEntries = document.querySelectorAll('.misi-entry');
                    misiEntries.forEach((entry, index) => {
                        const newNumber = index + 1;
                        const oldId = entry.dataset.misiId;

                        // Update data attribute
                        entry.dataset.misiId = newNumber;

                        // Update number badge
                        const badge = entry.querySelector('.w-6.h-6');
                        if (badge) {
                            badge.textContent = newNumber;
                        }

                        // Update title
                        const title = entry.querySelector('h4');
                        if (title) {
                            title.textContent = `Misi ${newNumber}`;
                        }

                        // Update textarea name and id
                        const textarea = entry.querySelector('textarea');
                        if (textarea) {
                            textarea.name = `misi_${newNumber}`;
                            textarea.id = `misi_${newNumber}`;
                            textarea.placeholder = `Tuliskan misi ke-${newNumber}...`;
                        }

                        // Update onclick handlers
                        const editBtn = entry.querySelector('[title="Edit"]');
                        const deleteBtn = entry.querySelector('[title="Hapus"]');

                        if (editBtn) {
                            editBtn.setAttribute('onclick', `VisiMisiManager.editMisiEntry(${newNumber})`);
                        }

                        if (deleteBtn) {
                            deleteBtn.setAttribute('onclick',
                                `VisiMisiManager.deleteMisiEntry(${newNumber})`);
                        }
                    });

                    this.misiCounter = misiEntries.length;
                },

                updateUI() {
                    const misiEntries = document.querySelectorAll('.misi-entry');
                    const emptyState = document.getElementById('misiEmptyState');

                    if (misiEntries.length === 0) {
                        if (emptyState) {
                            emptyState.style.display = 'block';
                        }
                    } else {
                        if (emptyState) {
                            emptyState.style.display = 'none';
                        }
                    }
                },

                validateForm() {
                    const visi = document.getElementById('visi').value.trim();
                    const misiEntries = document.querySelectorAll('.misi-entry textarea');

                    // Validate visi
                    if (visi.length < 50) {
                        alert('Visi harus minimal 50 karakter');
                        document.getElementById('visi').focus();
                        return false;
                    }

                    if (visi.length > 500) {
                        alert('Visi maksimal 500 karakter');
                        document.getElementById('visi').focus();
                        return false;
                    }

                    // Validate misi
                    if (misiEntries.length === 0) {
                        alert('Minimal harus ada 1 misi');
                        return false;
                    }

                    for (let i = 0; i < misiEntries.length; i++) {
                        const misiText = misiEntries[i].value.trim();
                        if (misiText.length < 20) {
                            alert(`Misi ${i + 1} harus minimal 20 karakter`);
                            misiEntries[i].focus();
                            return false;
                        }

                        if (misiText.length > 200) {
                            alert(`Misi ${i + 1} maksimal 200 karakter`);
                            misiEntries[i].focus();
                            return false;
                        }
                    }

                    return true;
                },

                collectFormData() {
                    const visi = document.getElementById('visi').value.trim();
                    const status = document.getElementById('status').value;
                    const misiEntries = document.querySelectorAll('.misi-entry textarea');
                    const misiList = [];

                    misiEntries.forEach((textarea, index) => {
                        misiList.push({
                            number: index + 1,
                            text: textarea.value.trim()
                        });
                    });

                    return {
                        visi: visi,
                        misi: misiList,
                        status: status,
                        updated_at: new Date().toISOString()
                    };
                },

                saveVisiMisi() {
                    if (!this.validateForm()) {
                        return;
                    }

                    const formData = this.collectFormData();

                    console.log('Saving Visi Misi:', formData);

                    // Simulate API call
                    setTimeout(() => {
                        const lastSavedTime = document.getElementById('lastSavedTime');
                        if (lastSavedTime) {
                            lastSavedTime.textContent = new Date().toLocaleString('id-ID');
                            lastSavedTime.classList.remove('text-green-600');
                            lastSavedTime.classList.add('text-blue-600');
                        }

                        alert('Visi & Misi berhasil disimpan!');
                    }, 1000);
                },

                autoSave() {
                    const formData = this.collectFormData();

                    // Only auto-save if there's content
                    if (formData.visi.length > 0 || formData.misi.length > 0) {
                        console.log('Auto-saving...', formData);

                        const lastSavedTime = document.getElementById('lastSavedTime');
                        if (lastSavedTime) {
                            lastSavedTime.textContent = 'Auto-saved: ' + new Date().toLocaleTimeString('id-ID');
                            lastSavedTime.classList.remove('text-green-600', 'text-blue-600');
                            lastSavedTime.classList.add('text-gray-600');
                        }
                    }
                },

                previewVisiMisi() {
                    const formData = this.collectFormData();

                    // Update preview content
                    const previewVisi = document.getElementById('previewVisiContent');
                    const previewMisi = document.getElementById('previewMisiContent');

                    if (previewVisi) {
                        if (formData.visi) {
                            previewVisi.innerHTML = `<p class="text-base leading-relaxed">${formData.visi}</p>`;
                        } else {
                            previewVisi.innerHTML = '<p class="text-gray-500 italic">Visi belum diisi</p>';
                        }
                    }

                    if (previewMisi) {
                        if (formData.misi.length > 0) {
                            const misiHTML = formData.misi.map(misi =>
                                `<div class="flex items-start space-x-3">
                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">${misi.number}</span>
                                    <p class="text-sm leading-relaxed">${misi.text}</p>
                                </div>`
                            ).join('');
                            previewMisi.innerHTML = misiHTML;
                        } else {
                            previewMisi.innerHTML =
                                '<p class="text-gray-500 italic">Belum ada misi yang ditambahkan</p>';
                        }
                    }

                    // Show modal
                    const modal = document.getElementById('visiMisiPreviewModal');
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                },

                closePreviewModal() {
                    const modal = document.getElementById('visiMisiPreviewModal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                }
            };

            // Global functions
            window.addMisiEntry = () => VisiMisiManager.addMisiEntry();
            window.saveVisiMisi = () => VisiMisiManager.saveVisiMisi();
            window.previewVisiMisi = () => VisiMisiManager.previewVisiMisi();
            window.closePreviewModal = () => VisiMisiManager.closePreviewModal();

            // Make VisiMisiManager globally accessible for onclick handlers
            window.VisiMisiManager = VisiMisiManager;

            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', () => {
                VisiMisiManager.init();
            });

        })();
    </script>

</x-admin.layouts>
