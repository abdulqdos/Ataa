    <div class="bg-gray-50">
        <div class="container mx-auto px-24 py-6 ">
            <!-- هيدر الصفحة -->
            <div class="flex flex-col justify-center items-center gap-4  py-6 px-4 rounded-md shadow-md my-10 bg-white">
                <!-- عنوان الصفحة -->
                <h1 class="text-3xl font-extrabold text-center text-[var(--primary)] mb-4">
                    فرص تطوعية
                </h1>

                <!-- خط تحت العنوان -->
                <span class="w-32 h-1 bg-[var(--primary)] rounded-full"></span>

                <!-- وصف بسيط (اختياري) -->
                <p class="text-sm text-gray-500 mt-2 text-center">
                    اكتشف الفرص التطوعية المتاحة وانضم إلى الحركات الخيرية في مجتمعك.
                </p>
            </div>

            <!-- الفلتر أو البحث -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex flex-1 max-w-md mr-4">
                    <input type="text" placeholder="بحث عن فرصة..." class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="flex space-x-4">
                    <!-- فلترة للحالة -->
                    <select class="p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-orange-500">
                        <option value="">كل الحالات</option>
                        <option value="open">مفتوحة</option>
                        <option value="closed">مغلقة</option>
                    </select>
                </div>
            </div>


            <div class="my-16 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                <button wire:click="previousPage" wire:loading.attr="disabled" class="bg-[var(--primary)] hover:bg-[var(--primaryLight)] text-white px-4 py-2 rounded-lg shadow transition duration-300 cursor-pointer disabled:bg-[var(--primaryLight)] disabled:opacity-75 disabled:cursor-default" @if ($opportunities->onFirstPage()) disabled @endif>
                    << السابق
                </button>
                <div class="text-gray-800 text-xl flex justify-center items-center gap-2 my-4 md:my-0">
                    <span>عرض</span>
                    <span class="font-bold">{{ $opportunities->firstItem() }}</span>
                    <span>إلى</span>
                    <span class="font-bold">{{ $opportunities->lastItem() }}</span>
                    <span>من</span>
                    <span class="font-bold">{{ $opportunities->total() }}</span>
                    <span>النتائج</span>
                </div>
                <button wire:click="nextPage" wire:loading.attr="disabled" class="bg-[var(--primary)] hover:bg-[var(--primaryLight)] text-white px-4 py-2 rounded-lg shadow transition duration-300 cursor-pointer disabled:bg-[var(--primaryLight)] disabled:opacity-75 disabled:cursor-default" @if (!$opportunities->hasMorePages()) disabled @endif>
                    التالي >>
                </button>
            </div>


            <!-- عرض الفرص التطوعية -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="flex items-center justify-center h-48">
                            @if($opportunity->img_url === null)
                                <!-- إذا كانت الصورة غير موجودة نعرض صورة عشوائية بلون عشوائي -->
                                <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff" alt="صورة المؤسسة">
                            @else
                                <img class="h-full w-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="صورة المؤسسة">
                            @endif
                        </div>

                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $opportunity->title }}</h2>

                            <div class="text-sm text-gray-600 mb-1">
                                <span class="font-bold">الحالة:</span>
                                <span class="
                                    @if($opportunity->status === 'active')
                                        text-green-500
                                    @elseif($opportunity->status === 'upcoming')
                                        text-blue-500
                                    @elseif($opportunity->status === 'completed')
                                        text-gray-500
                                    @endif">
                                    @if($opportunity->status === 'active')
                                        نشط
                                    @elseif($opportunity->status === 'upcoming')
                                        قريباً
                                    @elseif($opportunity->status === 'completed')
                                        مكتملة
                                    @endif
                            </span>
                            </div>

                            <div class="text-sm text-gray-600 mb-1">
                                <span class="font-bold">تبدأ:</span> {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d-m-Y') }}
                            </div>

                            <div class="text-sm text-gray-600 mb-1">
                                <span class="font-bold">تنتهي:</span> {{ \Carbon\Carbon::parse($opportunity->end_date)->format('d-m-Y') }}
                            </div>

                            <div class="text-sm text-gray-600 mb-1">
                                <span class="font-bold">المكان:</span>
                                <a href="{{ $opportunity->location_url }}" class="text-blue-500" target="_blank">{{ $opportunity->location }}</a>
                            </div>

                            <div class="text-sm text-gray-600 mb-1">
                                <span class="font-bold">المتطوعين المطلوبين:</span> {{ $opportunity->count }}
                            </div>

                            <button class="px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[var(--primary)] hover:bg-[var(--primaryLight)] transition duration-300 w-full cursor-pointer mt-4">
                                عرض التفاصيل
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


    </div>
