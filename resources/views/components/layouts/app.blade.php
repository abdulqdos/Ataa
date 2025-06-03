<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> {{ $title ?? "مشروع عطاء | منصة التطوع" }} </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css'])
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');

            body {
                font-family: 'Tajawal', sans-serif;
            }

            .hero-gradient {
                background: linear-gradient(to left, rgba(16, 102, 101, 0.8), rgba(45, 140, 138, 0.8));
            }
        </style>
        @livewireStyles
    </head>
    <body class="bg-gray-50 selection:bg-primary/80 selection:text-white">

        <!-- Navbar -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-10 w-auto" src="{{ asset('images/logo.svg') }}" alt="شعار عطاء">
                            <span class="mr-2 text-xl font-bold text-primary">عطاء</span>
                        </div>
                        <div class="hidden sm:gap-6 sm:flex  sm:space-x-reverse sm:mr-6">
                            <x-layouts.volunteers.nav href="/" :active="request()->is('/')" wire:navigate.keep>الرئيسية</x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="{{ route('opportunities') }}" :active="request()->is('opportunity')" wire:navigate.keep>فرص التطوع</x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="{{ route('volunteers') }}" :active="request()->is('volunteers')" wire:navigate.keep> المتطوعون</x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="{{ route('organizations') }}" :active="request()->is('organizations')" wire:navigate>المؤسسات</x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false" wire:navigate>عن عطاء</x-layouts.volunteers.nav>
                            <x-layouts.volunteers.nav href="/" :active="false" wire:navigate >تواصل معنا</x-layouts.volunteers.nav>
                        </div>
                    </div>

                    @guest
                        <!-- Auth Section - For Non-authenticated users (Guest View) -->
                        <div id="guestView" class="hidden sm:flex sm:items-center sm:mr-6">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition duration-300">تسجيل الدخول</a>
                            <a href="{{ route('signup') }}" class="bg-primary text-white hover:bg-primaryLight px-4 py-2 rounded-md text-sm font-medium transition duration-300">إنشاء حساب</a>
                        </div>
                    @endguest

                    @auth
                        <!-- Auth Section - For Authenticated users -->
                        <div class="flex flex-row items-center">

                            <!-- Notification -->
                            <livewire:notifications  :user="auth()->user()"/>

                            <div id="authView" class="sm:flex sm:items-center sm:mr-3">
                                <div class="mr-3 relative">
                                    <div>
                                        <button type="button" id="userMenuButton" class="flex rounded-full focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-primary" aria-expanded="false" aria-haspopup="true">
                                            <span class="sr-only">افتح قائمة المستخدم</span>
                                            @if(auth()->user()->img_url !== null)
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->img_url) }}" alt="صورة المؤسسة">
                                            @else
                                                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{auth()->user()->volunteer?->first_name}}&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                                            @endif
                                        </button>
                                    </div>
                                    <div id="userMenu" class="hidden origin-top-left absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton" tabindex="-1">
                                        <a href="{{ route('volunteers.profile' , auth()->user()->volunteer?->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">الملف الشخصي</a>
                                        <a href="{{ route('volunteers.myOpportunity') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">فرصي التطوعية</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">الإعدادات</a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">تسجيل الخروج</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endauth

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button type="button" id="mobileMenuButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">افتح القائمة الرئيسية</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1 bg-gray-50">
                    <x-layouts.volunteers.nav-mobile href="/" :active="request()->is('/')" wire:navigate.keep> الرئيسية </x-layouts.volunteers.nav-mobile>
                    <x-layouts.volunteers.nav-mobile href="{{ route('opportunities') }}" :active="request()->is('opportunity')" wire:navigate.keep> فرص التطوع </x-layouts.volunteers.nav-mobile>
                    <x-layouts.volunteers.nav-mobile href="{{ route('volunteers') }}" :active="request()->is('volunteers')" wire:navigate.keep>المتطوعون </x-layouts.volunteers.nav-mobile>
                    <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate.keep>المؤسسات </x-layouts.volunteers.nav-mobile>
                    <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate.keep>عن عطاء </x-layouts.volunteers.nav-mobile>
                    <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate.keep>تواصل معنا </x-layouts.volunteers.nav-mobile>
                </div>

                <!-- Mobile auth section - For Non-authenticated users -->
                @guest
                    <div id="mobileGuestView" class="lg:hidden flex  pt-4 pb-3 border-t border-gray-200 bg-gray-50">
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('login') }}" class="block pr-3 pl-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">تسجيل الدخول</a>
                            <a href="{{ route('signup') }}" class="block pr-3 pl-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">إنشاء حساب</a>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>

        <main class="z-1">
            @if(session('success'))
                <div id="alert-border-3" class="flex items-center p-4 my-4 mx-5 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" >
                        <path d="M16.707 5.293a1 1 0 0 0-1.414 0L8 12.586l-3.293-3.293a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l8-8a1 1 0 0 0 0-1.414z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 cursor-pointer transition duration-300 close-alert" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
            {{ $slot }}
        </main>

    <!-- Footer -->
        <footer class="bg-primary">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-1">
                        <div class="flex items-center">
                            <img class="h-10 w-auto" src=" {{ asset('images/logo.svg') }}" alt="شعار عطاء">
                            <span class="mr-2 text-xl font-bold text-white">عطاء</span>
                        </div>
                        <p class="mt-4 text-gray-200">
                            منصة متكاملة للأعمال التطوعية تربط المتطوعين بالمؤسسات والفرص التطوعية.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase">
                            روابط مهمة
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    عن المشروع
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    كيفية التطوع
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    الأسئلة الشائعة
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    سياسة الخصوصية
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase">
                            تواصل معنا
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    <i class="fas fa-envelope mr-2"></i> info@ataa.example.com
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    <i class="fas fa-phone mr-2"></i> 0916050468
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-300 hover:text-white">
                                    <i class="fas fa-map-marker-alt mr-2"></i> طرابلس، ليبيا
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase">
                            تابعنا
                        </h3>
                        <div class="mt-4 flex space-x-6">
                            <a href="#" class="text-gray-200 hover:text-white">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-200 hover:text-white">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-200 hover:text-white">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-200 hover:text-white">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">
                                النشرة البريدية
                            </h3>
                            <form class="mt-2 flex flex-col">
                                <input type="email" class="px-4 py-2 rounded-md w-full bg-white placeholder-text-secondary focus:outline-none" placeholder="البريد الإلكتروني">
                                <button type="submit" class="mt-2 bg-secondary text-white py-2 px-4 rounded-md hover:bg-secondaryLight cursor-pointer">
                                    اشترك الآن
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t border-secondary pt-8">
                    <p class="text-center text-base text-gray-300">
                        &copy; 2025 مشروع عطاء للأعمال التطوعية. جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
        </footer>
        <script>
            document.addEventListener('livewire:navigated', () => {
                // إعادة ربط أحداث القائمة المنسدلة للمستخدم
                const userMenuButton = document.getElementById("userMenuButton");
                const userMenu = document.getElementById("userMenu");

                if (userMenuButton && userMenu) {
                    userMenuButton.addEventListener("click", () => {
                        userMenu.classList.toggle("hidden");
                    });

                    document.addEventListener("click", (event) => {
                        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                            userMenu.classList.add("hidden");
                        }
                    });
                }

                // إعادة ربط أحداث قائمة الجوال
                const mobileMenuButton = document.getElementById("mobileMenuButton");
                const mobileMenu = document.getElementById("mobile-menu");

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener("click", () => {
                        mobileMenu.classList.toggle("hidden");
                    });

                    document.addEventListener("click", (event) => {
                        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                            mobileMenu.classList.add("hidden");
                        }
                    });
                }

                // إعادة ربط حدث إغلاق التنبيه
                document.querySelector(".close-alert")?.addEventListener("click", () => {
                    document.getElementById("alert-border-3").style.display = "none";
                });
            });
        </script>
        @livewireScripts
    </body>
</html>
