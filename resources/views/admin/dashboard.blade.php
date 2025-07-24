<h1>
    Hello, Admin!
    Hello World!
    Welcome to the Admin Dashboard

    <form action="{{ route('login.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Logout
        </button>
    </form>
</h1>
