<!-- resources/views/admin/manage-content/tentang/visi-misi.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- @section('page-title', 'Visi Misi PUSTIPD')
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
    @endsection -->

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{$title}}</h2>
                <p class="text-gray-600 mt-1">Kelola visi dan misi PUSTIPD UIN Raden Fatah Palembang</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button onclick="previewVisiMisi()"
                    class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Preview
                </button>
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

            <!-- Status Section - DIPERBAIKI -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                    <label class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500 mr-2">Terakhir disimpan:</span>
                        <span id="lastSavedTime" class="text-xs text-green-600 font-medium">Belum disimpan</span>
                    </div>
                </div>
                <select id="status" name="status" required
                    class="w-full sm:w-auto px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="draft">Draft - Belum dipublikasikan</option>
                    <option value="published">Published - Tampil di website</option>
                </select>
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
                                d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
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
                    <button type="button" onclick="saveAsDraft()"
                        class="w-full sm:w-auto px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Simpan Draft
                    </button>
                    <button type="button" onclick="saveAndPublish()"
                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center text-sm sm:text-base">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan & Publikasikan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview Modal tetap sama -->
    <div id="visiMisiPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Modal content sama seperti sebelumnya -->
    </div>

    <!-- Enhanced JavaScript dengan Action Buttons -->
    <script>
        (function() {
            'use strict';

            const VisiMisiManager = {
                misiCounter: 0,
                visiData: '',
                misiData: [],
                isEditing: false,

                init() {
                    this.loadExistingData();
                    this.bindEvents();
                    this.updateUI();
                },

                loadExistingData() {
                    // Load existing data
                    this.visiData =
                        'Menjadi pusat unggulan dalam pengembangan teknologi informasi dan pelayanan digital yang mendukung kemajuan pendidikan Islam di Indonesia.';
                    this.misiData = [
                        'Mengembangkan sistem informasi terintegrasi untuk mendukung operasional universitas',
                        'Menyediakan layanan teknologi informasi yang berkualitas dan mudah diakses',
                        'Meningkatkan kompetensi SDM dalam bidang teknologi informasi'
                    ];

                    // Check if data exists (simulate checking database)
                    if (this.visiData || this.misiData.length > 0) {
                        this.isEditing = true;
                        document.getElementById('status').value = 'published'; // Set default if editing
                    }

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
                        this.updateVisiCharCount();
                    }

                    // Auto-save every 30 seconds
                    setInterval(() => {
                        this.autoSave();
                    }, 30000);
                },

                updateVisiCharCount() {
                    const visiTextarea = document.getElementById('visi');
                    const charCounter = document.getElementById('visiCharCount');

                    if (visiTextarea && charCounter) {
                        const length = visiTextarea.value.length;
                        charCounter.textContent = `${length} / 500 karakter`;

                        // Reset classes
                        charCounter.classList.remove('text-red-600', 'text-yellow-600', 'text-green-600');

                        if (length > 500) {
                            charCounter.classList.add('text-red-600');
                        } else if (length < 50) {
                            charCounter.classList.add('text-yellow-600');
                        } else {
                            charCounter.classList.add('text-green-600');
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

                            charCounter.classList.remove('text-red-600', 'text-yellow-600', 'text-green-600');

                            if (length > 200) {
                                charCounter.classList.add('text-red-600');
                            } else if (length < 20) {
                                charCounter.classList.add('text-yellow-600');
                            } else {
                                charCounter.classList.add('text-green-600');
                            }
                        };

                        textarea.addEventListener('input', updateCharCount);
                        updateCharCount();
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

                        entry.dataset.misiId = newNumber;

                        const badge = entry.querySelector('.w-6.h-6');
                        if (badge) badge.textContent = newNumber;

                        const title = entry.querySelector('h4');
                        if (title) title.textContent = `Misi ${newNumber}`;

                        const textarea = entry.querySelector('textarea');
                        if (textarea) {
                            textarea.name = `misi_${newNumber}`;
                            textarea.id = `misi_${newNumber}`;
                            textarea.placeholder = `Tuliskan misi ke-${newNumber}...`;
                        }

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
                        if (emptyState) emptyState.style.display = 'block';
                    } else {
                        if (emptyState) emptyState.style.display = 'none';
                    }
                },

                validateForm() {
                    const visi = document.getElementById('visi').value.trim();
                    const misiEntries = document.querySelectorAll('.misi-entry textarea');

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

                saveVisiMisi(status = null, showAlert = true) {
                    if (!this.validateForm()) {
                        return false;
                    }

                    const formData = this.collectFormData();

                    // Override status if provided
                    if (status) {
                        formData.status = status;
                        document.getElementById('status').value = status;
                    }

                    console.log('Saving Visi Misi:', formData);

                    // Simulate API call
                    setTimeout(() => {
                        const lastSavedTime = document.getElementById('lastSavedTime');
                        if (lastSavedTime) {
                            lastSavedTime.textContent = new Date().toLocaleString('id-ID');
                            lastSavedTime.classList.remove('text-green-600', 'text-gray-600');
                            lastSavedTime.classList.add('text-blue-600');
                        }

                        if (showAlert) {
                            const statusText = formData.status === 'published' ?
                                'disimpan dan dipublikasikan' : 'disimpan sebagai draft';
                            alert(`Visi & Misi berhasil ${statusText}!`);
                        }
                    }, 1000);

                    return true;
                },

                autoSave() {
                    const formData = this.collectFormData();

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
            window.previewVisiMisi = () => VisiMisiManager.previewVisiMisi();
            window.closePreviewModal = () => VisiMisiManager.closePreviewModal();

            // New action functions
            window.saveAsDraft = () => {
                VisiMisiManager.saveVisiMisi('draft');
            };

            window.saveAndPublish = () => {
                if (confirm('Apakah Anda yakin ingin mempublikasikan visi & misi ini ke website?')) {
                    VisiMisiManager.saveVisiMisi('published');
                }
            };

            window.VisiMisiManager = VisiMisiManager;

            document.addEventListener('DOMContentLoaded', () => {
                VisiMisiManager.init();
            });

        })();
    </script>

</x-admin.layouts>
