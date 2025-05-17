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
        <div class="p-4 flex items-center justify-center border-b border-[var(--secondary)]">
            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=عطاء&background=106665&color=ffffff&bold=true" alt="شعار عطاء">
            <div class="text-xl font-bold mr-2">مشروع عطاء</div>
        </div>
        <div class="p-2">
            <div class="text-sm text-primary px-4 py-2">المشرف</div>
            <div class="text-md font-bold px-4 pb-4">أدمن النظام</div>
        </div>
        <nav class="mt-2">
            <x-layouts.admin.nav href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard')" i="fas fa-tachometer-alt w-6">لوحة التحكم</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-building w-6">المؤسسات</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-users w-6">المتطوعون</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-clipboard-list w-6">الطلبات</x-layouts.admin.nav>
            <x-layouts.admin.nav href="#" :active="false" i="fas fa-flag w-6">الإبلاغات</x-layouts.admin.nav>


            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
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


            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
                <x-layouts.admin.nav-mobile i="fas fa-cog w-6" href="#" :active="false"> الإعدادات </x-layouts.admin.nav-mobile>
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
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary/10 text-primary">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">إجمالي المتطوعين</h2>
                                <p class="text-2xl font-bold text-primary">5,320</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-secondary/10 text-secondary ">
                                <i class="fas fa-building text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">إجمالي المؤسسات</h2>
                                <p class="text-2xl font-bold text-secondary">128</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500/10 text-blue-500">
                                <i class="fas fa-hands-helping text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">فرص التطوع النشطة</h2>
                                <p class="text-2xl font-bold text-blue-500">324</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-500">
                                <i class="fas fa-clipboard-list text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">طلبات معلقة</h2>
                                <p class="text-2xl font-bold text-yellow-500">42</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity & Pending Requests Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- System Activity -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium">أحدث النشاطات</h2>
                        </div>
                        <div class="p-4">
                            <ul class="space-y-4">
                                <li class="flex items-start pb-4 border-b border-gray-100">
                                    <div class="p-2 rounded-full bg-blue-100 text-blue-600">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-sm font-medium">تسجيل متطوع جديد</p>
                                        <p class="text-xs text-gray-500">قام المستخدم أحمد محمد بالتسجيل على المنصة</p>
                                        <p class="text-xs text-gray-400 mt-1">منذ 30 دقيقة</p>
                                    </div>
                                </li>
                                <li class="flex items-start pb-4 border-b border-gray-100">
                                    <div class="p-2 rounded-full bg-green-100 text-green-600">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-sm font-medium">موافقة على طلب مؤسسة</p>
                                        <p class="text-xs text-gray-500">تم الموافقة على انضمام مؤسسة النور الخيرية</p>
                                        <p class="text-xs text-gray-400 mt-1">منذ ساعتين</p>
                                    </div>
                                </li>
                                <li class="flex items-start pb-4 border-b border-gray-100">
                                    <div class="p-2 rounded-full bg-yellow-100 text-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-sm font-medium">تعديل بيانات</p>
                                        <p class="text-xs text-gray-500">قامت مؤسسة الخير التطوعية بتحديث بياناتها</p>
                                        <p class="text-xs text-gray-400 mt-1">منذ 5 ساعات</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="p-2 rounded-full bg-red-100 text-red-600">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-sm font-medium">إبلاغ جديد</p>
                                        <p class="text-xs text-gray-500">تم الإبلاغ عن محتوى غير مناسب في فرصة تطوعية</p>
                                        <p class="text-xs text-gray-400 mt-1">منذ يوم واحد</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Pending Approvals -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium">طلبات تنتظر الموافقة</h2>
                        </div>
                        <div class="p-4">
                            <ul class="space-y-4">
                                <li class="flex items-center justify-between pb-4 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=مؤسسة+الأمل&background=106665&color=fff" alt="صورة المؤسسة">
                                        <div class="mr-3">
                                            <p class="text-sm font-medium">مؤسسة الأمل الخيرية</p>
                                            <p class="text-xs text-gray-500">طلب تسجيل مؤسسة جديدة</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2  space-x-reverse">
                                        <button class="px-3 py-1 bg-primary text-white text-xs rounded-lg hover:bg-primaryLight transition duration-300 cursor-pointer">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg hover:bg-gray-300  transition duration-300 cursor-pointer">رفض</button>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between pb-4 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=مؤسسة+العطاء&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                                        <div class="mr-3">
                                            <p class="text-sm font-medium">مؤسسة العطاء</p>
                                            <p class="text-xs text-gray-500">طلب إضافة فرصة تطوعية</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 space-x-reverse">
                                        <button class="px-3 py-1 bg-primary text-white text-xs rounded-lg">استعراض</button>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between pb-4 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                            <span class="text-sm font-medium">خم</span>
                                        </div>
                                        <div class="mr-3">
                                            <p class="text-sm font-medium">خالد محمد</p>
                                            <p class="text-xs text-gray-500">طلب إعادة تفعيل حساب</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2  space-x-reverse">
                                        <button class="px-3 py-1 bg-primary text-white text-xs rounded-lg hover:bg-primaryLight transition duration-300 cursor-pointer">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg hover:bg-gray-300  transition duration-300 cursor-pointer">رفض</button>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                            <span class="text-sm font-medium">مس</span>
                                        </div>
                                        <div class="mr-3">
                                            <p class="text-sm font-medium">مركز سند للتنمية</p>
                                            <p class="text-xs text-gray-500">طلب تغيير نوع الحساب</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 space-x-reverse">
                                        <button class="px-3 py-1 bg-primary text-white text-xs rounded-lg">استعراض</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Organizations and Volunteers Data -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Organizations -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-medium">أحدث المؤسسات</h2>
                            <a href="#" class="text-primary hover:text-primaryLight text-sm">عرض الكل</a>
                        </div>
                        <div class="p-4">
                            <table class="w-full text-right">
                                <thead>
                                <tr class="text-gray-600 text-sm">
                                    <th class="pb-3 pr-4">اسم المؤسسة</th>
                                    <th class="pb-3 hidden md:table-cell">تاريخ الانضمام</th>
                                    <th class="pb-3">الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4">مؤسسة الخير التطوعية</td>
                                    <td class="py-3 hidden md:table-cell">20-02-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4">جمعية البيئة الخضراء</td>
                                    <td class="py-3 hidden md:table-cell">15-02-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4">مركز الرعاية الاجتماعية</td>
                                    <td class="py-3 hidden md:table-cell">10-02-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4">مؤسسة النماء للتنمية</td>
                                    <td class="py-3 hidden md:table-cell">05-02-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">تحت المراجعة</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4">مؤسسة الأمل الخيرية</td>
                                    <td class="py-3 hidden md:table-cell">01-02-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">معلقة</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Volunteers -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-medium">أحدث المتطوعين</h2>
                            <a href="#" class="text-primary hover:text-primary text-sm">عرض الكل</a>
                        </div>
                        <div class="p-4">
                            <table class="w-full text-right">
                                <thead>
                                <tr class="text-gray-600 text-sm">
                                    <th class="pb-3 pr-4">اسم المتطوع</th>
                                    <th class="pb-3 hidden md:table-cell">تاريخ الانضمام</th>
                                    <th class="pb-3">الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium">أم</span>
                                        </div>
                                        <span>أحمد محمد</span>
                                    </td>
                                    <td class="py-3 hidden md:table-cell">15-03-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشط</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-[var(--secondary)] text-white flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium">سأ</span>
                                        </div>
                                        <span>سارة أحمد</span>
                                    </td>
                                    <td class="py-3 hidden md:table-cell">13-03-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium">مع</span>
                                        </div>
                                        <span>محمد علي</span>
                                    </td>
                                    <td class="py-3 hidden md:table-cell">10-03-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشط</span></td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 pr-4 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-[var(--secondary)] text-white flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium">فخ</span>
                                        </div>
                                        <span>فاطمة خالد</span>
                                    </td>
                                    <td class="py-3 hidden md:table-cell">08-03-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">غير مفعل</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-primary  text-white flex items-center justify-center mr-2">
                                            <span class="text-xs font-medium">عخ</span>
                                        </div>
                                        <span>عمر خالد</span>
                                    </td>
                                    <td class="py-3 hidden md:table-cell">05-03-2025</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">معلق</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Reports -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-medium">أحدث الإبلاغات</h2>
                        <a href="#" class="text-primary  hover:text-primaryLight  text-sm">عرض الكل</a>
                    </div>
                    <div class="p-4">
                        <table class="w-full text-right">
                            <thead>
                            <tr class="text-gray-600 text-sm">
                                <th class="pb-3 pr-4">نوع الإبلاغ</th>
                                <th class="pb-3">المبلغ</th>
                                <th class="pb-3 hidden md:table-cell">تاريخ الإبلاغ</th>
                                <th class="pb-3 hidden md:table-cell">الحالة</th>
                                <th class="pb-3">الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">محتوى غير لائق</td>
                                <td class="py-3">أحمد محمد</td>
                                <td class="py-3 hidden md:table-cell">15-03-2025</td>
                                <td class="py-3 hidden md:table-cell"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">قيد المراجعة</span></td>
                                <td class="py-3">
                                    <button class="px-3 py-1 bg-primary  text-white text-xs rounded-lg">استعراض</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">فرصة تطوعية مكررة</td>
                                <td class="py-3">سارة أحمد</td>
                                <td class="py-3 hidden md:table-cell">14-03-2025</td>
                                <td class="py-3 hidden md:table-cell"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">تم المعالجة</span></td>
                                <td class="py-3">
                                    <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">تفاصيل</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">معلومات غير صحيحة</td>
                                <td class="py-3">محمد علي</td>
                                <td class="py-3 hidden md:table-cell">12-03-2025</td>
                                <td class="py-3 hidden md:table-cell"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">قيد المراجعة</span></td>
                                <td class="py-3">
                                    <button class="px-3 py-1 bg-primary  text-white text-xs rounded-lg">استعراض</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4">سلوك غير مناسب</td>
                                <td class="py-3">فاطمة خالد</td>
                                <td class="py-3 hidden md:table-cell">10-03-2025</td>
                                <td class="py-3 hidden md:table-cell"><span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">مرفوض</span></td>
                                <td class="py-3">
                                    <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">تفاصيل</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
