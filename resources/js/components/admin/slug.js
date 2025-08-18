export default function autoSlug(nameSelector, slugSelector) {
    const nameInput = document.querySelector(nameSelector);
    const slugInput = document.querySelector(slugSelector);

    if (!nameInput || !slugInput) return; // kalau elemennya ga ketemu, stop

    nameInput.addEventListener("input", function () {
        const slug = this.value
            .toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w\-]+/g, "")
            .replace(/\-\-+/g, "-")
            .replace(/^-+/, "")
            .replace(/-+$/, "");

        slugInput.value = slug;
    });
}
window.autoSlug = autoSlug;
