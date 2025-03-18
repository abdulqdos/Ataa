<div>
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
</div>
