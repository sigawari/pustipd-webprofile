console.log("Achievement management script loaded");

// Modal Management
function openAddModal() {
    console.log("openAddModal called");

    const modal = document.getElementById("AddModal");
    if (!modal) {
        console.error("Modal not found!");
        alert("Error: Modal tidak ditemukan");
        return;
    }

    // Show modal
    modal.classList.remove("hidden");
    modal.style.display = "flex";

    // Reset form
    document.getElementById("modalTitle").textContent = "Tambah mitra Baru";
    document.getElementById("addForm").reset();
    clearLogoSelection();

    console.log("Modal opened successfully");
}

function closeModal() {
    const modal = document.getElementById("AddModal");
    if (modal) {
        modal.classList.add("hidden");
        modal.style.display = "none";
    }
}

function closePreviewModal() {
    const previewModal = document.getElementById("previewModal");
    if (previewModal) {
        previewModal.classList.add("hidden");
        previewModal.style.display = "none";
    }
}

// Logo Selection Functions
function clearLogoSelection() {
    document.querySelectorAll(".logo-option").forEach((btn) => {
        btn.classList.remove("border-blue-500", "bg-blue-50");
        btn.classList.add("border-gray-200");
    });
    document.getElementById("selectedLogo").value = "";
}

// CRUD Functions
function editAchievement(id) {
    console.log("Edit achievement:", id);
    openAddModal();
    document.getElementById("modalTitle").textContent = "Edit mitra";
    // TODO: Load existing data
}

function previewAchievement(id) {
    console.log("Preview achievement:", id);
    const previewModal = document.getElementById("previewModal");
    if (previewModal) {
        previewModal.classList.remove("hidden");
        previewModal.style.display = "flex";
    }
}

function duplicateAchievement(id) {
    if (confirm("Duplikasi mitra ini?")) {
        alert("mitra berhasil diduplikasi! (Demo)");
    }
}

function deleteAchievement(id) {
    if (confirm("Apakah Anda yakin ingin menghapus mitra ini?")) {
        alert("mitra berhasil dihapus! (Demo)");
    }
}

// Bulk Actions Functions
function applyBulkAction() {
    const selectedIds = getSelectedIds();
    const action = document.getElementById("bulkAction").value;

    if (selectedIds.length === 0) {
        alert("Pilih minimal 1 item untuk melakukan aksi bulk");
        return;
    }

    if (!action) {
        alert("Pilih aksi yang akan diterapkan");
        return;
    }

    let actionText = "";
    switch (action) {
        case "publish":
            actionText = "publikasikan";
            break;
        case "draft":
            actionText = "jadikan draft";
            break;
        case "schedule":
            actionText = "jadwalkan";
            break;
        case "archive":
            actionText = "arsipkan";
            break;
        case "delete":
            actionText = "hapus";
            break;
    }

    if (
        confirm(
            `Apakah Anda yakin ingin ${actionText} ${selectedIds.length} item yang dipilih?`
        )
    ) {
        console.log("Bulk action:", action, "IDs:", selectedIds);
        alert(`${selectedIds.length} item berhasil ${actionText}! (Demo)`);

        // Reset selections
        document.getElementById("selectAll").checked = false;
        document
            .querySelectorAll(".row-checkbox")
            .forEach((cb) => (cb.checked = false));
        updateSelectedCount();
    }
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll(".row-checkbox:checked");
    return Array.from(checkboxes).map((cb) => cb.dataset.id);
}

function updateSelectedCount() {
    const selected = document.querySelectorAll(".row-checkbox:checked").length;
    document.getElementById("selected-count").textContent = selected;

    // Enable/disable bulk action button
    const bulkBtn = document.getElementById("bulkActionBtn");
    bulkBtn.disabled = selected === 0;

    // Update select all checkbox
    const selectAll = document.getElementById("selectAll");
    const allCheckboxes = document.querySelectorAll(".row-checkbox");

    if (selected === 0) {
        selectAll.indeterminate = false;
        selectAll.checked = false;
    } else if (selected === allCheckboxes.length) {
        selectAll.indeterminate = false;
        selectAll.checked = true;
    } else {
        selectAll.indeterminate = true;
    }
}

// Form Validation
function validateForm() {
    const logo = document.getElementById("selectedLogo").value;
    const title = document.getElementById("title").value.trim();
    const description = document.getElementById("description").value.trim();

    if (!logo) {
        alert("Silakan pilih logo untuk mitra ini");
        return false;
    }

    if (!title) {
        alert("Judul tidak boleh kosong");
        return false;
    }

    if (!description) {
        alert("Keterangan tidak boleh kosong");
        return false;
    }

    return true;
}

// Initialize
document.addEventListener("DOMContentLoaded", function () {
    console.log("Initializing achievement management...");

    // Logo selection event listeners
    document.querySelectorAll(".logo-option").forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            // Clear previous selections
            clearLogoSelection();

            // Select this logo
            this.classList.add("border-blue-500", "bg-blue-50");
            this.classList.remove("border-gray-200");

            // Set hidden input
            document.getElementById("selectedLogo").value = this.dataset.logo;

            console.log("Logo selected:", this.dataset.logo);
        });
    });

    // Select all checkbox
    document
        .getElementById("selectAll")
        .addEventListener("change", function () {
            const isChecked = this.checked;
            document.querySelectorAll(".row-checkbox").forEach((cb) => {
                cb.checked = isChecked;
            });
            updateSelectedCount();
        });

    // Individual checkboxes
    document.querySelectorAll(".row-checkbox").forEach((checkbox) => {
        checkbox.addEventListener("change", updateSelectedCount);
    });

    // Status change handler for scheduled date
    document.getElementById("status").addEventListener("change", function () {
        const scheduleDiv = document.getElementById("scheduleDate");
        if (this.value === "scheduled") {
            scheduleDiv.classList.remove("hidden");
            document.getElementById("publish_date").required = true;
        } else {
            scheduleDiv.classList.add("hidden");
            document.getElementById("publish_date").required = false;
        }
    });

    // Form submission
    document.getElementById("addForm").addEventListener("submit", function (e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        const formData = new FormData(this);
        console.log("Form data:", Object.fromEntries(formData));

        // Simulate success
        closeModal();
        alert("mitra berhasil disimpan! (Demo)");
    });

    // Keyboard shortcuts
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            if (
                !document
                    .getElementById("AddModal")
                    .classList.contains("hidden")
            ) {
                closeModal();
            }
            if (
                !document
                    .getElementById("previewModal")
                    .classList.contains("hidden")
            ) {
                closePreviewModal();
            }
        }
    });

    console.log("Achievement management initialization complete");
});

// Debug helpers
window.debugAchievement = {
    openModal: () => openAddModal(),
    closeModal: () => closeModal(),
    testModal: () => {
        console.log("Modal element:", document.getElementById("AddModal"));
        console.log("Form element:", document.getElementById("addForm"));
        console.log(
            "Logo options:",
            document.querySelectorAll(".logo-option").length
        );
    },
};

console.log("Debug helper available: window.debugAchievement.testModal()");
