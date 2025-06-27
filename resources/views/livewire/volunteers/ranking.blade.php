<div class="mx-4 md:mx-8 lg:mx-16 my-4"> <!-- إضافة هوامش متدرجة حسب حجم الشاشة -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-3">
            <i class="fas fa-trophy text-amber-400 mr-2"></i>
            قائمة أبرز المتطوعون
        </h1>
        <p class="text-gray-600 max-w-3xl mx-auto">
            نقدم لكم نخبة من المتطوعين المتميزين الذين ساهموا بشكل فعال في مختلف المبادرات التطوعية
        </p>

        <!-- Stats Bar -->
        <div class="flex flex-wrap justify-center gap-4 mt-6">
            <div class="bg-blue-50 px-6 py-3 rounded-lg flex items-center">
                <i class="fas fa-users text-blue-500 text-xl ml-2"></i>
                <div>
                    <p class="text-sm text-gray-500">إجمالي المتطوعين</p>
                    <p class="font-bold text-blue-800">{{ $totalVolunteers }}+</p>
                </div>
            </div>

            <div class="bg-green-50 px-6 py-3 rounded-lg flex items-center">
                <i class="fas fa-star text-yellow-500 text-xl ml-2"></i>
                <div>
                    <p class="text-sm text-gray-500">أعلى تقييم</p>
                    <p class="font-bold text-green-800"> {{    number_format($volunteers->first()->eval_avg, 1) }} / 5 </p>
                </div>
            </div>

            <div class="bg-purple-50 px-6 py-3 rounded-lg flex items-center">
                <i class="fas fa-hand-holding-heart text-purple-500 text-xl ml-2"></i>
                <div>
                    <p class="text-sm text-gray-500">فرص تطوعية</p>
                    <p class="font-bold text-purple-800">{{ $totalOpportunities }}+</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full space-y-4 container">
        @foreach($volunteers as $volunteer)
            <div class="w-full bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="flex flex-col md:flex-row">
                    <!-- الصورة المربعة -->
                    <div class="md:w-1/6 p-4 flex flex-col items-center justify-center bg-gray-50">
                        @if($volunteer->user->img_url !== null)
                            <img class="h-16 w-16 rounded-lg object-cover border-2 border-gray-200 shadow-sm"
                                 src="{{   \Illuminate\Support\Facades\Storage::url($volunteer->user->img_url)  }}"
                                 alt="صورة المتطوع"/>
                        @else
                            <img class="h-16 w-16 rounded-lg object-cover border-2 border-gray-200 shadow-sm"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($volunteer->user->user_name) }}&background=random&color=fff"
                                 alt="صورة المتطوع"/>
                        @endif

                        <!-- زر عرض الملف الشخصي -->
                        <a href="{{ route('volunteers.profile', $volunteer->id) }}"
                           class="mt-3 px-3 py-1.5 text-sm bg-primary/10 text-primary rounded-lg flex items-center hover:bg-primary/20 transition">
                            <i class="fas fa-eye ml-1 text-xs"></i>
                            <span class="text-xs">عرض الملف</span>
                        </a>
                    </div>

                    <!-- تفاصيل المتطوع -->
                    <div class="md:w-5/6 p-4 flex flex-col md:flex-row justify-between">
                        <!-- المعلومات الأساسية -->
                        <div class="md:w-1/2">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <i class="fas fa-user-circle text-primary ml-2 text-sm"></i>
                                {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                            </h3>
                            <p class="text-gray-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-phone text-gray-400 ml-2 text-xs"></i>
                                {{ $volunteer->phone_number }}
                            </p>
                        </div>

                        <!-- التقييم -->
                        <div class="md:w-1/2 bg-amber-50 p-3 rounded-lg border border-amber-100 mt-2 md:mt-0">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-700 text-sm mb-1 flex items-center">
                                        <i class="fas fa-star text-amber-400 ml-2 text-xs"></i>
                                        تقييم المتطوع
                                    </h4>
                                    <div class="flex items-center">
                                        <!-- النجوم -->
                                        <div class="relative mr-2">
                                            <div class="flex text-gray-300">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fas fa-star text-sm"></i>
                                                @endfor
                                            </div>
                                            <div class="flex absolute top-0" style="width: {{ ($volunteer->eval_avg / 5) * 100 }}%">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fas fa-star text-amber-400 text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- التقييم الرقمي -->
                                        <span class="font-bold text-gray-800 mr-1">
                                            {{ number_format($volunteer->eval_avg, 1) }}
                                        </span>
                                        <span class="text-gray-500 text-sm">/5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
        {{ $volunteers->links('vendor.pagination.custom') }}
    </div>
</div>
