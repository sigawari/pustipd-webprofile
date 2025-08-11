// js/components/admin/toggleVisibility.js

export function toggleVisibility(btn) {
    // Get ID from button's data attribute or closest row
    const row = btn.closest("tr");
    const checkbox = row.querySelector(".item-checkbox");
    const id = checkbox ? checkbox.value : btn.dataset.id;

    if (!id) {
        alert("ID tidak ditemukan");
        return;
    }

    // Get current status from button classes or data
    const isCurrentlyPublished =
        btn.classList.contains("text-green-600") ||
        btn.querySelector(".icon-show:not(.hidden)");

    const newStatus = isCurrentlyPublished ? "draft" : "published";
    const actionText = isCurrentlyPublished
        ? "Sembunyikan dari publik"
        : "Tampilkan di publik";

    if (confirm(`${actionText}?\n\nStatus akan diubah ke: ${newStatus}`)) {
        // Submit status change
        submitStatusChange(id, newStatus, btn);
    }
}

// Function untuk submit status change
function submitStatusChange(id, status, button) {
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "/admin/manage-content/dokumen/ketetapan/bulk";
    form.innerHTML = `
        <input type="hidden" name="_token" value="${
            document.querySelector('meta[name="csrf-token"]').content
        }">
        <input type="hidden" name="action" value="${status}">
        <input type="hidden" name="ids[]" value="${id}">
    `;

    document.body.appendChild(form);
    form.submit();
}

// Export for inline HTML usage
window.toggleVisibility = toggleVisibility;
