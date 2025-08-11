// js/components/public/bulk-download.js

/**
 * Public Bulk Download System
 * Khusus untuk halaman public seperti ketetapan, regulasi, dll
 */

class PublicBulkDownload {
    constructor() {
        this.allSelected = false;
        this.isInitialized = false;
        this.pageType = this.detectPageType();
        this.init();
    }

    detectPageType() {
        const path = window.location.pathname;
        if (path.includes("ketetapan")) return "ketetapan";
        if (path.includes("regulasi")) return "regulasi";
        if (path.includes("panduan")) return "panduan";
        if (path.includes("sop")) return "sop";
        return "default";
    }

    init() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () =>
                this.initialize()
            );
        } else {
            this.initialize();
        }
    }

    initialize() {
        console.log(
            `🚀 Public Bulk Download System Loading for: ${this.pageType}`
        );

        if (!this.hasRequiredElements()) {
            console.log(
                "📄 No bulk download elements found, skipping initialization"
            );
            return;
        }

        this.bindGlobalFunctions();
        this.attachEventListeners();
        this.updateBulkDownloadButton();
        this.updateInfoDisplay();
        this.isInitialized = true;

        console.log("✅ Public Bulk Download System initialized successfully");
    }

    hasRequiredElements() {
        return (
            this.getFileCheckboxes().length > 0 &&
            (document.getElementById("bulk-download-btn") ||
                document.getElementById("bulk-download-form"))
        );
    }

    bindGlobalFunctions() {
        // Clear existing functions first to prevent duplicates
        delete window.toggleSelectAll;
        delete window.toggleAllCheckboxes;
        delete window.updateBulkDownloadButton;
        delete window.bulkDownloadSelected;

        // Bind new functions
        window.toggleSelectAll = this.toggleSelectAll.bind(this);
        window.toggleAllCheckboxes = this.toggleAllCheckboxes.bind(this);
        window.updateBulkDownloadButton =
            this.updateBulkDownloadButton.bind(this);
        window.bulkDownloadSelected = this.bulkDownloadSelected.bind(this);

        // Public specific functions
        window.resetPublicSelection = this.resetSelection.bind(this);
        window.getPublicDownloadStatus = this.getStatus.bind(this);
    }

    toggleSelectAll() {
        const checkboxes = this.getFileCheckboxes();
        if (checkboxes.length === 0) return;

        this.allSelected = !this.allSelected;
        console.log(
            `📋 Toggle Select All (${this.pageType}): ${this.allSelected}`
        );

        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.allSelected;
        });

        this.updateBulkDownloadButton();
        this.updateSelectAllButton();
        this.updateHeaderCheckbox();
        this.updateInfoDisplay();
    }

    toggleAllCheckboxes(headerCheckbox) {
        const checkboxes = this.getFileCheckboxes();
        if (checkboxes.length === 0) return;

        console.log(
            `📋 Header checkbox clicked (${this.pageType}): ${headerCheckbox.checked}`
        );

        checkboxes.forEach((checkbox) => {
            checkbox.checked = headerCheckbox.checked;
        });

        this.allSelected = headerCheckbox.checked;
        this.updateBulkDownloadButton();
        this.updateSelectAllButton();
        this.updateInfoDisplay();
    }

    updateBulkDownloadButton() {
        const checkedBoxes = this.getCheckedCheckboxes();
        const bulkBtn = document.getElementById("bulk-download-btn");
        const selectedCount = document.getElementById("selected-count");

        console.log(
            `📊 Checked boxes (${this.pageType}): ${checkedBoxes.length}`
        );

        if (!bulkBtn) return;

        if (checkedBoxes.length > 0) {
            bulkBtn.classList.remove("hidden");

            if (selectedCount) {
                selectedCount.textContent = checkedBoxes.length;
            }

            console.log("✅ Bulk download button shown");
        } else {
            bulkBtn.classList.add("hidden");
            console.log("❌ Bulk download button hidden");
        }

        this.updateHeaderCheckbox();
    }

    updateInfoDisplay() {
        const infoCount = document.getElementById("info-count");
        if (!infoCount) return;

        const checkedCount = this.getCheckedCheckboxes().length;
        const totalCount = this.getFileCheckboxes().length;

        if (checkedCount > 0) {
            infoCount.textContent = `${checkedCount} dipilih dari ${totalCount}`;
        } else {
            infoCount.textContent = `${totalCount} dokumen tersedia`;
        }
    }

    updateHeaderCheckbox() {
        const headerCheckbox = document.getElementById("header-checkbox");
        if (!headerCheckbox) return;

        const allCheckboxes = this.getFileCheckboxes();
        const checkedBoxes = this.getCheckedCheckboxes();

        if (checkedBoxes.length === 0) {
            headerCheckbox.indeterminate = false;
            headerCheckbox.checked = false;
        } else if (checkedBoxes.length === allCheckboxes.length) {
            headerCheckbox.indeterminate = false;
            headerCheckbox.checked = true;
        } else {
            headerCheckbox.indeterminate = true;
            headerCheckbox.checked = false;
        }
    }

    updateSelectAllButton() {
        const selectText = document.getElementById("select-text");
        if (selectText) {
            selectText.textContent = this.allSelected
                ? "Batal Pilih"
                : "Pilih Semua";
        }
    }

    bulkDownloadSelected() {
        console.log(`💾 Bulk download initiated for ${this.pageType}`);

        const checkedBoxes = this.getCheckedCheckboxes();
        const form = document.getElementById("bulk-download-form");

        if (!form) {
            console.error("❌ Bulk download form not found");
            this.showNotification("Form download tidak ditemukan", "error");
            return;
        }

        if (checkedBoxes.length === 0) {
            this.showNotification(
                "Pilih minimal satu file untuk didownload",
                "warning"
            );
            return;
        }

        const fileCount = checkedBoxes.length;
        const confirmMessage = this.getConfirmMessage(fileCount);

        if (!confirm(confirmMessage)) {
            console.log("❌ User cancelled download");
            return;
        }

        this.prepareAndSubmitForm(checkedBoxes, form);
    }

    prepareAndSubmitForm(checkedBoxes, form) {
        const inputsContainer = document.getElementById("bulk-download-inputs");

        if (!inputsContainer) {
            console.error("❌ Bulk download inputs container not found");
            this.showNotification("Container input tidak ditemukan", "error");
            return;
        }

        // Clear previous inputs
        inputsContainer.innerHTML = "";

        // Add selected IDs to form
        checkedBoxes.forEach((checkbox) => {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "ids[]";
            input.value = checkbox.value;
            inputsContainer.appendChild(input);
        });

        // Show loading state
        this.showLoadingState();

        // Submit form
        try {
            form.submit();
            console.log(`✅ Form submitted successfully for ${this.pageType}`);

            // Show success message
            setTimeout(() => {
                this.showNotification(
                    `Download ${checkedBoxes.length} file dimulai`,
                    "success"
                );
            }, 500);
        } catch (error) {
            console.error("❌ Form submission error:", error);
            this.showNotification(
                "Terjadi kesalahan saat memulai download",
                "error"
            );
            this.hideLoadingState();
        }
    }

    showLoadingState() {
        const bulkBtn = document.getElementById("bulk-download-btn");
        if (!bulkBtn) return;

        bulkBtn.dataset.originalHtml = bulkBtn.innerHTML;
        bulkBtn.dataset.originalDisabled = bulkBtn.disabled;

        bulkBtn.innerHTML = `
            <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyiapkan Download...
        `;
        bulkBtn.disabled = true;

        // Auto reset after 5 seconds
        setTimeout(() => this.hideLoadingState(), 5000);
    }

    hideLoadingState() {
        const bulkBtn = document.getElementById("bulk-download-btn");
        if (!bulkBtn || !bulkBtn.dataset.originalHtml) return;

        bulkBtn.innerHTML = bulkBtn.dataset.originalHtml;
        bulkBtn.disabled = bulkBtn.dataset.originalDisabled === "true";

        delete bulkBtn.dataset.originalHtml;
        delete bulkBtn.dataset.originalDisabled;

        console.log("🔄 Button reset to original state");
    }

    attachEventListeners() {
        const checkboxes = this.getFileCheckboxes();
        console.log(
            `🔗 Attaching listeners to ${checkboxes.length} checkboxes`
        );

        // ✅ FIXED: Remove all existing listeners first
        checkboxes.forEach((checkbox) => {
            if (checkbox._publicBulkHandler) {
                checkbox.removeEventListener(
                    "change",
                    checkbox._publicBulkHandler
                );
                delete checkbox._publicBulkHandler;
            }
        });

        // ✅ FIXED: Add new listeners with proper binding
        checkboxes.forEach((checkbox, index) => {
            const handler = (event) => {
                console.log(
                    `📋 Checkbox ${index} changed: ${checkbox.checked} (ID: ${checkbox.value})`
                );

                // Small delay to ensure DOM is updated
                setTimeout(() => {
                    this.updateBulkDownloadButton();
                    this.updateInfoDisplay();
                }, 10);
            };

            checkbox.addEventListener("change", handler);
            checkbox._publicBulkHandler = handler;
        });
    }

    // ✅ FIXED: Utility methods dengan selector yang benar
    getFileCheckboxes() {
        // Hanya ambil checkbox yang ada di dalam tbody atau mobile cards, TIDAK termasuk header
        const desktopCheckboxes = document.querySelectorAll(
            "tbody .file-checkbox"
        );
        const mobileCheckboxes = document.querySelectorAll(
            ".lg\\:hidden .file-checkbox"
        );

        // Gabungkan hasil dan remove duplicates
        const allCheckboxes = [...desktopCheckboxes, ...mobileCheckboxes];
        const uniqueCheckboxes = allCheckboxes.filter(
            (checkbox, index, array) =>
                array.findIndex((cb) => cb.value === checkbox.value) === index
        );

        console.log(`📋 Found ${uniqueCheckboxes.length} document checkboxes`);
        return uniqueCheckboxes;
    }

    getCheckedCheckboxes() {
        // Hanya ambil checkbox yang checked di dalam tbody atau mobile cards
        const desktopChecked = document.querySelectorAll(
            "tbody .file-checkbox:checked"
        );
        const mobileChecked = document.querySelectorAll(
            ".lg\\:hidden .file-checkbox:checked"
        );

        // Gabungkan hasil dan remove duplicates
        const allChecked = [...desktopChecked, ...mobileChecked];
        const uniqueChecked = allChecked.filter(
            (checkbox, index, array) =>
                array.findIndex((cb) => cb.value === checkbox.value) === index
        );

        console.log(
            `✅ Found ${uniqueChecked.length} checked document checkboxes`
        );
        return uniqueChecked;
    }

    getConfirmMessage(fileCount) {
        const docType = this.getDocumentTypeName();
        return fileCount === 1
            ? `Download 1 ${docType} terpilih?`
            : `Download ${fileCount} ${docType} dalam bentuk ZIP?`;
    }

    getDocumentTypeName() {
        const types = {
            ketetapan: "ketetapan",
            regulasi: "regulasi",
            panduan: "panduan",
            sop: "SOP",
        };
        return types[this.pageType] || "dokumen";
    }

    showNotification(message, type = "info") {
        alert(message);
    }

    resetSelection() {
        const checkboxes = this.getFileCheckboxes();
        checkboxes.forEach((checkbox) => (checkbox.checked = false));

        const headerCheckbox = document.getElementById("header-checkbox");
        if (headerCheckbox) {
            headerCheckbox.checked = false;
            headerCheckbox.indeterminate = false;
        }

        this.allSelected = false;
        this.updateBulkDownloadButton();
        this.updateSelectAllButton();
        this.updateInfoDisplay();
    }

    getStatus() {
        return {
            pageType: this.pageType,
            isInitialized: this.isInitialized,
            allSelected: this.allSelected,
            checkedCount: this.getCheckedCheckboxes().length,
            totalCount: this.getFileCheckboxes().length,
            hasElements: this.hasRequiredElements(),
        };
    }

    destroy() {
        const checkboxes = this.getFileCheckboxes();
        checkboxes.forEach((checkbox) => {
            if (checkbox._publicBulkHandler) {
                checkbox.removeEventListener(
                    "change",
                    checkbox._publicBulkHandler
                );
                delete checkbox._publicBulkHandler;
            }
        });

        // Remove global functions
        delete window.toggleSelectAll;
        delete window.toggleAllCheckboxes;
        delete window.updateBulkDownloadButton;
        delete window.bulkDownloadSelected;
        delete window.resetPublicSelection;
        delete window.getPublicDownloadStatus;

        this.isInitialized = false;
        console.log(
            `🧹 Public Bulk Download System (${this.pageType}) destroyed`
        );
    }
}

// Auto-initialize when script loads
let publicBulkDownloadInstance = null;

// Export for manual control if needed
window.PublicBulkDownload = PublicBulkDownload;

// Auto initialize only on public pages
if (!publicBulkDownloadInstance) {
    publicBulkDownloadInstance = new PublicBulkDownload();
}

// Export instance for external access
window.publicBulkDownloadInstance = publicBulkDownloadInstance;
