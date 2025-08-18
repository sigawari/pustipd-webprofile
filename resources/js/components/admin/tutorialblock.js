/**
 * Tutorial Content Block Builder
 * Mengelola penambahan, penghapusan, dan pengurutan content blocks untuk tutorial
 */

class TutorialBlockBuilder {
    constructor() {
        this.contentBlockIndex = 0;
        this.container = null;
        this.init();
    }

    init() {
        document.addEventListener("DOMContentLoaded", () => {
            this.container = document.getElementById("contentBlocks");
            this.bindEvents();
        });
    }

    bindEvents() {
        const addStepBtn = document.getElementById("addStepBtn");
        const addTipBtn = document.getElementById("addTipBtn");

        if (addStepBtn) {
            addStepBtn.addEventListener("click", () => {
                this.addContentBlock("step");
            });
        }

        if (addTipBtn) {
            addTipBtn.addEventListener("click", () => {
                this.addContentBlock("tip");
            });
        }

        // Event delegation untuk tombol delete
        document.addEventListener("click", (e) => {
            if (e.target.closest(".delete-block-btn")) {
                e.preventDefault();
                const button = e.target.closest(".delete-block-btn");
                const blockId = button.getAttribute("data-block-id");
                this.removeContentBlock(blockId);
            }
        });

        // ✅ TAMBAH: Event delegation untuk tombol move up/down
        document.addEventListener("click", (e) => {
            if (e.target.closest(".move-up-btn")) {
                e.preventDefault();
                const button = e.target.closest(".move-up-btn");
                const blockId = button.getAttribute("data-block-id");
                this.moveBlockUp(blockId);
            }

            if (e.target.closest(".move-down-btn")) {
                e.preventDefault();
                const button = e.target.closest(".move-down-btn");
                const blockId = button.getAttribute("data-block-id");
                this.moveBlockDown(blockId);
            }
        });
    }

    // ✅ TAMBAH: Method untuk pindah block ke atas
    moveBlockUp(blockId) {
        const block = document.querySelector(`[data-id="${blockId}"]`);
        if (block && block.previousElementSibling) {
            this.container.insertBefore(block, block.previousElementSibling);
            this.updateStepNumbers();
            this.updateBlockOrders();
            this.updateMoveButtons();
        }
    }

    // ✅ TAMBAH: Method untuk pindah block ke bawah
    moveBlockDown(blockId) {
        const block = document.querySelector(`[data-id="${blockId}"]`);
        if (block && block.nextElementSibling) {
            this.container.insertBefore(block.nextElementSibling, block);
            this.updateStepNumbers();
            this.updateBlockOrders();
            this.updateMoveButtons();
        }
    }

    // ✅ TAMBAH: Update status tombol move berdasarkan posisi
    updateMoveButtons() {
        const blocks = document.querySelectorAll(".content-block");

        blocks.forEach((block, index) => {
            const moveUpBtn = block.querySelector(".move-up-btn");
            const moveDownBtn = block.querySelector(".move-down-btn");

            if (moveUpBtn) {
                // Disable tombol up jika block pertama
                if (index === 0) {
                    moveUpBtn.disabled = true;
                    moveUpBtn.classList.add("opacity-50", "cursor-not-allowed");
                } else {
                    moveUpBtn.disabled = false;
                    moveUpBtn.classList.remove(
                        "opacity-50",
                        "cursor-not-allowed"
                    );
                }
            }

            if (moveDownBtn) {
                // Disable tombol down jika block terakhir
                if (index === blocks.length - 1) {
                    moveDownBtn.disabled = true;
                    moveDownBtn.classList.add(
                        "opacity-50",
                        "cursor-not-allowed"
                    );
                } else {
                    moveDownBtn.disabled = false;
                    moveDownBtn.classList.remove(
                        "opacity-50",
                        "cursor-not-allowed"
                    );
                }
            }
        });
    }

    addContentBlock(type) {
        if (!this.container) {
            console.error("Content blocks container not found");
            return;
        }

        const blockId = `block_${this.contentBlockIndex++}`;
        let blockHtml = "";

        if (type === "step") {
            blockHtml = this.createStepBlock(blockId);
        } else if (type === "tip") {
            blockHtml = this.createTipBlock(blockId);
        }

        this.container.insertAdjacentHTML("beforeend", blockHtml);
        this.updateStepNumbers();
        this.updateBlockOrders();
        this.updateMoveButtons(); // ✅ TAMBAH: Update move buttons
    }

