// =============================
// Preview uploaded image
// =============================

function previewImage(input) {
    const preview = document.getElementById("preview-img");
    const previewContainer = document.getElementById("photo-preview");
    const uploadIcon = document.getElementById("upload-icon");

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            previewContainer.classList.remove("hidden");
            uploadIcon.classList.add("hidden");
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // Kalau file dihapus, kembalikan ke keadaan awal
        preview.src = "";
        previewContainer.classList.add("hidden");
        uploadIcon.classList.remove("hidden");
    }
}

// ✅ Biar bisa dipanggil dari inline HTML
window.previewImage = previewImage;