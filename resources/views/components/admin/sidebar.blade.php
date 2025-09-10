<!-- resources/views/components/admin/sidebar.blade.php -->
<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full lg:translate-x-0'"
    class="sidebar fixed left-0 top-16 z-30 flex h-[calc(100vh-4rem)] w-[290px] flex-col overflow-y-hidden border-r border-gray-100 bg-white shadow-lg transition-transform duration-300 ease-in-out lg:translate-x-0">

    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center pt-8 sidebar-header pb-4 px-5 border-b border-gray-50">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="PUSTIPD Logo"
                :class="sidebarToggle ? 'w-8 h-7' : 'w-10 h-8'" class="transition-all duration-300">
            <div :class="sidebarToggle ? 'lg:hidden' : ''" class="leading-tight">
                <h2 class="font-bold text-secondary text-base">CMS PUSTIPD</h2>
                <p class="text-xs text-gray-500">Content Management</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar px-5">
        <nav x-data="{ selected: localStorage.getItem('selectedMenu') || 'Dashboard' }" x-init="$watch('selected', value => localStorage.setItem('selectedMenu', value))">

            <!-- DASHBOARD SECTION -->
            <div class="py-4">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">DASHBOARD</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}" 
                            @click="selected = 'Dashboard'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-blue-50 hover:text-blue-600"
                            :class="[
                                (selected === 'Dashboard') ? 'bg-blue-50 text-blue-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'Dashboard') ? 'fill-blue-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-blue-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- BERANDA SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">BERANDA</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <li>
                        <a href="#"
                            @click="selected = (selected === 'Beranda') ? null : 'Beranda'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-gray-200 hover:text-secondary"
                            :class="[
                                (selected === 'Beranda') ? 'bg-secondary-50 text-secondary' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">

                            <!-- ICON utama -->
                            <svg :class="(selected === 'Beranda') ? 'fill-secondary' : 'fill-gray-500'"
                                class="transition-colors duration-200 flex-shrink-0 group-hover:fill-secondary"
                                width="20" height="20" viewBox="0 0 24 24">
                                <path
                                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path
                                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Beranda</span>

                            <!-- ICON dropdown -->
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Beranda') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Beranda') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul class="flex flex-col gap-3 mt-2" :class="sidebarToggle ? 'pl-0.5' : 'pl-6'">
                                <!-- Pencapaian -->
                                <li>
                                    <a href="{{ route('admin.beranda.pencapaian.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Pencapaian</span>
                                    </a>
                                </li>

                                <!-- Mitra -->
                                <li>
                                    <a href="{{ route('admin.beranda.mitra.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Mitra</span>
                                    </a>
                                </li>

                                <!-- Layanan -->
                                <li>
                                    <a href="{{ route('admin.beranda.layanan.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Layanan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>


            <!-- TENTANG KAMI SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">TENTANG KAMI</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <li>
                        <a href="#"
                            @click="selected = (selected === 'Tentang') ? null : 'Tentang'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-indigo-50 hover:text-indigo-600"
                            :class="[
                                (selected === 'Tentang') ? 'bg-indigo-50 text-indigo-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">

                            <!-- ICON utama -->
                            <svg :class="(selected === 'Tentang') ? 'fill-indigo-600' : 'fill-gray-500'"
                                class="transition-colors duration-200 flex-shrink-0 group-hover:fill-indigo-600"
                                width="20" height="20" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Tentang Kami</span>

                            <!-- ICON dropdown -->
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Beranda') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Tentang') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul class="flex flex-col gap-3 mt-2" :class="sidebarToggle ? 'pl-0.5' : 'pl-6'">
                                <!-- Profil -->
                                <li>
                                    <a href="{{ route('admin.tentang-kami.profil.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Profil</span>                                    
                                    </a>
                                </li>
                                <!-- Galeri -->
                                <li>
                                    <a href="{{ route('admin.tentang-kami.gallery.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Galeri</span>                                    
                                    </a>
                                </li>
                                <!-- Visi & Misi -->
                                <li>
                                    <a href="{{ route('admin.tentang-kami.visi-misi.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Visi & Misi</span>                                    
                                    </a>
                                </li>
                                <!-- Struktur Organisasi -->
                                <li>
                                    <a href="{{ route('admin.tentang-kami.struktur-organisasi.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Struktur Organisasi</span>                                    
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- APP LAYANAN SECTION -->
            <div class="py-4">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        APLIKASI DAN LAYANAN
                    </span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <!-- Aplikasi dan Layanan -->
                    <li>
                        <a href="{{ route('admin.app-layanan.index') }}" 
                            @click="selected = 'Services'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-orange-50 hover:text-orange-600"
                            :class="[
                                (selected === 'Services') ? 'bg-orange-50 text-orange-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'Services') ? 'fill-orange-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-orange-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Aplikasi dan Layanan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- INFORMASI TERKINI SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">INFORMASI TERKINI</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <!-- Kelola Berita -->
                    <li>
                        <a href="{{ route('admin.informasi-terkini.kelola-berita.index') }}" 
                            @click="selected = 'News'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-green-50 hover:text-green-600"
                            :class="[
                                (selected === 'News') ? 'bg-green-50 text-green-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'News') ? 'fill-green-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-green-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                    <path
                                        d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"  >                                    
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Berita</span>
                        </a>
                    </li>
                    <!-- Kelola Pengumuman -->
                    <li>
                        <a href="{{ route('admin.informasi-terkini.kelola-pengumuman.index') }}" 
                            @click="selected = 'Announcements'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-red-50 hover:text-red-600"
                            :class="[
                                (selected === 'Announcements') ? 'bg-red-50 text-red-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'Announcements') ? 'fill-red-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-red-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Pengumuman</span>
                        </a>
                    </li>
                    <!-- Kelola Tutorial -->
                    <li>
                        <a href="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}" 
                            @click="selected = 'Tutorials'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-blue-50 hover:text-blue-600"
                            :class="[
                                (selected === 'Tutorials') ? 'bg-blue-50 text-blue-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'Tutorials') ? 'fill-blue-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-blue-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                        <path
                                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Tutorial</span>
                        </a>                        
                    </li>
                </ul>
            </div>

            <!-- DOKUMEN SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">DOKUMEN</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">                    
                    <li>
                        <a href="#"
                            @click="selected = (selected === 'Documents') ? null : 'Documents'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-teal-50 hover:text-teal-600"
                            :class="[
                                (selected === 'Documents') ? 'bg-teal-50 text-teal-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">

                            <!-- ICON utama -->
                            <svg :class="(selected === 'Documents') ? 'fill-teal-600' : 'fill-gray-500'"
                                class="transition-colors duration-200 flex-shrink-0 group-hover:fill-teal-600"
                                width="20" height="20" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Dokumen</span>

                            <!-- ICON dropdown -->
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Beranda') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Documents') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul class="flex flex-col gap-3 mt-2" :class="sidebarToggle ? 'pl-0.5' : 'pl-6'">
                                <!-- Kelola Ketetapan -->
                                <li>
                                    <a href="{{ route('admin.dokumen.ketetapan.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Ketetapan</span>                                    
                                    </a>
                                </li>
                                <!-- Kelola Panduan -->
                                <li>
                                    <a href="{{ route('admin.dokumen.panduan.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Panduan</span>                                    
                                    </a>
                                </li>
                                <!-- Kelola Regulasi -->
                                <li>
                                    <a href="{{ route('admin.dokumen.regulasi.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">Kelola Regulasi</span>                                    
                                    </a>
                                </li>
                                <!-- SOP -->
                                <li>
                                    <a href="{{ route('admin.tentang-kami.struktur-organisasi.index') }}"
                                        class="flex items-center gap-2 py-2 px-3 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                        </svg>
                                        <span :class="sidebarToggle ? 'hidden' : 'inline'">SOP</span>                                    
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- FAQ SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">FAQ</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <li>
                        <a href="{{ route('admin.faq.index') }}" 
                            @click="selected = 'FAQ'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-amber-50 hover:text-amber-600"
                            :class="[
                                (selected === 'FAQ') ? 'bg-amber-50 text-amber-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'FAQ') ? 'fill-amber-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-amber-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                    <path
                                        d="M11,18H13V16H11V18M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,6A4,4 0 0,0 8,10H10A2,2 0 0,1 12,8A2,2 0 0,1 14,10C14,12 11,11.75 11,15H13C13,12.75 16,12.5 16,10A4,4 0 0,0 12,6Z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">FAQ</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SISTEM SECTION -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">SISTEM</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <!-- Manage Users -->
                    <li>
                        <a href="{{ route('admin.sistem.manage-users.index') }}" 
                            @click="selected = 'Users'"
                            class="group relative rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-violet-50 hover:text-violet-600"
                            :class="[
                                (selected === 'Users') ? 'bg-violet-50 text-violet-600' : '',
                                sidebarToggle ? 'flex justify-center' : 'flex items-center gap-3'
                            ]">
                            
                            <!-- ICON -->
                            <svg :class="(selected === 'Users') ? 'fill-violet-600' : 'fill-gray-500'"
                                    class="transition-colors duration-200 flex-shrink-0 group-hover:fill-violet-600"
                                    width="20" height="20" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>

                            <!-- TEKS -->
                            <span :class="sidebarToggle ? 'hidden' : 'inline'">Manajemen Users</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>
