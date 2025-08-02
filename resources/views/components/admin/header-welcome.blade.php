{{-- components/header-welcome.blade.php --}}
<div class="bg-gradient-to-r from-blue-900 to-secondary rounded-xl p-6 m-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, Administrator!</h2>
            <p class="text-blue-100 mb-4">
                Selamat datang di Dashboard Admin PUSTIPD
            </p>
            <p class="text-blue-100 mb-4">
                Kelola konten website PUSTIPD UIN Raden Fatah Palembang dengan mudah dan efisien
            </p>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-2 sm:space-y-0 text-sm text-blue-100">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Login terakhir: {{ now()->format('d M Y, H:i') }} WIB
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    System Online
                </div>
            </div>
        </div>
        <div class="hidden lg:block">
            <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="Logo UIN"
                class="w-20 h-16 opacity-80">
        </div>
    </div>
</div>
