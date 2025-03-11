<!doctype html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css' , 'resources/js/app.js'])
        @livewireStyles
        <title> {{ $title ?? 'العنوان الافتراضي' }}</title>
    </head>
    <body>
        <nav class="bg-[var(--primary)]">
            <!-- for all devices exists mobile -->
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-10 hidden md:block">
                <div class="relative flex   items-center justify-between">

                    <!-- Logo -->
                    <div class="flex flex-row justify-center items-center shrink-0 gap-3 sm:absolute sm:right-0 sm:ml-6 sm:justify-center sm:items-center ">
                        <img src="{{ asset('images/logo.svg') }}" alt="Ataa" class="max-w-12" />
                    </div>

                    <!-- Links -->
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-center mr-40">
                        <div class="md:flex space-x-3 hidden">
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="request()->is('/')">الرئيسية </x-layouts.volunteers.nav>
                        </div>
                    </div>

                    <!-- profile -->
                    <div class="absolute left-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @auth
                            <div class="flex flex-row gap-2">
                                <!-- notification -->
                                <button type="button" class="relative rounded-full bg-transparent p-1 text-white cursor-pointer">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">عرض الإشعارات</span>
                                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>
                                </button>

                                <!-- profile menu -->
                                <div class="relative ml-3">
                                    <div>
                                        <button type="button" id="profile-toggle-devices" class="relative flex rounded-full bg-white text-sm cursor-pointer" aria-expanded="false" aria-haspopup="true">
                                            <span class="absolute -inset-1.5"></span>
                                            <span class="sr-only">فتح قائمة المستخدم</span>
                                            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </button>
                                    </div>

                                    <!--menu dropdown -->
                                    <div id="profile-menu-devices" class="absolute left-0 z-10 mt-2 w-48 origin-top-left rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden hidden" role="menu" aria-orientation="vertical" aria-labelledby="profile-toggle" tabindex="-1">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الملف الشخصي</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الإعدادات</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">تسجيل الخروج</a>
                                    </div>
                                </div>
                            </div>

                        @endauth

                        @guest
                            <div class="flex space-x-4">
                                <!-- register -->
                                <a href="{{ route('login') }}" class="bg-transparent text-sm text-white py-1 px-3 rounded-full hover:bg-white hover:text-[var(--primary)] border border-white transition duration-300 ">
                                    إنشاء حساب
                                </a>

                                <!-- login -->
                                <a href="{{ route('login') }}" class="bg-white text-sm text-[var(--primary)] py-1 px-3 rounded-full hover:font-semibold hover:bg-white/90 transition duration-300 ">
                                    تسجيل الدخول
                                </a>

                            </div>
                        @endguest

                    </div>

                </div>
            </div>

            <!-- mobile section -->
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 md:hidden">
                <div class="relative flex flex-row h-16 items-center justify-between">

                    <!-- profile -->
                    <div class="absolute inset-y-0 left-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @auth
                            <div class="flex flex-row gap-2">
                                <!-- زر الإشعارات -->
                                <button type="button" class="relative rounded-full bg-transparent p-1 text-white cursor-pointer">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">عرض الإشعارات</span>
                                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>
                                </button>

                                <!-- قائمة منسدلة -->
                                <div class="relative ml-3">
                                    <div>
                                        <button type="button" id="profile-toggle" class="relative flex rounded-full bg-white text-sm cursor-pointer" aria-expanded="false" aria-haspopup="true">
                                            <span class="absolute -inset-1.5"></span>
                                            <span class="sr-only">فتح قائمة المستخدم</span>
                                            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </button>
                                    </div>

                                    <!-- قائمة منسدلة -->
                                    <div id="profile-menu" class="absolute left-0  z-10 mt-2  w-48 origin-top-left rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden hidden" role="menu" aria-orientation="vertical" aria-labelledby="profile-toggle" tabindex="-1">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الملف الشخصي</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الإعدادات</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">تسجيل الخروج</a>
                                    </div>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <div class="flex space-x-4">
                                <a href="{{ route('login') }}" class="text-white text-sm py-1 px-3 rounded-full border border-white hover:bg-white/80 hover:text-var[(--primary)] transition duration-300">تسجيل الدخول</a>
                            </div>
                        @endguest
                    </div>

                    <!-- logo on mobile -->
                    <div class="flex shrink-0 items-center sm:absolute sm:left-0 sm:ml-6 sm:justify-center sm:items-center mr-[40%]">
                        <img src="{{ asset('images/logo.svg') }}" alt="Ataa" class="max-w-16" />
                    </div>

                    <!-- icon menu -->
                    <div class="sm:hidden absolute inset-y-0 right-0 flex items-center pl-2">
                        <button type="button" id="menu-toggle" class="text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>


                </div>
            </div>

            <!-- menu dropdown -->
            <div id="mobile-menu" class="sm:hidden hidden">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <x-layouts.volunteers.x-responsive-nav href="/" :active="request()->is('/')"> الرئيسية </x-layouts.volunteers.x-responsive-nav>
                    <x-layouts.volunteers.x-responsive-nav href="/" :active="false"> الفريق </x-layouts.volunteers.x-responsive-nav>
                    <x-layouts.volunteers.x-responsive-nav href="/" :active="false"> المشاريع </x-layouts.volunteers.x-responsive-nav>
                    <x-layouts.volunteers.x-responsive-nav href="/" :active="false"> التقويم </x-layouts.volunteers.x-responsive-nav>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>
        @livewireScripts
    </body>

    <script>
        // drop down mobile
        document.getElementById("menu-toggle").addEventListener("click", function() {
            let mobileMenu = document.getElementById("mobile-menu");
            mobileMenu.classList.toggle("hidden");
        });

        // drop down profile => mobile
        document.getElementById("profile-toggle").addEventListener("click", function() {
            let profileMenu = document.getElementById("profile-menu");
            profileMenu.classList.toggle("hidden");
        });

        // drop down profile => devices
        document.getElementById("profile-toggle-devices").addEventListener("click", function() {
            let profileMenu = document.getElementById("profile-menu-devices");
            profileMenu.classList.toggle("hidden");
        });
    </script>
</html>
