<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-16 z-30 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-100 bg-white shadow-lg">

    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7 px-5 border-b border-gray-50">
        <a href="index.html">
            <img class="logo-icon h-8" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="./images/logo/logo-icon.svg"
                alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar px-5">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div class="py-4">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="mx-auto fill-gray-400"
                        width="20" height="20" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-2 mb-6">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-blue-50 hover:text-blue-600"
                            :class="(selected === 'Dashboard') ? 'bg-blue-50 text-blue-600' : ''">

                            <svg :class="(selected === 'Dashboard') ? 'fill-blue-600' : 'fill-gray-500 group-hover:fill-blue-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Dashboard
                            </span>

                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Dashboard') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Dashboard') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="index.html"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-blue-600 hover:bg-blue-25 rounded-lg transition-colors duration-200">
                                        eCommerce
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Menu Item Calendar -->
                    <li>
                        <a href="calendar.html" @click="selected = (selected === 'Calendar' ? '':'Calendar')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-green-50 hover:text-green-600"
                            :class="(selected === 'Calendar') ? 'bg-green-50 text-green-600' : ''">

                            <svg :class="(selected === 'Calendar') ? 'fill-green-600' : 'fill-gray-500 group-hover:fill-green-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Calendar
                            </span>
                        </a>
                    </li>

                    <!-- Menu Item Profile -->
                    <li>
                        <a href="profile.html" @click="selected = (selected === 'Profile' ? '':'Profile')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-purple-50 hover:text-purple-600"
                            :class="(selected === 'Profile') ? 'bg-purple-50 text-purple-600' : ''">

                            <svg :class="(selected === 'Profile') ? 'fill-purple-600' : 'fill-gray-500 group-hover:fill-purple-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                User Profile
                            </span>
                        </a>
                    </li>

                    <!-- Menu Item Forms -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Forms' ? '':'Forms')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-orange-50 hover:text-orange-600"
                            :class="(selected === 'Forms') ? 'bg-orange-50 text-orange-600' : ''">

                            <svg :class="(selected === 'Forms') ? 'fill-orange-600' : 'fill-gray-500 group-hover:fill-orange-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Forms
                            </span>

                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Forms') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Forms') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="form-elements.html"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-orange-600 hover:bg-orange-25 rounded-lg transition-colors duration-200">
                                        Form Elements
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Menu Item Tables -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Tables' ? '':'Tables')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-indigo-50 hover:text-indigo-600"
                            :class="(selected === 'Tables') ? 'bg-indigo-50 text-indigo-600' : ''">

                            <svg :class="(selected === 'Tables') ? 'fill-indigo-600' : 'fill-gray-500 group-hover:fill-indigo-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.25 5.5C3.25 4.25736 4.25736 3.25 5.5 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V18.5C20.75 19.7426 19.7426 20.75 18.5 20.75H5.5C4.25736 20.75 3.25 19.7426 3.25 18.5V5.5ZM5.5 4.75C5.08579 4.75 4.75 5.08579 4.75 5.5V8.58325L19.25 8.58325V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H5.5ZM19.25 10.0833H15.416V13.9165H19.25V10.0833ZM13.916 10.0833L10.083 10.0833V13.9165L13.916 13.9165V10.0833ZM8.58301 10.0833H4.75V13.9165H8.58301V10.0833ZM4.75 18.5V15.4165H8.58301V19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5ZM10.083 19.25V15.4165L13.916 15.4165V19.25H10.083ZM15.416 19.25V15.4165H19.25V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15.416Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Tables
                            </span>

                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Tables') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Tables') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="basic-tables.html"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-25 rounded-lg transition-colors duration-200">
                                        Basic Tables
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Menu Item Pages -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Pages' ? '':'Pages')"
                            class="group relative flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-600 duration-300 ease-in-out hover:bg-teal-50 hover:text-teal-600"
                            :class="(selected === 'Pages') ? 'bg-teal-50 text-teal-600' : ''">

                            <svg :class="(selected === 'Pages') ? 'fill-teal-600' : 'fill-gray-500 group-hover:fill-teal-600'"
                                class="transition-colors duration-200" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.50391 4.25C8.50391 3.83579 8.83969 3.5 9.25391 3.5H15.2777C15.4766 3.5 15.6674 3.57902 15.8081 3.71967L18.2807 6.19234C18.4214 6.333 18.5004 6.52376 18.5004 6.72268V16.75C18.5004 17.1642 18.1646 17.5 17.7504 17.5H16.248V17.4993H14.748V17.5H9.25391C8.83969 17.5 8.50391 17.1642 8.50391 16.75V4.25ZM14.748 19H9.25391C8.01126 19 7.00391 17.9926 7.00391 16.75V6.49854H6.24805C5.83383 6.49854 5.49805 6.83432 5.49805 7.24854V19.75C5.49805 20.1642 5.83383 20.5 6.24805 20.5H13.998C14.4123 20.5 14.748 20.1642 14.748 19.75L14.748 19ZM7.00391 4.99854V4.25C7.00391 3.00736 8.01127 2 9.25391 2H15.2777C15.8745 2 16.4468 2.23705 16.8687 2.659L19.3414 5.13168C19.7634 5.55364 20.0004 6.12594 20.0004 6.72268V16.75C20.0004 17.9926 18.9931 19 17.7504 19H16.248L16.248 19.75C16.248 20.9926 15.2407 22 13.998 22H6.24805C5.00541 22 3.99805 20.9926 3.99805 19.75V7.24854C3.99805 6.00589 5.00541 4.99854 6.24805 4.99854H7.00391Z" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Pages
                            </span>

                            <svg class="absolute right-4 stroke-current transition-transform duration-200"
                                :class="[(selected === 'Pages') ? 'rotate-180' : '', sidebarToggle ? 'lg:hidden' : '']"
                                width="16" height="16" viewBox="0 0 20 20">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="overflow-hidden transition-all duration-300 ease-in-out"
                            :class="(selected === 'Pages') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'" class="flex flex-col gap-1 mt-2 pl-12">
                                <li>
                                    <a href="blank.html"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        Blank Page
                                    </a>
                                </li>
                                <li>
                                    <a href="404.html"
                                        class="block py-2 px-4 text-sm text-gray-500 hover:text-teal-600 hover:bg-teal-25 rounded-lg transition-colors duration-200">
                                        404 Error
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Others Group -->
            <div class="py-4 border-t border-gray-100">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 font-semibold tracking-wider">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        OTHERS
                    </span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="mx-auto fill-gray-400"
                        width="20" height="20" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-2 mb-6">
                    <!-- Additional menu items would follow the same pattern -->
                </ul>
            </div>
        </nav>
    </div>
</aside>
