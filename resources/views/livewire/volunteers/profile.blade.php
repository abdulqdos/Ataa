<div class="container my-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- رأس الملف الشخصي مع زر التعديل -->
        <div class="flex justify-between items-center p-6 bg-secondaryLight/10">
            <h2 class="text-2xl font-bold text-primary">الملف الشخصي للمتطوع</h2>
            @can('view' , $volunteer)
                <a href="{{ route('volunteers.edit' , $volunteer->id) }}" class="px-4 py-2  flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>

                </a>
            @endcan
        </div>

        <!-- محتوى الملف الشخصي -->
        <div class="p-6 flex flex-col md:flex-row gap-6">
            <!-- صورة الملف الشخصي الدائرية -->
            <div class="flex-shrink-0 mx-auto md:mx-0 flex flex-col items-center">
                <img class="h-32 w-32 rounded-full object-cover"
                     src="{{ $volunteer->user->img_url ??  'https://ui-avatars.com/api/?name=' . urlencode($volunteer->first_name . ' ' . $volunteer->last_name) . '&background=random&color=fff' }}"
                     alt="{{ $volunteer->first_name }} صورة الملف الشخصي">

                <!-- تقييم المتطوع -->
                    @if($volunteer->eval_avg != 0)
                        <div class="mt-4 flex items-center justify-center bg-yellow-50 px-3 py-1 rounded-full gap-2">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="font-medium text-gray-700">  5 / {{ $volunteer->eval_avg }} </span>
                        </div>
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
</div>
