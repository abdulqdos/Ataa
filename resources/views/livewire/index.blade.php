<div>
    <!-- Hero Section -->
    <div class="relative">
        <div class="hero-gradient absolute inset-0" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondaryLight)); opacity: 0.85;"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center text-white">
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                <span class="block">ساهم في تغيير المجتمع</span>
                <span class="block text-2xl mt-3 font-semibold">منصة عطاء للأعمال التطوعية</span>
            </h1>
            <p class="mt-6 max-w-xl mx-auto text-xl">
                انضم الآن وابدأ رحلتك التطوعية. تصفح آلاف الفرص وساهم في مجتمعك.
            </p>

            <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                @guest
                    <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                        <x-layouts.volunteers.middle-secondary-btn href="{{ route('opportunities') }}">
                            تصفح الفرص التطوعية
                        </x-layouts.volunteers.middle-secondary-btn>
                        <a href="/login" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[var(--color-secondary)] hover:bg-[var(--color-secondaryLight)] transition duration-300 sm:px-8">
                            سجل كمتطوع
                        </a>
                    </div>
                @endguest

                @auth
                    <x-layouts.volunteers.middle-secondary-btn href="{{ route('opportunities') }}">
                        تصفح الفرص التطوعية
                    </x-layouts.volunteers.middle-secondary-btn>
                @endauth
            </div>
        </div>
    </div>

    <!-- الفرص التطوعية -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-[var(--color-primary)] sm:text-4xl">الفرص التطوعية الأحدث</h2>
                <p class="mt-3 text-xl text-gray-600">اكتشف أحدث فرص التطوع المتاحة وساهم في إحداث فرق</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($opportunities as $opportunity)
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white">
                        @if($opportunity->img_url !== null)
                            <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $opportunity->img_url) }}" alt="صورة الفرصة">
                        @else
                            <img class="h-48 w-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff" alt="صورة الفرصة">
                        @endif
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                    <x-layouts.status-opportunity :opportunity="$opportunity" />
                                <h3 class="mt-2 text-xl font-semibold text-[var(--color-secondary)]">{{ $opportunity->title }}</h3>
                                <p class="mt-3 text-gray-500 text-sm">{{ \Illuminate\Support\Str::limit($opportunity->description, 100) }}</p>
                            </div>

                            <div class="mt-6 flex items-center">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->organization->name) }}&background=106665&color=fff" alt="صورة المؤسسة">
                                <div class="mr-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $opportunity->organization->name }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $opportunity->count }} متطوع مطلوب &middot; {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d-m-Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <x-layouts.volunteers.middle-primary-btn href="{{ route('opportunities') }}">
                    عرض جميع الفرص التطوعية
                </x-layouts.volunteers.middle-primary-btn>
            </div>
        </div>
    </section>

    <!-- الإحصائيات -->
    <section class="bg-gray-50 pt-12 pb-16">
        <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-800 sm:text-4xl">تأثيرنا بالأرقام</h2>
            <p class="mt-3 text-xl text-gray-500">إحصائيات منصة عطاء حتى اليوم</p>
        </div>

        <div class="mt-10">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden sm:grid sm:grid-cols-3">
                <div class="p-6 text-center border-b sm:border-0 sm:border-l">
                    <dt class="text-lg font-medium text-gray-500">متطوع</dt>
                    <dd class="text-5xl font-extrabold text-[var(--color-primary)] mt-2">{{ number_format($volunteersCount) }}+</dd>
                </div>
                <div class="p-6 text-center border-t border-b sm:border-0 sm:border-l sm:border-r">
                    <dt class="text-lg font-medium text-gray-500">فرصة تطوعية</dt>
                    <dd class="text-5xl font-extrabold text-[var(--color-primary)] mt-2">{{ number_format($opportunitiesCount) }}+</dd>
                </div>
                <div class="p-6 text-center border-t sm:border-0">
                    <dt class="text-lg font-medium text-gray-500">ساعة تطوع</dt>
                    <dd class="text-5xl font-extrabold text-[var(--color-primary)] mt-2">{{ number_format($totalHours) }}+</dd>
                </div>
            </div>
        </div>
    </section>
</div>
