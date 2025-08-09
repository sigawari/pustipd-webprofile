// =============================
// Enable edit mode
// =============================
function editListItem(button) {
    const item = button.closest('.flex');
    const inputs = item.querySelectorAll('input');

    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.classList.remove('bg-white');
        input.classList.add('bg-yellow-50', 'border-yellow-300');
    });

    button.classList.add('hidden');
    item.querySelector('.text-green-600').classList.remove('hidden');
    inputs[0].focus();
}

// ✅ Biar bisa dipanggil dari inline HTML
window.editListItem = editListItem;