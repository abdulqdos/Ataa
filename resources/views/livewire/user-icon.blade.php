<div
    x-data
    @click.outside="$wire.resetUserIcon()"
>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div id="authView" class="sm:flex sm:items-center sm:mr-3">
        <div class="mr-3 relative" >
            <div>
                <button type="button" wire:click="toggleShow"  class="flex rounded-full focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-primary" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">افتح قائمة المستخدم</span>
                    @if(auth()->user()->img_url !== null)
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->img_url) }}" alt="صورة المؤسسة">
                    @else
                        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{auth()->user()->volunteer?->first_name}}&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                    @endif
                </button>
            </div>


                <div id="userMenu" class="{{ $show ? '' : 'hidden' }} origin-top-left absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton" tabindex="-1">
                    <a href="{{ route('volunteer.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">الملف الشخصي</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">فرصي التطوعية</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">الإعدادات</a>
                    <div class="border-t border-gray-100"></div>
                    <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">تسجيل الخروج</a>
                </div>
        </div>

    </div>
</div>
