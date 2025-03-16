<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المؤسسات | مشروع عطاء</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/js/app.js' , 'resources/css/app.css'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#106665',
                        secondary: '#2d8c8a',
                        primaryLight: '#1a7e7d',
                        secondaryLight: '#3da3a1',
                    }
                }
            }
        }
    </script>
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
            <a href="#" class="sidebar-item active-link flex items-center px-4 py-3 text-sm">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span>لوحة التحكم</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-hands-helping w-6"></i>
                <span>فرص تطوعية</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-users w-6"></i>
                <span>المتطوعون</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-clipboard-list w-6"></i>
                <span>الطلبات</span>
            </a>
            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
                <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span>تسجيل خروج</span>
                </a>
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
            <a href="#" class="sidebar-item active-link flex items-center px-4 py-3 text-sm">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span>لوحة التحكم</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-hands-helping w-6"></i>
                <span>فرص تطوعية</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-users w-6"></i>
                <span>المتطوعون</span>
            </a>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                <i class="fas fa-clipboard-list w-6"></i>
                <span>الطلبات</span>
            </a>
            <div class="border-t border-[var(--secondary)] mt-4 pt-4">
                <a href="#" class="sidebar-item flex items-center px-4 py-3 text-sm">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span>تسجيل خروج</span>
                </a>
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
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-[var(--primary)]/10 text-[var(--primary)]">
                                <i class="fas fa-hands-helping text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">الفرص التطوعية</h2>
                                <p class="text-2xl font-bold text-[var(--primary)]">15</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-[var(--secondary)]/10  text-[var(--secondary)]">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">المتطوعون النشطون</h2>
                                <p class="text-2xl font-bold text-[var(--secondary)]">48</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-500 flex items-center">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">ساعات التطوع</h2>
                                <p class="text-2xl font-bold text-yellow-500">215</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500/10 text-blue-500 flex items-center">
                                <i class="fas fa-clipboard-list text-xl"></i>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-sm font-medium text-gray-600">طلبات الانضمام</h2>
                                <p class="text-2xl font-bold text-blue-500">7</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Opportunities -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-medium">أحدث الفرص التطوعية</h2>
                        <a href="#" class="text-[var(--primary)] hover:text-[var(--primaryLight)] text-sm transition duration-300">عرض الكل</a>
                    </div>
                    <div class="p-4">
                        <table class="w-full text-right">
                            <thead>
                            <tr class="text-gray-600 text-sm">
                                <th class="pb-3 pr-4">عنوان الفرصة</th>
                                <th class="pb-3 hidden md:table-cell">عدد المتطوعين</th>
                                <th class="pb-3 hidden md:table-cell">تاريخ البدء</th>
                                <th class="pb-3">الحالة</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">توزيع المساعدات الرمضانية</td>
                                <td class="py-3 hidden md:table-cell">12/20</td>
                                <td class="py-3 hidden md:table-cell">20-03-2025</td>
                                <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">تنظيم فعالية اليوم العالمي للتطوع</td>
                                <td class="py-3 hidden md:table-cell">5/15</td>
                                <td class="py-3 hidden md:table-cell">05-12-2025</td>
                                <td class="py-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">قريباً</span></td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4">حملة التشجير المحلية</td>
                                <td class="py-3 hidden md:table-cell">18/25</td>
                                <td class="py-3 hidden md:table-cell">10-03-2025</td>
                                <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">نشطة</span></td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4">دعم المسنين</td>
                                <td class="py-3 hidden md:table-cell">7/10</td>
                                <td class="py-3 hidden md:table-cell">01-03-2025</td>
                                <td class="py-3"><span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">مكتملة</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Volunteers and Stats in 2 columns -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Volunteers -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-medium">آخر المتطوعين المنضمين</h2>
                            <a href="#" class="text-primary hover:text-[var(--primaryLight)] text-sm">عرض الكل</a>
                        </div>
                        <div class="p-4">
                            <ul>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=أحمد+محمد&background=106665&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">أحمد محمد</p>
                                        <p class="text-xs text-gray-500">انضم منذ 3 أيام</p>
                                    </div>
                                    <span class="text-xs text-white bg-[var(--primary)] rounded-full px-2 py-1">5 ساعات تطوع</span>
                                </li>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=سارة+أحمد&background=2d8c8a&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">سارة أحمد</p>
                                        <p class="text-xs text-gray-500">انضمت منذ 5 أيام</p>
                                    </div>
                                    <span class="text-xs text-white bg-[var(--primary)] rounded-full px-2 py-1">12 ساعة تطوع</span>
                                </li>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=محمد+علي&background=106665&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">محمد علي</p>
                                        <p class="text-xs text-gray-500">انضم منذ أسبوع</p>
                                    </div>
                                    <span class="text-xs text-white bg-[var(--primary)] rounded-full px-2 py-1">8 ساعات تطوع</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=فاطمة+خالد&background=2d8c8a&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">فاطمة خالد</p>
                                        <p class="text-xs text-gray-500">انضمت منذ 10 أيام</p>
                                    </div>
                                    <span class="text-xs text-white bg-[var(--primary)] rounded-full px-2 py-1">15 ساعة تطوع</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Pending Requests -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium">طلبات الانضمام المعلقة</h2>
                        </div>
                        <div class="p-4">
                            <ul>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=عمر+خالد&background=106665&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">عمر خالد</p>
                                        <p class="text-xs text-gray-500">تقدم بطلب منذ يومين</p>
                                    </div>
                                    <div>
                                        <button class="px-3 py-1 bg-[var(--primary)] text-white text-xs rounded-lg ml-1">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">رفض</button>
                                    </div>
                                </li>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=نورة+سعد&background=2d8c8a&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">نورة سعد</p>
                                        <p class="text-xs text-gray-500">تقدمت بطلب منذ 3 أيام</p>
                                    </div>
                                    <div>
                                        <button class="px-3 py-1 bg-[var(--primary)] text-white text-xs rounded-lg ml-1">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">رفض</button>
                                    </div>
                                </li>
                                <li class="flex items-center py-3 border-b border-gray-100">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=خالد+محمد&background=106665&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">خالد محمد</p>
                                        <p class="text-xs text-gray-500">تقدم بطلب منذ 4 أيام</p>
                                    </div>
                                    <div>
                                        <button class="px-3 py-1 bg-[var(--primary)] text-white text-xs rounded-lg ml-1">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">رفض</button>
                                    </div>
                                </li>
                                <li class="flex items-center py-3">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=سلمى+أحمد&background=2d8c8a&color=fff" alt="صورة المتطوع">
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium">سلمى أحمد</p>
                                        <p class="text-xs text-gray-500">تقدمت بطلب منذ 5 أيام</p>
                                    </div>
                                    <div>
                                        <button class="px-3 py-1 bg-[var(--primary)] text-white text-xs rounded-lg ml-1">قبول</button>
                                        <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-lg">رفض</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
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
