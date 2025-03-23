<div class="min-h-full my-48">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen ">

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <!-- inputs -->
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg font-bold leading-tight tracking-tight md:text-xl text-primary text-center">
                        مرحبًا بك في عطاء! قم بإنشاء حساب جديد للانضمام إلى مجتمعنا.
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit.prevent="register">
                        <!-- user name -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_userName" wire:model="user_name" id="floating_userName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('user_name') border-red-500 @enderror" placeholder=" " required />
                            <label for="floating_userName" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('user_name') text-red-500 font-semibold @enderror">اسم المستخدم </label>
                            @error('user_name')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <!-- email -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="floating_email" wire:model="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('email') border-red-500 @enderror" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('email') text-red-500 font-semibold @enderror">البريد الالكتروني </label>
                            @error('email')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>


                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" wire:model="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-secondary peer @error('password') border-red-500 @enderror" placeholder=" " required />
                            <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('password') text-red-500 font-semibold @enderror">كلمة المرور</label>
                            @error('password')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" wire:model="password_confirmation" name="repeat_password" wire:model="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-secondary peer @error('password_confirmation') border-red-500 @enderror" placeholder=" " required />
                            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('password_confirmation') text-red-500 font-semibold @enderror">تأكيد كلمة المرور</label>
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
                                    <input id="default-radio-1" type="radio" value="volunteer" wire:model.live="userType" class="w-4 h-4 text-secondary bg-gray-100 border-gray-300 ">
                                    <label for="default-radio-1" class="mr-2 text-sm font-medium text-gray-900">متطوع</label>
                                </div>

                                <!-- مؤسسة -->
                                <div class="flex items-center">
                                    <input id="default-radio-2" type="radio" value="organization" wire:model.live="userType" class="w-4 h-4 text-primary bg-gray-100 border-gray-300">
                                    <label for="default-radio-2" class="mr-2 mb-1 text-sm font-medium text-gray-900">مؤسسة</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            @error('userType')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>
                        @if($userType === 'volunteer')
                            <hr class="bg-gray-100" />
                            <div class="grid md:grid-cols-2 md:gap-6">

                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_first_name" id="floating_first_name" wire:model="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('first_name') border-red-500 @enderror" placeholder=" " required />
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('first_name') text-red-500 font-semibold @enderror">إسم الأول</label>
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_last_name" id="floating_last_name"  wire:model="last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('last_name') border-red-500 @enderror" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6  @error('last_name') text-red-500 font-semibold @enderror">إسم الأخير</label>
                                </div>
                            </div>

                            <div class="flex flex-row gap-6 items-center -mt-5">
                                @error('first_name')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                                @error('last_name')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>


                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div>
                                    <label for="underline_select" class="sr-only">الجنس</label>
                                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary focus:text-secondary peer" wire:model="gender">
                                        <option value="" selected>الجنس</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_phone_number" wire:model="phone_number" id="floating_phone_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('phone_number') border-red-500 @enderror" placeholder=" " required />
                                    <label for="floating_phone_number" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('phone_number') text-red-500 font-semibold @enderror">رقم الهاتف </label>
                                    @error('phone_number')
                                        <x-layouts.x-error-messge :message="$message" />
                                    @enderror
                                </div>

                            </div>

                            <div class="flex flex-row gap-6 items-center -mt-5">
                                @error('gender')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                                @error('education_level')
                                <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="age" wire:model="age" id="age" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('age') border-red-500 @enderror" placeholder=" " required />
                                <label for="age" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('age') text-red-500 font-semibold @enderror">العمر(اختياري) </label>
                            </div>

                            <div class="flex flex-row gap-6 items-center -mt-5">
                                @error('age')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>

                        @elseif($userType === 'organization')
                            <hr class="bg-gray-100" />
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="name" id="name" wire:model="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-secondary peer @error('name') border-red-500 @enderror" placeholder=" " required />
                                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('name') text-red-500 @enderror"> إسم المؤسسة</label>
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="contact_email" id="contact_email" wire:model="contact_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-secondary peer @error('contact_email') border-red-500 @enderror" placeholder=" " required />
                                    <label for="contact_email" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-secondary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('contact_email') text-red-500 @enderror">إيميل المؤسسة للتواصل</label>
                                </div>


                            </div>

                            <div class="flex flex-row gap-6 items-center -mt-5">
                                @error('name')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                                @error('contact_email')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Underline select</label>
                                    <select id="underline_select" wire:model="city" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary focus:text-secondary peer">
                                        <option selected>المدينة</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="sector" class="sr-only">القطاع</label>
                                    <select id="sector" wire:model="sector" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary focus:text-secondary peer">
                                        <option selected>القطاع</option>
                                        @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-row gap-6 items-center -mt-5">
                                @error('city')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                                @error('sector')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="floating_phone_number_organization" wire:model="phone_number_organization" id="floating_phone_number_organization" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-secondary peer @error('phone_number_organization') border-red-500 @enderror" placeholder=" " required />
                                <label for="floating_phone_number_organization" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-secondary  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 @error('phone_number_organization') text-red-500 font-semibold @enderror">رقم هاتف المؤسسة </label>
                                @error('phone_number_organization')
                                    <x-layouts.x-error-messge :message="$message" />
                                @enderror
                            </div>


                        @endif


                        <x-layouts.large-button  >إنشاء حساب</x-layouts.large-button>
                        <p class="text-sm font-light text-gray-900">
                            لديك حساب؟ <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">تسجيل الدخول هنا</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
