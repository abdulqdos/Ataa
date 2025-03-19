<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المؤسسات | مشروع عطاء</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/js/app.js' , 'resources/css/app.css'])

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
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar (Desktop) -->
    <div id="sidebar" class="sidebar bg-[var(--primary)] text-white w-64 flex-shrink-0 hidden md:block overflow-y-auto transition-all duration-300">
        <div class="p-4 flex items-center justify-center border-b border-secondary">
            <div class="text-xl font-bold">مشروع عطاء</div>
        </div>
        <div class="p-2">
            <div class="text-sm text-gray-300 px-4 py-2">المؤسسة</div>
            <div class="text-md font-bold px-4 pb-4">مؤسسة الخير التطوعية</div>
        </div>
        <nav class="mt-2">

            <x-layouts.organiations.nav i="fas fa-tachometer-alt w-6" href="{{ route('organization.dashboard') }}"  :active="request()->is('organization/dashboard')" wire:navigate>لوحة التحكم</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-hands-helping w-6" href="{{ route('organization.opportunity') }}"  :active="request()->is('organization/opportunity')" wire:navigate>الفرص التطوعية</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-users w-6" href="#" :active="false">المتطوعون</x-layouts.organiations.nav>
            <x-layouts.organiations.nav i="fas fa-clipboard-list w-6" href="#" :active="false">الطلبات</x-layouts.organiations.nav>

            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
                <x-layouts.organiations.nav i="fas fa-sign-out-alt w-6" href="/logout" :active="false">تجيل الخروج</x-layouts.organiations.nav>
            </div>
        </nav>
    </div>

    <!-- Mobile Sidebar (Hidden by default) -->
    <div id="mobileSidebar" class="sidebar fixed top-0 right-0 h-full bg-[var(--primary)] text-white w-64 z-30 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="p-4 flex items-center justify-between border-b border-[var(--secondary)]">
            <div class="text-xl font-bold">مشروع عطاء</div>
            <button id="closeSidebar" class="text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-2">
            <div class="text-sm text-gray-300 px-4 py-2">المؤسسة</div>
            <div class="text-md font-bold px-4 pb-4">مؤسسة الخير التطوعية</div>
        </div>
        <nav class="mt-2">

            <x-layouts.organiations.nav-mobile i="fas fa-tachometer-alt w-6" href="/" :active="request()->is('organization/dashboard')" wire:navigate> لوحة التحكم </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-hands-helping w-6" href="{{ route('organization.opportunity') }}" :active="request()->is('organization/opportunity')" wire:navigate>الفرص التطوعية </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-users w-6" href="#" :active="false">المتطوعون </x-layouts.organiations.nav-mobile>
            <x-layouts.organiations.nav-mobile i="fas fa-clipboard-list w-6" href="#" :active="false">الطلبات </x-layouts.organiations.nav-mobile>

            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
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
                    <button id="toggleSidebar" class="text-gray-500 hover:text-[var(--primary)] md:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center text-gray-700 mx-4">
                            <i class="far fa-bell"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=مؤسسة+الخير&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                        <span class="mr-2 text-sm font-medium text-gray-700">مؤسسة الخير</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
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
</script>
</body>
</html>
