<div class="flex flex-col justify-center items-center min-h-screen  my-4">
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
