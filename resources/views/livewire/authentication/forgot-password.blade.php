<div class="flex items-center justify-center mx-auto bg-gray-200 ">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm mx-auto  lg:min-w-96 min-w-[300px] my-[10%]">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-lg lg:text-2xl font-bold text-[var(--primary)]"> نسيت كلمة المرور </h1>
                @if (session()->has('message'))
                    <div class="flex items-center p-4 mb-4 lg:text-sm text-xs text-green-800 border border-green-300 rounded-lg bg-green-50 my-4" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">تم إرسال رابط إعادة تعيين كلمة مرور بنجاح!  </span> {{ session('message') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-200 text-red-700 p-2 mb-4 rounded">

                    </div>
                @endif
            </div>

            <div class="mt-5">
                <form wire:submit.prevent="sendResetLink">
                    <div class="grid gap-y-4">
                        <div>
                            <label for="email" class="block text-sm mb-2 text-gray-800">البريد الإلكتروني</label>
                            <div class="relative">
                                <input type="email" id="email" wire:model="email"
                                       class="py-3 px-4 block w-full bg-gray-50 border-[var(--primary)] rounded-lg text-sm
                                            focus:border-[var(--primary)] focus:ring-[var(--primary)] focus:outline focus:outline-2 focus:outline-[var(--primary)]
                                            disabled:opacity-50 disabled:pointer-events-none placeholder-gray-300"
                                       required aria-describedby="email-error" placeholder="example@email.com">
                            </div>
                            @error('email')
                            <p class="font-semibold italic text-xs text-red-600 mt-2" id="email-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <x-layouts.large-button>إرسال رابط إعادة تعيين كلمة المرور </x-layouts.large-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
