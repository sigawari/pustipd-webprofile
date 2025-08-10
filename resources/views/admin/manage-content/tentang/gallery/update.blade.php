<!-- Modal Edit Gallery -->
 @foreach ($galleries as $gallery)
 <div id="UpdateModal-{{ $gallery->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

        <form method="POST" action="{{ route('admin.manage-content.tentang.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

 
 
            <div class="space-y-4">
                 <div>
                     <label for="title-{{$gallery->id}}" class="block text-sm font-medium text-gray-700 mb-1">
                         Judul Gambar <span class="text-red-500">*</span>
                     </label>
                     <input type="text" name="title" id="title-{{$gallery->id}}"
                         class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                         value="{{ $gallery->title }}" required>
                 </div>
 

                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-1">
                         Gambar Saat Ini
                     </label>
                     <div id="currentImagePreview-{{$gallery->id}}" class="mb-2"></div>
                 </div>
 
            
                 <div>
                     <label for="image-{{$gallery->id}}" class="block text-sm font-medium text-gray-700 mb-1">
                         Ganti Gambar <small>(kosongkan jika tidak ingin mengganti)</small>
                     </label>
                     <input type="file" name="image" id="image-{{$gallery->id}}" accept="image/*"
                         class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                     <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                 </div>
 
          
                 <div>
                     <label for="event_date-{{$gallery->id}}" class="block text-sm font-medium text-gray-700 mb-1">
                         Tanggal<span class="text-red-500">*</span>
                     </label>
                     <input type="date" name="event_date" id="event_date-{{$gallery->id}}"
                         class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                         value="{{ $gallery->event_date ? $gallery->event_date->format('Y-m-d') : '' }}" required>
                 </div>
 
           
                 <div>
                     <label for="status-{{$gallery->id}}" class="block text-sm font-medium text-gray-700 mb-1">
                         Status
                     </label>
                     <select name="status" id="status-{{$gallery->id}}"
                         class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                         <option value="draft">Draft</option>
                         <option value="published">Published</option>
                         <option value="archived">Archived</option>
                     </select>
                 </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeUpdateModal('{{ $gallery->id }}')"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeUpdateModal('{{ $gallery->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
 @endforeach