    createStepBlock(blockId) {
        const stepNumber =
            this.container.querySelectorAll('[data-type="step"]').length + 1;

        return `
            <div class="content-block bg-white border border-gray-200 rounded-lg p-4" data-type="step" data-id="${blockId}">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">
                            ${stepNumber}
                        </div>
                        <span class="text-sm font-medium text-gray-700">Langkah Tutorial</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <!-- ✅ GANTI: Tombol Up/Down menggantikan drag handle -->
                        <button type="button" class="move-up-btn text-gray-500 hover:text-blue-600 p-1" data-block-id="${blockId}" title="Pindah ke atas">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                        <button type="button" class="move-down-btn text-gray-500 hover:text-blue-600 p-1" data-block-id="${blockId}" title="Pindah ke bawah">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="w-px h-4 bg-gray-300 mx-1"></div> <!-- Separator -->
                        <button type="button" class="delete-block-btn text-red-400 hover:text-red-600 p-1" data-block-id="${blockId}" title="Hapus langkah">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <input type="hidden" name="content_blocks[${blockId}][type]" value="step">
                    <input type="hidden" name="content_blocks[${blockId}][order]" value="${this.contentBlockIndex}" class="block-order">
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Judul Langkah</label>
                        <input type="text" name="content_blocks[${blockId}][title]" 
                               class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                               placeholder="Contoh: Persiapan Awal">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Deskripsi Langkah</label>
                        <textarea name="content_blocks[${blockId}][content]" rows="3"
                                  class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                                  placeholder="Jelaskan langkah ini secara detail..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Gambar (Opsional)</label>
                        <input type="file" name="content_blocks[${blockId}][image]" accept="image/*"
                               class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    </div>
                </div>
            </div>
        `;
    }

    createTipBlock(blockId) {
        return `
            <div class="content-block bg-yellow-50 border border-yellow-200 rounded-lg p-4" data-type="tip" data-id="${blockId}">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-xs mr-2">
                            💡
                        </div>
                        <span class="text-sm font-medium text-gray-700">Tips & Highlight</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <!-- ✅ GANTI: Tombol Up/Down untuk tips -->
                        <button type="button" class="move-up-btn text-gray-500 hover:text-yellow-600 p-1" data-block-id="${blockId}" title="Pindah ke atas">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                        <button type="button" class="move-down-btn text-gray-500 hover:text-yellow-600 p-1" data-block-id="${blockId}" title="Pindah ke bawah">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="w-px h-4 bg-gray-300 mx-1"></div> <!-- Separator -->
                        <button type="button" class="delete-block-btn text-red-400 hover:text-red-600 p-1" data-block-id="${blockId}" title="Hapus tips">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <input type="hidden" name="content_blocks[${blockId}][type]" value="tip">
                    <input type="hidden" name="content_blocks[${blockId}][order]" value="${this.contentBlockIndex}" class="block-order">
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tipe Tips</label>
                        <select name="content_blocks[${blockId}][tip_type]" 
                                class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                            <option value="tips">💡 Tips Penting</option>
                            <option value="perhatian">⚠️ Perhatian</option>
                            <option value="warning">🚨 Warning</option>
                            <option value="info">ℹ️ Informasi</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Konten Tips</label>
                        <textarea name="content_blocks[${blockId}][content]" rows="2"
                                  class="w-full px-2 py-1 text-sm border border-gray-200 rounded focus:ring-1 focus:ring-blue-500"
                                  placeholder="Masukkan tips atau informasi penting..."></textarea>
                    </div>
                </div>
            </div>
        `;
    }

    removeContentBlock(blockId) {
        const block = document.querySelector(`[data-id="${blockId}"]`);
        if (block) {
            block.remove();
            this.updateStepNumbers();
            this.updateBlockOrders();
            this.updateMoveButtons();
        }
    }

    updateStepNumbers() {
        const stepBlocks = document.querySelectorAll('[data-type="step"]');
        stepBlocks.forEach((block, index) => {
            const numberElement = block.querySelector(".w-6.h-6.bg-blue-600");
            if (numberElement) {
                numberElement.textContent = index + 1;
            }
        });
    }

    updateBlockOrders() {
        const allBlocks = document.querySelectorAll(".content-block");
        allBlocks.forEach((block, index) => {
            const orderInput = block.querySelector(".block-order");
            if (orderInput) {
                orderInput.value = index + 1;
            }
        });
    }

    resetBlocks() {
        if (this.container) {
            this.container.innerHTML = "";
            this.contentBlockIndex = 0;
        }
    }

    validateBlocks() {
        const blocks = document.querySelectorAll(".content-block");
        if (blocks.length === 0) {
            alert("Minimal tambahkan 1 langkah tutorial!");
            return false;
        }

        let isValid = true;
        let errors = [];

        blocks.forEach((block, index) => {
            const type = block.dataset.type;
            const titleInput = block.querySelector('input[name*="[title]"]');
            const contentTextarea = block.querySelector(
                'textarea[name*="[content]"]'
            );

            if (type === "step" && titleInput && !titleInput.value.trim()) {
                errors.push(`Langkah ${index + 1}: Judul langkah harus diisi`);
                isValid = false;
            }

            if (contentTextarea && !contentTextarea.value.trim()) {
                errors.push(
                    `${type === "step" ? "Langkah" : "Tips"} ${
                        index + 1
                    }: Konten harus diisi`
                );
                isValid = false;
            }
        });

        if (!isValid) {
            alert("Error:\n" + errors.join("\n"));
        }

        return isValid;
    }
}

// Initialize dan expose ke global scope
const tutorialBlockBuilder = new TutorialBlockBuilder();
window.tutorialBlockBuilder = tutorialBlockBuilder;

// Export untuk ES6 module
export { TutorialBlockBuilder };
export default tutorialBlockBuilder;
