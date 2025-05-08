<div>
    <!-- قسم الهيرو -->
    <!-- قسم الهيرو المعدل -->
    <section class="relative h-[800px]">
        <!-- صورة الخلفية مع تغطية -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/volunteers_landing.jpg') }}"
                 alt="متطوعون"
                 class="w-full h-full object-cover">
            <!-- طبقة تظليل بالألوان المخصصة -->
            <div class="absolute inset-0 bg-primary/80 mix-blend-multiply"></div>
        </div>

        <!-- المحتوى -->
        <div class="container mx-auto relative z-10 h-full flex items-center justify-center text-center px-4">
            <div class="max-w-4xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white leading-tight">
                    <span class="text-secondary">قلوبٌ</span> تَبني .. أيدٍ تُغيّر
                </h1>

                <p class="text-xl md:text-2xl mb-8 text-gray-100 font-medium">
                    مجتمعٌ من المُتَطَوِّعين المُلهمين الذين يَخْطُونَ بِشَغَفٍ نحوَ التَّغييرِ الإيجابي،
                    <br class="hidden md:block">
                    نَحْتَضِنُ الْإِنْسَانَ وَالْأَمَلَ فِي كُلِّ مَشْرُوعٍ تَطَوُّعِيّ
                </p>

                <button class="btn-primary px-10 py-4 rounded-lg
                      font-semibold text-lg transition-all duration-300 transform">
                    عرض أبرز المتطوعون
                </button>
            </div>
        </div>
    </section>

    <!-- Volunteers -->
    <section class="container mx-auto px-6 lg:px-24 py-2">
        <div class="text-center mt-8 mb-4">
            <h2 class="text-3xl font-bold text-primary">قائمة المتطوعين</h2>
            <p class="mt-2 text-gray-600 text-sm">نفتخر بعرض مجموعة من المتطوعين المميزين الذين يساهمون في نشر الخير والعطاء.</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-row items-center justify-between my-3">
                <h3 class=" text-sm font-medium text-gray-700 mb-1"> بحث بالأسم </h3>
                <span class="text-primary hover:underline"> عرض أبرز المتطوعون</span>
            </div>
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Combined Name Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" wire:model.live="searchText" placeholder="ابحث متطوع ..."
                               class="w-full px-4 py-2 input focus:ring-primary/80">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volunteers Grid -->
        @if($volunteers->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-3">
                @foreach($volunteers as $volunteer)
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm text-center">
                        <div class="flex flex-col items-center py-10">
                            <img class="w-24 h-24 mb-3 rounded-full"
                                 src="{{ $volunteer->user->img_url !== null
                                ? $volunteer->user->img_url
                                : 'https://ui-avatars.com/api/?name=' . urlencode($volunteer->first_name . ' ' . $volunteer->last_name) . '&background=random&color=fff' }}"
                                 alt="Volunteer image"/>
                            <h5 class="mb-1 text-xl font-medium text-gray-900">
                                {{ $volunteer->first_name . ' ' . $volunteer->last_name }}
                            </h5>
                            <span class="text-sm text-gray-500">{{ $volunteer->user->user_name }}</span>
                            <div class="flex mt-4">
                                <a href="#" class="inline-flex items-center px-4 py-2  rounded-lg btn-primary">
                                    الملف الشخصي
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        @else
            @if(!empty($searchText))
                <!-- Empty State: Search Result -->
                <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-secondaryLight/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h3 class="mt-3 text-lg font-medium text-gray-800">لا يوجد متطوعون بهذا الاسم</h3>
                    <p class="mt-1 text-sm text-gray-600">لم يتم العثور على متطوعين حسب نتائج البحث. جرّب تعديل الاسم .</p>
                </div>
            @else
                <!-- Empty State: No Volunteers at All -->
                <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h3 class="mt-3 text-lg font-medium text-gray-800">لا يوجد متطوعون مسجلون</h3>
                    <p class="mt-1 text-sm text-gray-600">لم يتم تسجيل أي متطوع حتى الآن. يمكنك دعوة أشخاص للتسجيل عبر الموقع.</p>
                </div>
            @endif
        @endif

        <!-- Pagination -->
        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $volunteers->links('vendor.pagination.custom') }}
        </div>
    </section>
</div>
