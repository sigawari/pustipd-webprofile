<x-admin.layouts>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">
            Admin Dashboard
        </h1>

        <div class="text-center space-y-2">
            <p>Halo, Admin!</p>
            <p>Selamat datang di halaman Dashboard</p>

            <form action="{{ route('login.logout') }}" method="POST" class="inline-block mt-4">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</x-admin.layouts>
