window.updateBulkActionsBar = function () {
    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");
    const bulkBar = document.getElementById("bulkActionsBar");
    const selectedCount = document.getElementById("selectedCount");
    const defaultActions = document.getElementById("defaultActions");

    if (checkedBoxes.length > 0) {
        bulkBar.classList.remove("hidden");
        selectedCount.textContent = checkedBoxes.length;

        if (allArchived) {
            defaultActions.classList.add("hidden");
            archivedActions.classList.remove("hidden");
        } else {
            defaultActions.classList.remove("hidden");
            archivedActions.classList.add("hidden");
        }
    } else {
        bulkBar.classList.add("hidden");
    }
};

window.bulkAction = function (action) {
    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");
    const ids = Array.from(checkedBoxes).map((cb) => cb.value);

    if (ids.length === 0) {
        alert("Pilih minimal satu item");
        return;
    }

    let confirmMessage = "";
    switch (action) {
        case "published":
            confirmMessage = `Publish ${ids.length} Konten?`;
            break;
        case "draft":
            confirmMessage = `Jadikan draft ${ids.length} Konten?`;
            break;
        case "permanent_delete":
            confirmMessage = `⚠️ BAHAYA!\n\nHapus PERMANEN ${ids.length} Konten?\n\nData tidak dapat dikembalikan!`;
            break;
    }

    if (confirm(confirmMessage)) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = window.bulkActionRoute;
        form.innerHTML = `
            <input type="hidden" name="_token" value="${document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")}">
            <input type="hidden" name="action" value="${action}">
            ${ids
                .map((id) => `<input type="hidden" name="ids[]" value="${id}">`)
                .join("")}
        `;
        document.body.appendChild(form);
        form.submit();
    }
};

window.quickStatusChange = function (id, status) {
    if (confirm(`Ubah status ke ${status}?`)) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = window.bulkActionRoute;
        form.innerHTML = `
            <input type="hidden" name="_token" value="${document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")}">
            <input type="hidden" name="action" value="${status}">
            <input type="hidden" name="ids[]" value="${id}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
};

window.initBulkActions = function () {
    const selectAllCheckbox = document.getElementById("selectAll");
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener("change", function () {
            const checkboxes = document.querySelectorAll(".item-checkbox");
            checkboxes.forEach((cb) => (cb.checked = this.checked));
            window.updateBulkActionsBar();
        });
    }
    window.updateBulkActionsBar();
    // Jika ada fungsi attachPaginationListeners(), pastikan juga dipanggil di sini
    if (typeof attachPaginationListeners === "function") {
        attachPaginationListeners();
    }
};
