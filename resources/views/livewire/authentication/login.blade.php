<div class="flex items-center justify-center mx-auto bg-gray-100">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm mx-auto my-4 lg:min-w-96 min-w-[300px]">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block lg:text-2xl font-bold text-primary text-lg">تسجيل الدخول</h1>
                <p class="mt-2 text-sm text-gray-600">
                    ليس لديك حساب؟
                    <a class="text-[var(--secondary)] decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="{{ route('signup') }}">
                        أنشاء الأن
                    </a>
                </p>
            </div>

            <div class="mt-5">
                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6">أو</div>

                <form wire:submit="authenticate">
                    <div class="grid gap-y-4">
                        <div>
                            <label for="email" class="block text-sm mb-2 text-gray-800">البريد الإلكتروني</label>
                            <div class="relative">
                                <input type="email" id="email" wire:model="email"
                                       class="py-3 px-4 block w-full bg-gray-50 border-primary rounded-lg text-sm
                                            focus:border-primary focus:ring-primary focus:outline focus:outline-2 focus:outline-primary
                                            disabled:opacity-50 disabled:pointer-events-none placeholder-gray-300"
                                       required aria-describedby="email-error" placeholder="example@email.com">
                            </div>
                            @error('email')
                            <p class="font-semibold italic text-xs text-red-600 mt-2" id="email-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center">
                                <label for="password" class="block text-sm mb-2 text-gray-800">كلمة المرور</label>
                                <a class="inline-flex items-center gap-x-1 text-sm text-primary decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="{{ route('password.forgot') }}">نسيت كلمة المرور؟</a>
                            </div>

                            <div class="relative">
                                <input type="password" id="password" name="password" wire:model="password"
                                       class="py-3 px-4 block w-full bg-gray-50 border-primary rounded-lg text-sm
                                            focus:border-primary focus:ring-primary focus:outline focus:outline-2 focus:outline-primary
                                            disabled:opacity-50 disabled:pointer-events-none placeholder-gray-300"
                                       required placeholder="*********">
                            </div>
                            @error('password')
                            <p class="text-xs text-red-600 mt-2 font-semibold italic" id="password-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <div class="flex">
                                <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                            </div>
                            <div class="ms-3">
                                <label for="remember-me" class="text-sm text-gray-800">تذكرني</label>
                            </div>
                        </div>

                        <x-layouts.large-button>تسجيل الدخول</x-layouts.large-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
