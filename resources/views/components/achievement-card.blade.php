@props(['subtitle', 'title'])

<div
    class="group rounded-lg border border-gray-200 shadow-lg transition-all duration-300 transform hover:-translate-y-2">
    <div class="card-animated p-8 text-center rounded-lg">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
            <svg class="w-14 h-14 text-secondary card-text transition-colors duration-300"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M20.25 1.999c.966 0 1.75.784 1.75 1.75v3.043a2.75 2.75 0 0 1-1.477 2.437l-6.282 3.28a5 5 0 1 1-4.483 0L3.478 9.23A2.75 2.75 0 0 1 2 6.792V3.749c0-.966.784-1.75 1.75-1.75zM12 13.48a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7m3.5-9.982h-7v6.662l3.384 1.768a.25.25 0 0 0 .232 0l3.384-1.769zm-8.5 0l-3.25.001a.25.25 0 0 0-.25.25v3.043c0 .465.259.892.671 1.108L7 9.376zm13.25.001L17 3.498v5.878L19.829 7.9a1.25 1.25 0 0 0 .671-1.108V3.749a.25.25 0 0 0-.25-.25" />
            </svg>
        </div>
        <h4 class="text-sm text-secondary mb-2 card-text">{{ $subtitle }}</h4>
        <h3 class="text-lg font-bold text-secondary card-text">{{ $title }}</h3>
    </div>
</div>
