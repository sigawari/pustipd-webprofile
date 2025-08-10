// js/components/admin/toggleVisibility.js

export function toggleVisibility(btn) {
    let showIcon = btn.querySelector('.icon-show');
    let hiddenIcon = btn.querySelector('.icon-hidden');

    if (showIcon && hiddenIcon) {
        showIcon.classList.toggle('hidden');
        hiddenIcon.classList.toggle('hidden');
    }
}

// ✅ Biar bisa dipanggil dari inline HTML
window.toggleVisibility = toggleVisibility;