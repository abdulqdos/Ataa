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
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition duration-300" role="menuitem" tabindex="-1">الملف الشخصي</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition duration-300" role="menuitem" tabindex="-1">الإعدادات</a>
                                        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition duration-300" role="menuitem" tabindex="-1">تسجيل الخروج</a>
                                    </div>
                                </div>
                            </div>

                        @endauth

                        @guest
                            <div class="flex space-x-4">
                                <!-- register -->
                                <a href="{{ route('signup') }}" class="bg-transparent text-sm text-white py-1 px-3 rounded-full hover:bg-white hover:text-[var(--primary)] border border-white transition duration-300 ">
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
                    <div class="sm:hidden absolute inset-y-0 right-0 flex items-center pl-2 max-w-24">
                        <button type="button" id="menu-toggle" class="text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>


                </div>
            </div>

            <!-- menu dropdown -->
            <div id="mobile-menu" class="sm:hidden hidden shadow-md z-50">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <x-layouts.volunteers.responsive-nav href="/" :active="true"> الرئيسية </x-layouts.volunteers.responsive-nav>
                    <x-layouts.volunteers.responsive-nav href="/" :active="false"> الفريق </x-layouts.volunteers.responsive-nav>
                    <x-layouts.volunteers.responsive-nav href="/" :active="false"> المشاريع </x-layouts.volunteers.responsive-nav>
                    <x-layouts.volunteers.responsive-nav href="/" :active="false"> التقويم </x-layouts.volunteers.responsive-nav>
                </div>
            </div>
        </nav>

        <main>
            <div class="my-5">
                @if(session('success'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 " role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 cursor-pointer" data-dismiss-target="#alert-3" aria-label="Close" onclick="document.getElementById('alert-3').style.display = 'none';">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
                {{ $slot }}
        </main>



        <footer class="bg-[var(--primary)] text-white">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between mx-20">
                    <div class="mb-6 md:mb-0">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('images/logo.svg') }}" class="h-8 me-3" alt="FlowBite Logo" />
                            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">عطاء</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="text-lg font-semibold mb-3">روابط مهمة</h2>
                            <ul class="space-y-2">
                                <li><a href="#" class="hover:underline">الرئيسية</a></li>
                                <li><a href="#" class="hover:underline">حول عطاء</a></li>
                                <li><a href="#" class="hover:underline">اتصل بنا</a></li>
                                <li><a href="#" class="hover:underline">الأسئلة الشائعة</a></li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-lg font-semibold  uppercase">تابعنا</h2>
                            <ul class="text-white  font-medium">
                                <li class="mb-4">
                                    <a href="https://github.com/abdulqdos" class="hover:underline">Github</a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/x._3bdo_.x/" class="hover:underline">instagram</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-lg font-semibold uppercase">القوانين</h2>
                            <ul class="text-white font-medium">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">سياسة الخصوصية</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">الشروط والأحكام</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto  lg:my-8 mx-20" />
                <div class="sm:flex sm:items-center sm:justify-between mx-20">
                    <span class="text-sm text-white sm:text-center ">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
          </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="https://www.facebook.com/profile.php?id=100013918442051" class="text-white hover:text-gray-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-white hover:text-gray-300  ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="https://github.com/abdulqdos" class="text-white hover:text-gray-300 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="https://www.instagram.com/x._3bdo_.x/" class="text-white hover:text-gray-300 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0-2A7.75 7.75 0 0 0 0 7.75v8.5A7.75 7.75 0 0 0 7.75 24h8.5A7.75 7.75 0 0 0 24 16.25v-8.5A7.75 7.75 0 0 0 16.25 0h-8.5ZM12 7.25a4.75 4.75 0 1 1 0 9.5 4.75 4.75 0 0 1 0-9.5Zm0 2a2.75 2.75 0 1 0 0 5.5 2.75 2.75 0 0 0 0-5.5ZM17 5.25a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"/>
                            </svg>
                            <span class="sr-only">Instagram account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

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
