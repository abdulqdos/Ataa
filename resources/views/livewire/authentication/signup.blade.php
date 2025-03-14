<div class="bg-gray-100 py-36">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen ">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl my-3">
                مرحبًا بك في عطاء! قم بإنشاء حساب جديد للانضمام إلى مجتمعنا.
            </h1>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <!-- inputs -->
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-[var(--primary)]">
                        إنشاء حساب
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#">
                        <!-- user name -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_userName" wire:model="user_name" id="floating_userName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                            <label for="floating_userName" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[var(--secondary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">اسم المستخدم </label>
                            @error('userName')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <!-- email -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="floating_email" wire:model="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[var(--primary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">البريد الالكتروني </label>
                            @error('email')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>


                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                            <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[var(--secondary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">كلمة المرور</label>
                            @error('password')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="repeat_password" wire:model="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[var(--secondary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">تأكيد كلمة المرور</label>
                            @error('password_confirmation')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <!-- user type -->
                        <div class="mb-6">
                            <h4 class="text-gray-800 text-md italic font-semibold mb-4">نوع الحساب :</h4>

                            <div class="flex  items-center space-x-4">
                                <!-- متطوع -->
                                <div class="flex items-center">
                                    <input id="default-radio-1" type="radio" value="volunteer" wire:model.live="userType" class="w-4 h-4 text-[var(--primary)] bg-gray-100 border-gray-300 ">
                                    <label for="default-radio-1" class="mr-2 text-sm font-medium text-gray-900">متطوع</label>
                                </div>

                                <!-- مؤسسة -->
                                <div class="flex items-center">
                                    <input id="default-radio-2" type="radio" value="organization" wire:model.live="userType" class="w-4 h-4 text-[var(--primary)] bg-gray-100 border-gray-300">
                                    <label for="default-radio-2" class="mr-2 mb-1 text-sm font-medium text-gray-900">مؤسسة</label>
                                </div>
                            </div>
                        </div>

                        @if($userType === 'volunteer')
                        <hr class="bg-gray-300" />
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[var(--secondary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">إسم الأول</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-[var(--secondary)] peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[var(--secondary)]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">إسم الأخير</label>
                                </div>
                            </div>

                        @elseif($userType === 'organization')
                        <hr class="bg-gray-300" />
                             <p> اني مؤسسسسة </p>
                        @else
                           <p>حاجة منطقية </p>
                        @endif


                        <x-layouts.large-button  >إنشاء حساب</x-layouts.large-button>
                        <p class="text-sm font-light text-gray-900">
                            لديك حساب؟ <a href="{{ route('login') }}" class="font-medium text-[var(--primary)] hover:underline">تسجيل الدخول هنا</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
