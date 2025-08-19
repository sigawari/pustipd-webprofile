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
                    ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
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
