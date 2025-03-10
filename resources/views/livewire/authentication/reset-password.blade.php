<div class="flex items-center justify-center mx-auto bg-gray-200">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm mx-auto my-4 min-w-96 p-6">
        <h2 class="text-lg font-semibold mb-4 text-[var(--primary)]">إعادة تعيين كلمة المرور</h2>

        @if (session()->has('success'))
            <div class="bg-[var(--secondary)] text-[var(--primary)] border-1 border-[var(--primary)] p-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 p-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="resetPassword">
            <input type="hidden" wire:model="token">

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

            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-sm mb-2 text-gray-800">كلمة المرورالجديدة</label>
                </div>

                <div class="relative">
                    <input type="password" id="password" name="password" wire:model="password"
                           class="py-3 px-4 block w-full bg-gray-50 border-[var(--primary)] rounded-lg text-sm
                                                focus:border-[var(--primary)] focus:ring-[var(--primary)] focus:outline focus:outline-2 focus:outline-[var(--primary)]
                                                disabled:opacity-50 disabled:pointer-events-none placeholder-gray-300"
                           required placeholder="*********">
                </div>
                @error('password')
                    <p class="text-xs text-red-600 mt-2 font-semibold italic" id="password-error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <label for="password_confirmation" class="block text-sm mb-2 text-gray-800">تأكيد كلمة المرور الجديدة</label>
                </div>

                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation"
                           class="py-3 px-4 block w-full bg-gray-50 border-[var(--primary)] rounded-lg text-sm
                                                focus:border-[var(--primary)] focus:ring-[var(--primary)] focus:outline focus:outline-2 focus:outline-[var(--primary)]
                                                disabled:opacity-50 disabled:pointer-events-none placeholder-gray-300"
                           required placeholder="*********">
                </div>
            </div>

            <button type="submit" class="w-full bg-[var(--primary)] text-white py-2 px-4 mt-4 cursor-pointer rounded-md hover:bg-[var(--secondary)] transition">
                إعادة تعيين كلمة المرور
            </button>
        </form>
    </div>
</div>
