<div class="container my-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- رأس الملف الشخصي مع زر التعديل -->
        <div class="flex justify-between items-center p-6 bg-secondaryLight/10">
            <h2 class="text-2xl font-bold text-primary">الملف الشخصي للمتطوع</h2>
            <a href="{{ url()->previous() }}" class="text-primary">
                ← العودة
            </a>
        </div>

        <!-- محتوى الملف الشخصي -->
        <div class="p-6 flex flex-col md:flex-row gap-6">
            <!-- صورة الملف الشخصي الدائرية -->
            <div class="flex-shrink-0 mx-auto md:mx-0 flex flex-col items-center">
                <img class="h-32 w-32 rounded-full object-cover"
                     src="{{ $volunteer->user->img_url ??  'https://ui-avatars.com/api/?name=' . urlencode($volunteer->first_name . ' ' . $volunteer->last_name) . '&background=random&color=fff' }}"
                     alt="{{ $volunteer->first_name }} صورة الملف الشخصي">

                <!-- تقييم المتطوع -->
                <!-- تقييم المتطوع -->
                @if($volunteer->eval_avg != 0)
                    <div class="my-4 flex flex-col items-center justify-center bg-yellow-50 px-3 py-2 rounded-full gap-1">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="font-medium text-gray-700">{{ $volunteer->eval_avg }} / 5</span>
                        </div>
                    </div>
                    <span class="text-gray-600">متوسط تقييم</span>
                @endif

            </div>

            <!-- تفاصيل الملف الشخصي -->
            <div class="flex-grow space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-user ml-2 text-primary"></i>
                        {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                    </h3>
                    <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full flex items-center">
                        <i class="fas fa-birthday-cake ml-1"></i>
                        {{ $volunteer->age }} سنة
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-phone ml-2"></i>
                            رقم الجوال
                        </p>
                        <p class="text-gray-800 mt-1">{{ $volunteer->phone_number }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-venus-mars ml-2"></i>
                            الجنس
                        </p>
                        <p class="text-gray-800 mt-1 capitalize">
                            @if($volunteer->gender == 'male')
                                ذكر
                            @else
                                أنثى
                            @endif
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-info-circle ml-2"></i>
                        نبذة عن المتطوع
                    </p>
                    <p class="text-gray-800 mt-1">{{ $volunteer->bio  }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- فرص شارك فيها المتطوع -->
    <div class="container my-8">
        <div class="max-w-2xl mx-auto space-y-6">
            <h2 class="text-xl font-bold text-primary mb-4">
                الفرص التي شارك فيها المتطوع
            </h2>

            @forelse($opportunities as $opportunity)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-primaryLight">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $opportunity->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($opportunity->description, 200) }}</p>
                        <div class="flex flex-row justify-between items-center">
                            <x-layouts.status-opportunity :opportunity="$opportunity" />
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-gray-600 text-sm text-center bg-gray-50 p-4 rounded">
                    لم يشارك هذا المتطوع في أي فرصة حتى الآن.
                </div>
            @endforelse
        </div>
    </div>

</div>
