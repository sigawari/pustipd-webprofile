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
                    <li>
                        <a href="{{ route('admin.dashboard') }}" @click="selected = 'Dashboard'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-blue-50 hover:text-blue-600"
                            :class="(selected === 'Dashboard') ? 'bg-blue-50 text-blue-600' : ''">
                            <svg :class="(selected === 'Dashboard') ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-blue-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Dashboard</span>
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
                        <a href="#" @click.prevent="selected = (selected === 'Beranda' ? '':'Beranda')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-indigo-50 hover:text-secondary"
                            :class="(selected === 'Beranda') ? 'bg-indigo-50 text-secondary' : ''">
                            <svg :class="(selected === 'Beranda') ? 'fill-secondary' : 'fill-gray-500 group-hover:fill-secondary'"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path
                                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />

                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Beranda</span>
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Beranda') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Beranda') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="{{ route('admin.manage-content.beranda.pencapaian') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Pencapaian
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manage-content.beranda.mitra') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Mitra
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manage-content.beranda.layanan') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-secondary hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Layanan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- TENTANG KAMI SECTION - DIPERBAIKI -->
            <div class="py-2 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">TENTANG KAMI</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Tentang' ? '' : 'Tentang')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-indigo-50 hover:text-indigo-600"
                            :class="(selected === 'Tentang') ? 'bg-indigo-50 text-indigo-600' : ''">
                            <svg :class="(selected === 'Tentang') ? 'fill-indigo-600' : 'fill-gray-500 group-hover:fill-indigo-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Tentang Kami</span>
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Tentang') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu - PERBAIKAN UTAMA DI SINI! -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Tentang') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="{{ route('admin.manage-content.tentang.profil') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manage-content.tentang.galeri') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Galeri
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manage-content.tentang.visi-misi') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Visi & Misi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manage-content.tentang.organisasi') }}"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Struktur Organisasi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- APP LAYANAN SECTION  -->
            <div class="py-4">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">APLIKASI DAN
                        LAYANAN</span>
                </h3>

                <ul class="flex flex-col gap-2 mb-2">
                    <li>
                        <a href="{{ route('admin.manage-content.layanan.applayanan') }}"
                            @click.stop="selected = (selected === 'Services' ? '' : 'Services')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-orange-50 hover:text-orange-600 cursor-pointer"
                            :class="(selected === 'Services') ? 'bg-orange-50 text-orange-600' : ''"
                            style="pointer-events: auto;">

                            <svg :class="(selected === 'Services') ? 'fill-orange-600' : 'fill-gray-500 group-hover:fill-orange-600'"
                                class="transition-colors duration-200 pointer-events-none flex-shrink-0"
                                width="20" height="20" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                            </svg>

                            <span class="menu-item-text pointer-events-none"
                                :class="sidebarToggle ? 'lg:hidden' : ''">
                                App dan Layanan
                            </span>
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
                    <li>
                        <a href="#" @click="selected = 'News'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-green-50 hover:text-green-600"
                            :class="(selected === 'News') ? 'bg-green-50 text-green-600' : ''">
                            <svg :class="(selected === 'News') ? 'fill-green-600' : 'fill-gray-500 group-hover:fill-green-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Berita</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click="selected = 'Announcements'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-red-50 hover:text-red-600"
                            :class="(selected === 'Announcements') ? 'bg-red-50 text-red-600' : ''">
                            <svg :class="(selected === 'Announcements') ? 'fill-red-600' : 'fill-gray-500 group-hover:fill-red-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Pengumuman</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click="selected = 'Tutorials'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-blue-50 hover:text-blue-600"
                            :class="(selected === 'Tutorials') ? 'bg-blue-50 text-blue-600' : ''">
                            <svg :class="(selected === 'Tutorials') ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-blue-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Tutorial</span>
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
                        <a href="#" @click.prevent="selected = (selected === 'Documents' ? '':'Documents')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-teal-50 hover:text-teal-600"
                            :class="(selected === 'Documents') ? 'bg-teal-50 text-teal-600' : ''">
                            <svg :class="(selected === 'Documents') ? 'fill-teal-600' : 'fill-gray-500 group-hover:fill-teal-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kelola
                                Dokumen</span>
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Documents') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Documents') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        Ketetapan
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        Panduan
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        Regulasi
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        SOP
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
                        <a href="#" @click="selected = 'FAQ'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-amber-50 hover:text-amber-600"
                            :class="(selected === 'FAQ') ? 'bg-amber-50 text-amber-600' : ''">
                            <svg :class="(selected === 'FAQ') ? 'fill-amber-600' : 'fill-gray-500 group-hover:fill-amber-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M11,18H13V16H11V18M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,6A4,4 0 0,0 8,10H10A2,2 0 0,1 12,8A2,2 0 0,1 14,10C14,12 11,11.75 11,15H13C13,12.75 16,12.5 16,10A4,4 0 0,0 12,6Z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">FAQ</span>
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
                    <li>
                        <a href="#" @click="selected = 'Users'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-violet-50 hover:text-violet-600"
                            :class="(selected === 'Users') ? 'bg-violet-50 text-violet-600' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                :class="(selected === 'Users') ? 'fill-violet-600' :
                                'fill-gray-500 group-hover:fill-violet-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Manajemen
                                User</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click="selected = 'Reports'"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-emerald-50 hover:text-emerald-600"
                            :class="(selected === 'Reports') ? 'bg-emerald-50 text-emerald-600' : ''">
                            <svg :class="(selected === 'Reports') ? 'fill-emerald-600' :
                            'fill-gray-500 group-hover:fill-emerald-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3,3H21A2,2 0 0,1 23,5V19A2,2 0 0,1 21,21H3A2,2 0 0,1 1,19V5A2,2 0 0,1 3,3M5,7V9H19V7H5M5,11V13H19V11H5M5,15V17H11V15H5Z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Laporan &
                                Analytics</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Settings' ? '':'Settings')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-gray-50 hover:text-gray-600"
                            :class="(selected === 'Settings') ? 'bg-gray-50 text-gray-600' : ''">
                            <svg :class="(selected === 'Settings') ? 'fill-gray-600' : 'fill-gray-500 group-hover:fill-gray-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.22,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.22,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Pengaturan</span>
                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Settings') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Settings') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-600 hover:bg-gray-25 rounded-lg transition-colors duration-200">
                                        SEO Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-600 hover:bg-gray-25 rounded-lg transition-colors duration-200">
                                        Konfigurasi Website
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-600 hover:bg-gray-25 rounded-lg transition-colors duration-200">
                                        Media Library
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-600 hover:bg-gray-25 rounded-lg transition-colors duration-200">
                                        Sistem
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>
