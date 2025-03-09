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
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-10 hidden lg:block">
                <div class="relative flex   items-center justify-between">

                    <!-- Logo -->
                    <div class="flex flex-row justify-center items-center shrink-0 gap-3 sm:absolute sm:right-0 sm:ml-6 sm:justify-center sm:items-center ">
                        <img src="{{ asset('images/logo.svg') }}" alt="Ataa" class="max-w-12" />
                    </div>

                    <!-- Links -->
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-center mr-40">
                        <div class="lg:flex space-x-3 hidden">
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false">الرئيسية </x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="request()->is('/')">الرئيسية </x-layouts.volunteers.nav>
                        </div>
                    </div>

                    <!-- profile -->
                    <div class="absolute left-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @auth
                            <!-- notification -->
                            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">عرض الإشعارات</span>
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                            </button>

                            <!-- profile menu -->
                            <div class="relative ml-3">
                                <div>
                                    <button type="button" id="profile-toggle-devices" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-expanded="false" aria-haspopup="true">
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
                        @endauth

                        @guest
                            <div class="flex space-x-4">
                                <!-- login -->
                                <x-layouts.volunteers.nav href="{{ route('login') }}" :active="request()->is('login')">
                                    تسجيل الدخول
                                </x-layouts.volunteers.nav>
                                <!-- register -->
                                <x-layouts.volunteers.nav href="#" :active="false">
                                    إنشاء حساب
                                </x-layouts.volunteers.nav>
                            </div>
                        @endguest

                    </div>

                </div>
            </div>

            <!-- mobile section -->
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 lg:hidden">

                <div class="relative flex flex-row h-16 items-center justify-between">

                    <!-- icon menu -->
                    <div class="sm:hidden absolute inset-y-0 right-0 flex items-center pl-2">
                        <button type="button" id="menu-toggle" class="text-gray-400 hover:text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- logo on mobile -->
                    <div class="flex shrink-0 items-center sm:absolute sm:left-0 sm:ml-6 sm:justify-center sm:items-center mr-[40%]">
                        <img src="{{ asset('images/logo.svg') }}" alt="Ataa" class="max-w-14" />
                    </div>

                    <!-- profile -->
                    <div class="absolute inset-y-0 left-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @auth
                            <!-- زر الإشعارات -->
                            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">عرض الإشعارات</span>
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                            </button>

                            <!-- قائمة منسدلة -->
                            <div class="relative ml-3">
                                <div>
                                    <button type="button" id="profile-toggle" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">فتح قائمة المستخدم</span>
                                        <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    </button>
                                </div>

                                <!-- قائمة منسدلة -->
                                <div id="profile-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden hidden" role="menu" aria-orientation="vertical" aria-labelledby="profile-toggle" tabindex="-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الملف الشخصي</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">الإعدادات</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">تسجيل الخروج</a>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <div class="flex space-x-4">
                                <x-layouts.volunteers.nav href="{{ route('login') }}" :active="request()->is('login')">تسجيل الدخول</x-layouts.volunteers.nav>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- menu dropdown -->
            <div id="mobile-menu" class="sm:hidden hidden">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">الرئيسية</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">الفريق</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">المشاريع</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">التقويم</a>
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
