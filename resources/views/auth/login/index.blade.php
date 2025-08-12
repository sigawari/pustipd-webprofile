<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login - PUSTIPD UIN Raden Fatah</title>
        @vite('resources/css/app.css')
    </head>

    <body class="bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 mx-4 border border-blue-100">
            <!-- Logo Section -->
            <div class="flex justify-center mb-8">
                <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="UIN Raden Fatah Palembang"
                    class="h-20 w-auto" />
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-secondary mb-2">Selamat Datang</h1>
                <h2 class="text-secondary font-medium">Masuk ke Dashboard Admin PUSTIPD</h2>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-secondary mb-2">
                        Email Address
                    </label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        placeholder="admin@pustipd.radenfatah.ac.id"
                        class="w-full px-4 py-3 border border-secondary rounded-lg 
                              placeholder-custom-blue text-gray-900
                              focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary 
                              transition duration-200 ease-in-out" />
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-secondary mb-2">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required placeholder="••••••••"
                        class="w-full px-4 py-3 border border-secondary rounded-lg 
                              placeholder-custom-blue text-gray-900
                              focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary 
                              transition duration-200 ease-in-out" />
                </div>

                <!-- Hidden Role Field -->
                <input type="hidden" name="role" value="admin" />

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-secondary hover:bg-blue-700 text-white font-semibold py-3 px-4 
                           rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.02] 
                           focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2">
                    Masuk ke Dashboard
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-secondary">
                    © 2025 PUSTIPD UIN Raden Fatah Palembang
                </p>
            </div>
        </div>
    </body>

</html>
