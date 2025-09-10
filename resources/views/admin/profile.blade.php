<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4">Profil Saya</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>
    </div>

</x-admin.layouts>
