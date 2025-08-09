// =============================
// Save item (disable editing)
// =============================
function saveListItem(button) {
    const item = button.closest('.flex');
    const inputs = item.querySelectorAll('input');

    let isValid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('border-red-300');
            isValid = false;
        } else {
            input.classList.remove('border-red-300');
        }
    });

    if (!isValid) {
        alert('Mohon isi semua field yang diperlukan.');
        return;
    }

    inputs.forEach(input => {
        input.setAttribute('readonly', true);
        input.classList.remove('bg-yellow-50', 'border-yellow-300');
        input.classList.add('bg-white');
    });

    button.classList.add('hidden');
    item.querySelector('.text-blue-600').classList.remove('hidden');
}

// ✅ Biar bisa dipanggil dari inline HTML
window.saveListItem = saveListItem;