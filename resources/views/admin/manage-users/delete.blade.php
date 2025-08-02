<!-- Modal Delete -->
@foreach($users as $user)
    <div id="DeleteModal-{{ $user->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-md w-full text-center relative">
            <div class="flex flex-col items-center space-y-4">
                <!-- Icon Warning -->
                <div class="bg-red-100 text-red-600 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Yakin ingin menghapus data ini?</h2>
                <p class="text-gray-500 text-sm">Tindakan ini tidak dapat dibatalkan.</p>
                <form id="deleteForm-{{ $user->id }}" method="POST" action="{{ route('admin.sistem.users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center space-x-3 mt-4">
                        <button type="button"
                            onclick="closeDeleteModal('{{ $user->id }}')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
            <!-- Tombol X -->
            <button onclick="closeDeleteModal('{{ $user->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

