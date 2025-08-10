window.updateBulkActionsBar = function () {
    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");
    const bulkBar = document.getElementById("bulkActionsBar");
    const selectedCount = document.getElementById("selectedCount");
    const defaultActions = document.getElementById("defaultActions");
    const archivedActions = document.getElementById("archivedActions");

    if (checkedBoxes.length > 0) {
        bulkBar.classList.remove("hidden");
        selectedCount.textContent = checkedBoxes.length;

        const allArchived = Array.from(checkedBoxes).every((cb) => {
            const row = cb.closest("tr");
            const statusElement = row.querySelector(".inline-flex");
            return (
                statusElement &&
                statusElement.textContent.trim().toLowerCase().includes("archived")
            );
        });

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
            confirmMessage = `Publish ${ids.length} Gallery?`;
            break;
        case "draft":
            confirmMessage = `Jadikan draft ${ids.length} Gallery?`;
            break;
        case "archived":
            confirmMessage = `Arsipkan ${ids.length} Gallery?`;
            break;
        case "permanent_delete":
            confirmMessage = `⚠️ BAHAYA!\n\nHapus PERMANEN ${ids.length} Gallery?\n\nData tidak dapat dikembalikan!`;
            break;
    }

    if (confirm(confirmMessage)) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = window.bulkActionRoute;
        form.innerHTML = `
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
            <input type="hidden" name="action" value="${action}">
            ${ids.map(id => `<input type="hidden" name="ids[]" value="${id}">`).join('')}
        `;
        document.body.appendChild(form);
        form.submit();
    }
};

window.quickStatusChange = function (id, status) {
    if (confirm(`Ubah status Gallery ke ${status}?`)) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = window.bulkActionRoute;
        form.innerHTML = `
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
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