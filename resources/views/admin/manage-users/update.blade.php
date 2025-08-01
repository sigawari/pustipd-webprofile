<!-- Modal Edit Data -->
@foreach($users as $user)
<div id="UpdateModal-{{ $user->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

        <form method="POST" action="{{ route('admin.sistem.users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label for="name-{{ $user->id }}" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="name" id="name-update-{{ $user->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ $user->name }}" required>
            </div>
            <!-- Role -->
            <div class="mb-4">
                <label for="role-{{ $user->id }}" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="role-update-{{ $user->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User Public</option>
                </select>
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email-{{ $user->id }}" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email-update-{{ $user->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ $user->email }}" required>
            </div>
            <!-- Password (Optional / Kosongkan jika tidak diubah) -->
            <div class="mb-4">
                <label for="password-{{ $user->id }}" class="block text-sm font-medium text-gray-700 mb-2">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" id="password-{{ $user->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukan password baru">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeUpdateModal('{{ $user->id }}')"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nameUpdate = document.getElementById('name-update-{{ $user->id }}');
                    const roleUpdate = document.getElementById('role-update-{{ $user->id }}');
                    const emailUpdate = document.getElementById('email-update-{{ $user->id }}');

                    function generateEmailUpdate() {
                        const nameValue = nameUpdate.value.trim().split(" ")[0].toLowerCase();
                        const roleValue = roleUpdate.value;
                        if (nameValue && roleValue) {
                            emailUpdate.value = `${nameValue}.${roleValue}@pustipd.radenfatah.ac.id`;
                        } else {
                            emailUpdate.value = '';
                        }
                    }

                    // Event ketika modal dibuka → trigger update email
                    const observer = new MutationObserver(() => {
                        if (!nameUpdate || !roleUpdate) return;
                        generateEmailUpdate();
                    });

                    const modal = document.getElementById('UpdateModal-{{ $user->id }}');
                    if (modal) {
                        observer.observe(modal, {
                            attributes: true,
                            attributeFilter: ['class']
                        });
                    }

                    nameUpdate.addEventListener('input', generateEmailUpdate);
                    roleUpdate.addEventListener('change', generateEmailUpdate);
                });
            </script>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeUpdateModal('{{ $user->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endforeach
