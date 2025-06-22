<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title  ?? "لوحة تحكم المشرف | مشروع عطاء "}}</title>
        @vite(['resources/js/app.js' , 'resources/css/app.css'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <style type="text/css">
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');

            body {
                font-family: 'Tajawal', sans-serif;
            }

            .sidebar-item:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }

            .active-link {
                background-color: rgba(255, 255, 255, 0.15);
                border-right: 4px solid white;
            }

            @media (max-width: 768px) {
                .sidebar.hidden {
                    transform: translateX(100%);
                }

                .sidebar {
                    transform: translateX(0);
                    transition: transform 0.3s ease-in-out;
                }
            }
        </style>
        @livewireStyles
    </head>
    <body class="bg-gray-100 selection:text-white selection:bg-primary">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar (Desktop) -->
        <div id="sidebar" class="sidebar  bg-white text-gray-600 w-64 flex-shrink-0 hidden md:block overflow-y-auto transition-all duration-300">
            <div class="p-4 flex items-center justify-center border-b border-secondary">
                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=عطاء&background=106665&color=ffffff&bold=true" alt="شعار عطاء">
                <div class="text-xl font-bold mr-2">مشروع عطاء</div>
            </div>
            <div class="p-2">
                <div class="text-sm text-primary px-4 py-2">المشرف</div>
                <div class="text-md font-bold px-4 pb-4">أدمن النظام</div>
            </div>
            <nav class="mt-2">
                <x-layouts.admin.nav href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard')" i="fas fa-tachometer-alt w-6">لوحة التحكم</x-layouts.admin.nav>
                <x-layouts.admin.nav href="{{ route('admin.sectors') }}" :active="request()->is('admin/sectors')" i="fas fa-layer-group w-6">إدارة القطاعات</x-layouts.admin.nav>
                <x-layouts.admin.nav href="{{ route('admin.cities') }}" :active="request()->is('admin/cities')" i="fa-solid fa-city w-6">المدن</x-layouts.admin.nav>
                <x-layouts.admin.nav href="{{ route('admin.activityLogs')  }}" :active="request()->is('admin/activity_logs')" i="fas fa-tasks w-6">سجل النشاط</x-layouts.admin.nav>
                <x-layouts.admin.nav href="#" :active="false" i="fas fa-building w-6">المؤسسات</x-layouts.admin.nav>
                <x-layouts.admin.nav href="#" :active="false" i="fas fa-users w-6">المتطوعون</x-layouts.admin.nav>

                <div class="border-t border-secondary mt-4 pt-4">
                    @can('viewAny', App\Models\User::class )
                        <x-layouts.admin.nav href="{{ route('admin.admins') }}" :active="request()->is('admin/admins')" i="fa-solid fa-user-tie w-6">المسؤولين</x-layouts.admin.nav>
                    @endcan
                    <x-layouts.admin.nav href="{{ route('logout') }}" :active="false" i="fas fa-sign-out-alt w-6">تسجيل خروج</x-layouts.admin.nav>
                </div>
            </nav>
        </div>

        <!-- Mobile Sidebar (Hidden by default) -->
        <div id="mobileSidebar" class="sidebar fixed top-0 right-0 h-full bg-white text-gray-600 w-64 z-30 transform translate-x-full transition-transform duration-300 md:hidden">
            <div class="p-4 flex items-center justify-between border-b border-secondary">
                <div class="flex items-center">
                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=عطاء&background=ffffff&color=106665&bold=true" alt="شعار عطاء">
                    <div class="text-xl font-bold mr-2">مشروع عطاء</div>
                </div>
                <button id="closeSidebar" class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-2">
                <div class="text-sm text-gray-300 px-4 py-2">المشرف</div>
                <div class="text-md font-bold px-4 pb-4">أدمن النظام</div>
            </div>
            <nav class="mt-2">
                <x-layouts.admin.nav-mobile i="fas fa-tachometer-alt w-6" href="/" :active="request()->is('/')"> لوحة التحكم </x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile href="{{ route('admin.sectors') }}" :active="request()->is('admin/sectors')" i="fas fa-layer-group w-6">إدارة القطاعات</x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile href="{{ route('admin.cities') }}" :active="request()->is('admin/cities')" i="fa-solid fa-city w-6">المدن</x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile href="{{ route('admin.activityLogs')  }}" :active="request()->is('admin/activity_logs')" i="fas fa-tasks w-6">سجل النشاط</x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile i="fas fa-building w-6" href="#" :active="false"> المؤسسات </x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile i="fas fa-users w-6" href="#" :active="false"> المتطوعون </x-layouts.admin.nav-mobile>

                <div class="border-t border-secondary mt-4 pt-4">
                    @can('viewAny', App\Models\User::class )
                        <x-layouts.admin.nav-mobile href="{{ route('admin.admins') }}" :active="request()->is('admin/admins')" i="fa-solid fa-user-tie w-6">المسؤولين</x-layouts.admin.nav-mobile>
                    @endcan
                    <x-layouts.admin.nav-mobile i="fas fa-sign-out-alt w-6" href="/logout" :active="false"> تسجيل خروج </x-layouts.admin.nav-mobile>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-4">
                    <div>
                        <button id="toggleSidebar" class="text-gray-500 hover:text-primary md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <div class="relative mx-4">
                            <button class="flex items-center text-gray-700">
                                <i class="far fa-bell"></i>
                                <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">5</span>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center">
                                <span class="text-sm font-medium">أد</span>
                            </div>
                            <span class="mr-2 text-sm font-medium text-gray-700">أدمن النظام</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
                @if(session('success'))
                    <div id="alert" class="flex items-center p-4 mb-4 mx-5 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M16.707 5.293a1 1 0 0 0-1.414 0L8 12.586l-3.293-3.293a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l8-8a1 1 0 0 0 0-1.414z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button"  class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 cursor-pointer transition duration-300 close-alert" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>

    </div>

    <script>
        // Toggle sidebar on mobile
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const mobileSidebar = document.getElementById('mobileSidebar');


        toggleBtn.addEventListener('click', () => {
            mobileSidebar.classList.toggle('translate-x-full');
        });

        closeBtn.addEventListener('click', () => {
            mobileSidebar.classList.add('translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!mobileSidebar.contains(e.target) && e.target !== toggleBtn && !toggleBtn.contains(e.target)) {
                    mobileSidebar.classList.add('translate-x-full');
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".close-alert").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    const alertBox = btn.closest("[role='alert']");
                    if (alertBox) {
                        alertBox.style.display = "none";
                    }
                });
            });
        });


    </script>
    @livewireScripts
    </body>
</html>
