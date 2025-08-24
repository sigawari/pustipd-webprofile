function toggleStatus(btn) {
    const id = btn.dataset.id;
    const currentStatus = btn.dataset.status;
    const url = btn.dataset.url;

    if (!id || !url) {
        alert("ID atau URL toggle tidak ditemukan");
        return;
    }

    // Tentukan status baru
    const newStatus = currentStatus === "draft" ? "published" : "draft";

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json",
        },
        body: JSON.stringify({ status: newStatus }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                // Update status di tombol
                btn.dataset.status = newStatus;

                // Toggle ikon
                btn.querySelector(".icon-eye").classList.toggle("hidden", newStatus !== "draft");
                btn.querySelector(".icon-eye-off").classList.toggle("hidden", newStatus !== "published");

                // Update title
                btn.title = newStatus === "draft" ? "Publish" : "Unpublish";

                // Update badge status di kolom tabel
                const badge = btn.closest("tr").querySelector("td:nth-child(5) span");
                if (badge) {
                    if (newStatus === "draft") {
                        badge.className = "inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-300 text-yellow-800";
                        badge.textContent = "Draft";
                    } else {
                        badge.className = "inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-300 text-green-800";
                        badge.textContent = "Published";
                    }
                }

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

window.toggleStatus = toggleStatus;
