<div class="max-w-4xl mx-auto my-10">

    {{-- صندوق التأكيد على إرسال طلب التوثيق --}}
    @if($showDeleteBox)
        <div class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" wire:click="resetDeleteBox"
                            class="absolute top-3 end-2.5 text-gray-400 hover:bg-gray-200 rounded-lg text-sm w-8 h-8">
                        <svg class="w-3 h-3" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 w-12 h-12 text-gray-700" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-700">
                            هل تود فعلاً إرسال طلب توثيق الفرصة التطوعية؟
                        </h3>
                        <button wire:click="resetDeleteBox" class="py-2.5 px-5 text-sm btn-secondary">لا، إلغاء</button>
                        <button wire:click="makeRequest" class="text-sm px-5 py-2.5 btn-primary">نعم، أنا متأكد</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- عرض توثيق النشاط --}}
    @if($opportunity->hours !== null)
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">

            {{-- الهيدر --}}
            <div class="bg-primary/5 p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-certificate text-primary ml-2"></i>
                    وثيقة توثيق النشاط التطوعي
                </h2>
                <p class="text-gray-500 mt-1">{{ $opportunity->participation_date }}</p>
            </div>

            {{-- المحتوى --}}
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- القسم الأيسر --}}
                <div class="space-y-6">
                    {{-- وصف الفرصة --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 flex items-center mb-2">
                            <i class="fas fa-info-circle text-primary ml-2"></i>
                            وصف الفرصة التطوعية
                        </h3>
                        <p class="text-gray-600">{{ $opportunity->description }}</p>
                    </div>

                    {{-- تقرير المتطوع --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 flex items-center mb-2">
                            <i class="fas fa-clipboard-check text-primary ml-2"></i>
                            تقرير المتطوع
                        </h3>
                        <p class="text-gray-600">{{ $opportunity->report }}</p>
                    </div>
                </div>

                {{-- القسم الأيمن --}}
                <div class="space-y-6">

                    {{-- التقييمات --}}
                    <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                        <h3 class="font-medium text-gray-700 flex items-center mb-3">
                            <i class="fas fa-star text-amber-400 ml-2"></i>
                            تقييم الأداء
                        </h3>

                        @foreach ([
                            ['name' => 'الالتزام', 'value' => $opportunity->eval_commitment, 'color' => 'blue'],
                            ['name' => 'العمل الجماعي', 'value' => $opportunity->eval_teamwork, 'color' => 'green'],
                            ['name' => 'المهارات القيادية', 'value' => $opportunity->eval_leadership, 'color' => 'purple'],
                        ] as $eval)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">مستوى {{ $eval['name'] }}</span>
                                    <span class="font-medium">{{ $eval['value'] }}/5</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-{{ $eval['color'] }}-500 h-2.5 rounded-full"
                                         style="width: {{ ($eval['value'] / 5) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- الملخص --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-3 rounded-lg shadow-sm text-center">
                                <p class="text-sm text-gray-500 mb-1">التقييم الكلي</p>
                                <p class="text-2xl font-bold text-primary">{{ number_format($opportunity->eval_total, 1) }} / 5</p>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm text-center">
                                <p class="text-sm text-gray-500 mb-1">عدد الساعات</p>
                                <p class="text-2xl font-bold text-primary">{{ $opportunity->hours }} ساعة</p>
                            </div>
                        </div>

                        {{-- المؤسسة --}}
                        <div class="mt-4 pt-4 border-t border-gray-200 flex items-center">
                            <i class="fas fa-building text-gray-400 ml-2"></i>
                            <span class="text-gray-600">تم التوثيق بواسطة:</span>
                            <span class="font-medium text-primary mr-1">{{ $organization->name }}</span>
                        </div>

                        {{-- الشهادة --}}
                        @if($opportunity->certificate_path)
                            <div class="mt-4">
                                <button wire:click="downloadCertificate"
                                        class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition">
                                    <i class="fas fa-download ml-2"></i>
                                    تحميل الشهادة
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- في حالة وجود طلب مسبق --}}
    @elseif($flag)
        <div class="bg-secondaryLight/20 border border-secondaryLight rounded-xl p-8 text-center max-w-md mx-auto my-10">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-secondary/10 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primaryLight/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <h3 class="mt-3 text-xl font-medium text-gray-800">تم إرسال طلبك بنجاح</h3>
            <p class="mt-2 text-gray-600">جاري مراجعة طلبك من المؤسسة.</p>
        </div>

        {{-- حالة عدم وجود توثيق ولا طلب --}}
    @else
        <div class="bg-secondaryLight/20 border border-secondaryLight rounded-xl p-8 text-center max-w-md mx-auto my-10">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-secondary/10 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primaryLight/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h3 class="mt-3 text-xl font-medium text-gray-800">لم يتم التوثيق بعد</h3>
            <p class="mt-2 text-gray-600">يمكنك إرسال طلب توثيق إلى المؤسسة.</p>
            <button wire:click="toggleShowBox"
                    class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                طلب التوثيق
            </button>
        </div>
    @endif
</div>
