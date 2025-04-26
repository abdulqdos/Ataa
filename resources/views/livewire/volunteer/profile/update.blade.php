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

        <form wire:submit.prevent="update">
            <!-- قسم صورة الملف الشخصي -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">صورة الملف الشخصي</h2>
                <div class="flex items-center space-x-6 space-x-reverse gap-4">
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if($img)
                            <img src=" {{ $img->temporaryUrl() }}" class="w-24 h-24 rounded-full" />
                        @elseif($img_url)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($img_url ) }}" class="w-24 h-24 rounded-full" />
                        @else
                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-3">
                            <label class="flex items-center gap-2 btn-blue px-4 py-2 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v16h16V4H4zm4 8l4 4 4-4m-4-4v8" />
                                </svg>
                                تحميل صورة
                                <input type="file" name="img" class="hidden" wire:model.live="img" />
                            </label>

                            <button type="button" class="flex items-center gap-2 btn-red px-4 py-2 " @if(($img === null) && ($img_url === null) )  disabled  @endif wire:click="removeImage">
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


                <!-- صف 1: الاسم الأول + الاسم الأخير + اسم المستخدم -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="username">
                            اسم المستخدم
                        </label>
                        <input type="text" id="username" class="input focus:ring-primary @error('user_name') ring-1 ring-red-500 @enderror" placeholder="mohammed68" wire:model="user_name">
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="first_name">الاسم الأول</label>
                        <input type="text" id="first_name" class="input focus:ring-primary @error('first_name') ring-1 ring-red-500 @enderror" placeholder="إسمك...." wire:model="first_name">
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="last_name">الاسم الأخير</label>
                        <input type="text" id="last_name" class="input focus:ring-primary @error('last_name') ring-1 ring-red-500 @enderror" placeholder="إسم العائلة...." wire:model="last_name">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    @error('user_name')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror

                    @error('first_name')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror

                    @error('last_name')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="phone_number">رقم الهاتف</label>
                        <input type="text" id="phone_number" class="input focus:ring-primary @error('phone_number') ring-1 ring-red-500 @enderror" placeholder="09XXXXXXXX" wire:model="phone_number">
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" class="input focus:ring-primary @error('email') ring-1 ring-red-500 @enderror" placeholder="john@gmail.com" wire:model="email">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    @error('phone_number')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror

                    @error('email')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="age">العمر</label>
                        <input type="number" id="age" class="input focus:ring-primary @error('age') border-red-500 @enderror" placeholder="أدخل عمرك" wire:model="age">
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="gender">الجنس</label>
                        <select id="gender" class="input focus:ring-primary @error('gender') border-red-500 @enderror" wire:model="gender">
                            <option value="">اختر الجنس</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    @error('age')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror

                    @error('gender')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>

                <!-- سطر خاص بالسيرة الذاتية -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="bio">نبذة عنك</label>
                    <textarea id="bio" rows="4" class="input focus:ring-primary @error('bio') ring-1 ring-red-500 @enderror" placeholder="اكتب نبذة قصيرة عن نفسك..." wire:model="bio"></textarea>
                </div>

                @error('bio')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>

            <!-- زر الحفظ -->
            <div class="text-left">
                <button type="submit" class="py-2 px-6 btn-primary font-semibold">
                    حفظ التغييرات
                </button>
            </div>
        </form>
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

            <form wire:submit.prevent="changePassword">
                <!-- صف 1: كلمة المرور الحالية + الجديدة -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="current_password">كلمة المرور الحالية</label>
                        <input type="password" id="current_password" class="input focus:ring-primary @error('old_password') ring-1 ring-red-500 @enderror" placeholder="أدخل كلمتك الحالية" wire:model="old_password">
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="new_password">كلمة المرور الجديدة</label>
                        <input type="password" id="new_password" class="input focus:ring-primary @error('new_password') ring-1 ring-red-500 @enderror" placeholder="أدخل كلمة مرور جديدة" wire:model="new_password">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6">

                    @error('old_password')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror

                    @error('new_password')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>

                <!-- صف 2: تأكيد كلمة المرور -->
                <div class="mb-6 w-full md:w-1/2">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="confirm_password">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" id="confirm_password" class="input focus:ring-primary" placeholder="أعد كتابة كلمة المرور الجديدة" wire:model="new_password_confirmation">
                </div>

                <div class="bg-secondary/10 p-4 rounded-lg mb-6">
                    <h3 class="text-sm font-medium text-primary mb-2">نصائح لأمان أفضل:</h3>
                    <ul class="text-xs text-primary/90 list-disc pr-4 space-y-1">
                        <li>استخدم 8 أحرف على الأقل</li>
                        <li>اجمع بين الأحرف والأرقام والرموز</li>
                        <li>تجنب استخدام كلمات مرور سهلة التخمين</li>
                    </ul>
                </div>

                <!-- زر حفظ -->
                <div class="text-left">
                    <button type="submit" class="font-semibold py-2 px-6 btn-primary">
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
