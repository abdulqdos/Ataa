<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 my-4">
    <div class="bg-white rounded-lg shadow-md p-8 text-right w-full max-w-3xl mx-4 border border-gray-100" dir="rtl">
        <!-- العنوان -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.083 0 4.064.48 5.879 1.339M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            الملف الشخصي
        </h1>

        <p class="text-gray-600 mb-8">قم بإدارة اسمك، كلمة المرور، وإعدادات حسابك.</p>

        <!-- قسم صورة الملف الشخصي -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">صورة الملف الشخصي</h2>
            <div class="flex items-center space-x-6 space-x-reverse gap-4">
                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                    <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-3">
                        <button type="button" class="flex items-center gap-2 btn-blue px-4 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v16h16V4H4zm4 8l4 4 4-4m-4-4v8" />
                            </svg>
                            تحميل صورة
                        </button>

                        <button type="button" class="flex items-center gap-2 btn-red px-4 py-2 " @if($user->img_url === null) disabled  @endif>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            حذف صورة
                        </button>
                    </div>
                    <p class="text-sm text-gray-500">اختر صورة بحجم لا يتجاوز 2MB.</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 my-6"></div>

        <!-- معلومات شخصية -->
        <div>
            <!-- المعلومات الشخصية -->
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.083 0 4.064.48 5.879 1.339M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                المعلومات الشخصية
            </h2>


            <!-- صف 1: الاسم الأول + الاسم الأخير -->
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="first_name">الاسم الأول</label>
                    <input type="text" id="first_name" class="input focus:ring-blue-500" placeholder="إسمك....">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="last_name">الاسم الأخير</label>
                    <input type="text" id="last_name" class="input focus:ring-blue-500" placeholder="إسم العائلة....">
                </div>
            </div>

            <!-- صف 2: رقم الهاتف + الجنس -->
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="phone_number">رقم الهاتف</label>
                    <input type="text" id="phone_number" class="input focus:ring-blue-500" placeholder="09XXXXXXXX">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" class="input focus:ring-blue-500" placeholder="john@gmail.com">
                </div>
            </div>

            <!-- صف 3: العمر + البريد الإلكتروني -->
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="age">العمر</label>
                    <input type="number" id="age" class="input focus:ring-blue-500" placeholder="أدخل عمرك">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="gender">الجنس</label>
                    <select id="gender" class="input focus:ring-blue-500">
                        <option value="">اختر الجنس</option>
                        <option value="male">ذكر</option>
                        <option value="female">أنثى</option>
                    </select>
                </div>
            </div>

            <!-- سطر خاص بالسيرة الذاتية -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="bio">نبذة عنك</label>
                <textarea id="bio" rows="4" class="input focus:ring-blue-500" placeholder="اكتب نبذة قصيرة عن نفسك..."></textarea>
            </div>
        </div>

        <!-- زر الحفظ -->
        <div class="text-left">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 cursor-pointer">
                حفظ التغييرات
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 text-right w-full max-w-3xl mx-4 border border-gray-100 my-2" dir="rtl">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 11c0-1.105.895-2 2-2s2 .895 2 2v1h1a1 1 0 011 1v5a1 1 0 01-1 1H9a1 1 0 01-1-1v-5a1 1 0 011-1h1v-1c0-1.105.895-2 2-2s2 .895 2 2v1z" />
                </svg>
                تغيير كلمة المرور
            </h2>

            <!-- صف 1: كلمة المرور الحالية + الجديدة -->
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="current_password">كلمة المرور الحالية</label>
                    <input type="password" id="current_password" class="input focus:ring-blue-500" placeholder="أدخل كلمتك الحالية">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="new_password">كلمة المرور الجديدة</label>
                    <input type="password" id="new_password" class="input focus:ring-blue-500" placeholder="أدخل كلمة مرور جديدة">
                </div>
            </div>

            <!-- صف 2: تأكيد كلمة المرور -->
            <div class="mb-6 w-full md:w-1/2">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="confirm_password">تأكيد كلمة المرور الجديدة</label>
                <input type="password" id="confirm_password" class="input focus:ring-blue-500" placeholder="أعد كتابة كلمة المرور الجديدة">
            </div>

            <!-- زر حفظ -->
            <div class="text-left">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200 cursor-pointer">
                    حفظ التغييرات
                </button>
            </div>
        </div>
    </div>

</div>
