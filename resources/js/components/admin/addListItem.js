// =============================
// Add new list item
// =============================
export function addListItem(listType, namePlaceholder, urlPlaceholder) {
    const container = document.getElementById(`${listType}-list`);
    const emptyMessage = container.querySelector(".border-dashed");
    if (emptyMessage) emptyMessage.remove();

    const index = container.children.length;

    const nameField = "name";

    const newItem = document.createElement("div");
    newItem.className =
        "flex flex-wrap items-center gap-2 p-3 bg-gray-50 rounded-lg";
    newItem.innerHTML = `
        <input type="text" name="${listType}[${index}][${nameField}]" placeholder="${namePlaceholder}"
            class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="url" name="${listType}[${index}][url]" placeholder="${urlPlaceholder}"
            class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="editListItem(this)" class="text-sm text-blue-600 hover:text-blue-800 px-2 py-1 rounded hidden">Edit</button>
        <button type="button" onclick="saveListItem(this)" class="text-sm text-green-600 hover:text-green-800 px-2 py-1 rounded">Save</button>
        <button type="button" onclick="removeListItem(this)" class="text-sm text-red-600 hover:text-red-800 px-2 py-1 rounded">Delete</button>
    `;

    container.appendChild(newItem);
    newItem.querySelector("input").focus();
}

window.addListItem = addListItem;
