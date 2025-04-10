<div class="lg:hidden">
    @if($show)
        <div class="pt-2 pb-3 space-y-1 bg-gray-50">
            <x-layouts.volunteers.nav-mobile href="/" :active="url()->current() === route('home')" wire:navigate> الرئيسية </x-layouts.volunteers.nav-mobile>
            <x-layouts.volunteers.nav-mobile href="{{ route('opportunities') }}" :active="url()->current() === route('opportunities')" wire:navigate> فرص التطوع </x-layouts.volunteers.nav-mobile>
            <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate>المؤسسات </x-layouts.volunteers.nav-mobile>
            <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate>المتطوعون </x-layouts.volunteers.nav-mobile>
            <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate>عن عطاء </x-layouts.volunteers.nav-mobile>
            <x-layouts.volunteers.nav-mobile href="#" :active="false" wire:navigate>تواصل معنا </x-layouts.volunteers.nav-mobile>
        </div>

        @guest
            <div id="mobileGuestView" class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
                <div class="mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block pr-3 pl-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">تسجيل الدخول</a>
                    <a href="{{ route('signup') }}" class="block pr-3 pl-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">إنشاء حساب</a>
                </div>
            </div>
        @endguest
    @endif
</div>
