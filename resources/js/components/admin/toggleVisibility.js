/**
 * Toggle visibility status secara global.
 * Tombol harus memiliki atribut:
 * - data-id : id data
 * - data-visibility : status saat ini (true = hidden, false = visible)
 * - data-url : endpoint API untuk toggle
 *
 * Fungsi ini bisa dipakai di mana saja asalkan tombol punya atribut di atas.
 */
function toggleVisibility(btn) {
    const id = btn.dataset.id;
    const currentVisibility = btn.dataset.visibility === "true"; // string to boolean
    const url = btn.dataset.url;

    if (!id || !url) {
        alert("ID atau URL toggle tidak ditemukan");
        return;
    }

    const newVisibility = !currentVisibility;
    const actionText = newVisibility
        ? "Sembunyikan dari publik"
        : "Tampilkan ke publik";

    if (!confirm(`Apakah yakin ingin ${actionText}?`)) {
        return;
    }

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content,
            Accept: "application/json",
        },
        body: JSON.stringify({ is_hidden: newVisibility }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                // Update atribut dan judul tombol
                btn.dataset.visibility = newVisibility.toString();
                btn.title = newVisibility
                    ? "Tampilkan ke publik"
                    : "Sembunyikan dari publik";

                // Update icon sesuai status baru
                btn.innerHTML = newVisibility
                    ? `<svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10a9.982 9.982 0 014.11-7.64M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>`
                    : `<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>`;

                alert(data.message);
            } else {
                alert("Gagal mengubah status: " + data.message);
            }
        })
        .catch((error) => {
            alert("Terjadi kesalahan saat mengubah status");
            console.error(error);
        });
}

// Expose fungsi agar bisa dipanggil dari HTML inline
window.toggleVisibility = toggleVisibility;
