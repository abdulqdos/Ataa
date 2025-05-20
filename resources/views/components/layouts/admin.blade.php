<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المشرف | مشروع عطاء</title>
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
</head>
<body class="bg-gray-100">
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
            <x-layouts.admin.nav
                href="{{ route('admin.sectors') }}"
                :active="request()->is('admin/sectors')"
                i="fas fa-layer-group w-6">
                إدارة القطاعات
            </x-layouts.admin.nav>

            <x-layouts.admin.nav href="#" :active="false" i="fas fa-building w-6">المؤسسات</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-users w-6">المتطوعون</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-clipboard-list w-6">الطلبات</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-flag w-6">الإبلاغات</x-layouts.admin.nav>


            <div class="border-t border-secondary mt-4 pt-4">
                <x-layouts.admin.nav href="#" :active="false" i="fas fa-cog w-6">الإعدادات</x-layouts.admin.nav>
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
            <x-layouts.admin.nav-mobile i="fas fa-building w-6" href="#" :active="false"> المؤسسات </x-layouts.admin.nav-mobile>
            <x-layouts.admin.nav-mobile i="fas fa-users w-6" href="#" :active="false"> المتطوعون </x-layouts.admin.nav-mobile>
            <x-layouts.admin.nav-mobile i="fas fa-clipboard-list w-6" href="#" :active="false"> الطلبات </x-layouts.admin.nav-mobile>
            <x-layouts.admin.nav-mobile i="fas fa-flag w-6" href="#" :active="false"> الإبلاغات </x-layouts.admin.nav-mobile>


            <div class="border-t border-secondary mt-4 pt-4">
                <x-layouts.admin.nav-mobile i="fas fa-cog w-6" href="#" :active="false"> الإعدادات </x-layouts.admin.nav-mobile>
                <x-layouts.admin.nav-mobile i="fas fa-sign-out-alt w-6" href="/logout" :active="false"> تسجيل خروج </x-layouts.admin.nav-mobile>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      {{ $slot }}
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
