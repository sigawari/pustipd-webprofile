// =============================
// Auto-save draft (opsional / belum aktif AJAX-nya)
// =============================
let autoSaveTimeout;
document.addEventListener('input', function (e) {
    if (e.target.matches('input, textarea')) {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            console.log('Auto-saving draft...'); // Ganti ini dengan AJAX kalau mau disimpan ke backend
        }, 2000);
    }
});

// ✅ Biar bisa dipanggil dari inline HTML
window.autoSaveTimeOut = function () {
    clearTimeout(autoSaveTimeout);
    console.log('Auto-save timeout cleared.');
}