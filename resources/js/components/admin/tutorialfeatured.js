// Tambahkan di file JavaScript CMS
function toggleFeatured(tutorialId, isFeatured) {
    const url = `/admin/tutorial/${tutorialId}/featured`;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            is_featured: isFeatured,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Refresh table atau update UI
                location.reload();
            } else {
                alert("Gagal mengupdate status featured");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan");
        });
}
