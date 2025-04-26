<div class="flex flex-col justify-center items-center min-h-screen bg-gray-50 my-4">
    <div class="bg-white rounded-lg shadow-md p-8 text-right w-full max-w-3xl mx-4 border border-gray-100" dir="rtl">
        <!-- العنوان -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.083 0 4.064.48 5.879 1.339M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            الملف الشخصي للمؤسسة
        </h1>

        <p class="text-gray-600 mb-8">قم بإدارة معلومات مؤسستك، كلمة المرور، وإعدادات الحساب.</p>

        <form wire:submit.prevent="update">
            <!-- قسم صورة الملف الشخصي -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">شعار المؤسسة</h2>
                <div class="flex items-center space-x-6 space-x-reverse gap-4">
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if($img)
                            <img src="{{ $img->temporaryUrl() }}" class="w-24 h-24 rounded-full" />
                        @elseif($img_url)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($img_url) }}" class="w-24 h-24 rounded-full" />
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
                                تحميل شعار
                                <input type="file" name="img" class="hidden" wire:model.live="img" accept="image/*" />
                            </label>

                            <button type="button" class="flex items-center gap-2 btn-red px-4 py-2" @if(($img === null) && ($img_url === null)) disabled @endif wire:click="removeImage">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                حذف الشعار
                            </button>
                        </div>
                        <p class="text-sm text-gray-500">اختر صورة بحجم لا يتجاوز 2MB (يفضل 200x200 بكسل).</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <!-- معلومات المؤسسة -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    المعلومات الأساسية
                </h2>

                <!-- اسم المؤسسة -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="name">
                            اسم المؤسسة <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" class="input focus:ring-primary @error('name') ring-1 ring-red-500 @enderror"
                               placeholder="الاسم الرسمي للمؤسسة" wire:model="name" required>
                        @error('name')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>
                </div>

                <!-- اسم المستخدم والبريد الإلكتروني -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="username">
                            اسم المستخدم <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="username" class="input focus:ring-primary @error('user_name') ring-1 ring-red-500 @enderror"
                               placeholder="اسم المستخدم للحساب" wire:model="user_name" required>
                        @error('user_name')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                            البريد الإلكتروني <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" class="input focus:ring-primary @error('email') ring-1 ring-red-500 @enderror"
                               placeholder="example@email.com" wire:model="email" required>
                        @error('email')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>
                </div>

                <!-- معلومات الاتصال -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="contact_email">
                            بريد التواصل الرسمي
                        </label>
                        <input type="email" id="contact_email" class="input focus:ring-primary @error('contact_email') ring-1 ring-red-500 @enderror"
                               placeholder="contact@example.com" wire:model="contact_email">
                        @error('contact_email')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="phone_number">
                            رقم الهاتف <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone_number" class="input focus:ring-primary @error('phone_number') ring-1 ring-red-500 @enderror"
                               placeholder="09XXXXXXXX" wire:model="phone_number" required>
                        @error('phone_number')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>
                </div>

                <!-- القطاع والمدينة -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="sector">
                            القطاع <span class="text-red-500">*</span>
                        </label>
                        <select id="sector" class="input focus:ring-primary @error('sector_id') ring-1 ring-red-500 @enderror"
                                wire:model="sector_id" required>
                            <option value="">اختر القطاع</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}" {{ $sector->id == $sector_id ? 'selected' : '' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="city">
                            المدينة <span class="text-red-500">*</span>
                        </label>
                        <select id="city" class="input focus:ring-primary @error('city_id') ring-1 ring-red-500 @enderror"
                                wire:model="city_id" required>
                            <option value="">اختر المدينة</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $city_id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>
                </div>

                <!-- الوصف -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="bio">
                        نبذة عن المؤسسة
                    </label>
                    <textarea id="bio" rows="4" class="input focus:ring-primary @error('bio') ring-1 ring-red-500 @enderror"
                              placeholder="وصف مختصر عن نشاط المؤسسة وأهدافها..." wire:model="bio"></textarea>
                    @error('bio')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>
            </div>

            <!-- زر الحفظ -->
            <div class="text-left mt-6">
                <button type="submit" class="py-2 px-6 btn-primary font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>

    <!-- قسم تغيير كلمة المرور -->
    <div class="bg-white rounded-lg shadow-md p-8 text-right w-full max-w-3xl mx-4 border border-gray-100 my-4" dir="rtl">
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
                <!-- كلمة المرور الحالية -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="current_password">
                        كلمة المرور الحالية <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="current_password" class="input focus:ring-primary @error('old_password') ring-1 ring-red-500 @enderror"
                           placeholder="أدخل كلمة المرور الحالية" wire:model="old_password" required>
                    @error('old_password')
                    <x-layouts.x-error-messge :message="$message" />
                    @enderror
                </div>

                <!-- كلمة المرور الجديدة -->
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="new_password">
                            كلمة المرور الجديدة <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="new_password" class="input focus:ring-primary @error('new_password') ring-1 ring-red-500 @enderror"
                               placeholder="كلمة مرور جديدة (8 أحرف على الأقل)" wire:model="new_password" required>
                        @error('new_password')
                        <x-layouts.x-error-messge :message="$message" />
                        @enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="confirm_password">
                            تأكيد كلمة المرور <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="confirm_password" class="input focus:ring-primary"
                               placeholder="أعد إدخال كلمة المرور الجديدة" wire:model="new_password_confirmation" required>
                    </div>
                </div>

                <!-- نصائح لكلمة المرور -->
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
                    <button type="submit" class="font-semibold py-2 px-6 btn-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        تغيير كلمة المرور
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
