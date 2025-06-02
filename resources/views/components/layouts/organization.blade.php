<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title ?? 'لوحة تحكم المؤسسات | مشروع عطاء'}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite('resources/css/app.css')
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');

        body {
            font-family: 'Tajawal', sans-serif;
        }

        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
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
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar (Desktop) -->
    <div id="sidebar" class="sidebar  bg-white text-gray-600 w-64 flex-shrink-0 hidden md:block overflow-y-auto transition-all duration-300">
        <div class="p-4 flex items-center justify-center border-b border-secondary">
            <div class="text-xl font-bold">مشروع عطاء</div>
        </div>
        <div class="p-2">
            <div class="text-sm text-primary px-4 py-2">المؤسسة</div>
            <div class="text-md font-bold px-4 pb-4"> {{  auth()->user()->organization?->name }}</div>
        </div>

        <nav class="mt-2">

            <x-layouts.organiations.nav i="fas fa-tachometer-alt w-6" href="{{ route('organization.dashboard') }}"  :active="request()->is('organization/dashboard')" wire:navigate>لوحة التحكم</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-hands-helping w-6" href="{{ route('organization.opportunity') }}"  :active="request()->is('organization/opportunities')" wire:navigate>الفرص التطوعية</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-users w-6" href="{{ route('organization.opportunities-volunteers') }}" :active="request()->is('organization/opportunities-volunteers')">المتطوعون</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-clipboard-list w-6" href="{{ route('organization.requests') }}" :active="request()->is('organization/requests')">الطلبات</x-layouts.organiations.nav>

            <div class="border-t border-secondary mt-4 pt-4">
                <x-layouts.organiations.nav i="fas fa-user w-6" href="{{ route('organization.update-profile') }}" :active="false">الملف الشخصي</x-layouts.organiations.nav>
                <x-layouts.organiations.nav i="fas fa-sign-out-alt w-6" href="/logout" :active="false">تجيل الخروج</x-layouts.organiations.nav>
            </div>
        </nav>
    </div>

    <!-- Mobile Sidebar (Hidden by default) -->
    <div id="mobileSidebar" class="sidebar fixed top-0 right-0 h-full bg-white text-gray-600 w-64 z-30 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="p-4 flex items-center justify-between border-b boseconda">
            <div class="text-xl font-bold">مشروع عطاء</div>
            <button id="closeSidebar" class="text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-2">
            <div class="text-sm text-primary px-4 py-2">المؤسسة</div>
            <div class="text-md font-bold px-4 pb-4">{{ auth()->user()->organization?->name  }}</div>
        </div>
        <nav class="mt-2">
            <x-layouts.organiations.nav-mobile i="fas fa-tachometer-alt w-6" href="/" :active="request()->is('organization/dashboard')" wire:navigate.keep> لوحة التحكم </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-hands-helping w-6" href="{{ route('organization.opportunity') }}" :active="request()->is('organization/opportunities')" wire:navigate.keep>الفرص التطوعية </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-users w-6" href="#" :active="false">المتطوعون </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-clipboard-list w-6" href="{{ route('organization.requests') }}" :active="request()->is('organization/requests')">الطلبات </x-layouts.organiations.nav-mobile>

            <div class="border-t border-secondary mt-4 pt-4">
                <x-layouts.organiations.nav-mobile i="fas fa-user w-6" href="{{ route('organization.update-profile') }}" :active="false">الملف الشخصي</x-layouts.organiations.nav-mobile>
                <x-layouts.organiations.nav-mobile i="fas fa-sign-out-alt w-6" href="/logout" :active="false">تسجيل الخروج </x-layouts.organiations.nav-mobile>
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
                <div class="flex items-center justify-center gap-2">
                    <div class="relative mt-2">
                        <livewire:notifications />
                    </div>
                    <div class="flex items-center">
                        @if(auth()->user()->organization?->img_url === null)
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{auth()->user()->organization?->name}}&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                        @else
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->organization?->img_url) }}" alt="صورة المؤسسة">
                        @endif
                            <span class="mr-2 text-sm font-medium text-gray-700 hidden lg:inline"> {{ auth()->user()->organization?->name }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
            @if(session('success'))
                <div id="alert-border-3" class="flex items-center p-4 mb-4 mx-5 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
        document.querySelector(".close-alert").addEventListener("click", function () {
            document.getElementById("alert-border-3").style.display = "none";
        });
    });
</script>
@livewireScripts

</body>
</html>
