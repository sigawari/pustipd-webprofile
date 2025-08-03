<!-- Modal Tambah Data -->
<div id="achievementModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah {{ $title }}</h2>

        <form id="achievementForm" method="POST" action="{{ route('admin.sistem.users.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="name" id="name"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukan Nama" required>
            </div>
            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="role"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user_public">User Public</option>
                </select>
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" readonly
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Email akan terisi otomatis" required>
            </div>
            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="email@example.com" required>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
            <!-- Script untuk mengisi email otomatis berdasarkan nama dan role -->
            <script>
                const nameInput = document.getElementById('name');
                const roleSelect = document.getElementById('role');
                const emailInput = document.getElementById('email');
                function generateEmail() {
                    const nameValue = nameInput.value.trim().split(" ")[0].toLowerCase(); // ambil nama depan
                    const roleValue = roleSelect.value;
                    if (nameValue && roleValue) {
                        emailInput.value = `${nameValue}.${roleValue}@pustipd.radenfatah.ac.id`;
                    } else {
                        emailInput.value = '';
                    }
                }
                nameInput.addEventListener('input', generateEmail);
                roleSelect.addEventListener('change', generateEmail);
            </script>
        </form>
        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
