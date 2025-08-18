// =============================
// Remove list item
// =============================
function removeListItem(button) {
    if (!confirm("Apakah Anda yakin ingin menghapus item ini?")) return;

    const item = button.closest(".flex");
    const container = item.parentNode;

    item.remove();

    // Re-indexing
    const items = Array.from(container.children).filter((child) =>
        child.classList.contains("flex")
    );

    items.forEach((item, index) => {
        const inputs = item.querySelectorAll("input");
        inputs.forEach((input) => {
            const name = input.name;
            const newName = name.replace(/\[\d+\]/, `[${index}]`);
            input.name = newName;
        });
    });

    // Show empty message if list is empty
    if (items.length === 0) {
        const listType = container.id.replace("-list", "");
        const emptyMessage = document.createElement("div");
        emptyMessage.className =
            "text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg";
        emptyMessage.textContent = `Belum ada ${listType}. Klik "Tambah" untuk menambahkan.`;
        container.appendChild(emptyMessage);
    }
}

window.removeListItem = removeListItem;
