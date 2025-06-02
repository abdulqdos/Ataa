<div class="max-w-4xl mx-auto my-10">
    @if($showDeleteBox)
        <div class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" wire:click="resetDeleteBox" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-700 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-700">هل تود فعلا إرسال طلب توثيق الفرصة التطوعية ؟</h3>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 text-sm btn-secondary" wire:click="resetDeleteBox">لا , إلغاء </button>
                        <button data-modal-hide="popup-modal" type="button" class="text-sm  px-5 py-2.5  btn-primary" wire:click="makeRequest">
                            نعم , أنا متأكد
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($opportunity->hours !== null)
        <!-- بطاقة توثيق النشاط -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <!-- هيدر البطاقة -->
            <div class="bg-primary/5 p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-certificate text-primary ml-2"></i>
                    وثيقة توثيق النشاط التطوعي
                </h2>
                <p class="text-gray-500 mt-1">{{ $opportunity->participation_date }}</p>
            </div>

            <!-- محتوى البطاقة -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- القسم الأيسر -->
                <div class="space-y-6">
                    <!-- وصف الفرصة -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 flex items-center mb-2">
                            <i class="fas fa-info-circle text-primary ml-2"></i>
                            وصف الفرصة التطوعية
                        </h3>
                        <p class="text-gray-600">{{ $opportunity->description }}</p>
                    </div>

                    <!-- تقرير المتطوع -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 flex items-center mb-2">
                            <i class="fas fa-clipboard-check text-primary ml-2"></i>
                            تقرير المتطوع
                        </h3>
                        <p class="text-gray-600">{{ $opportunity->report }}</p>
                    </div>
                </div>

                <!-- القسم الأيمن -->
                <div class="space-y-6">
                    <!-- التقييمات -->
                    <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                        <h3 class="font-medium text-gray-700 flex items-center mb-3">
                            <i class="fas fa-star text-amber-400 ml-2"></i>
                            تقييم الأداء
                        </h3>

                        <div class="space-y-3">
                            <!-- الالتزام -->
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">مستوى الالتزام</span>
                                    <span class="font-medium">{{ $opportunity->eval_commitment }}/5</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                         style="width: {{ ($opportunity->eval_commitment / 5) * 100 }}%"></div>
                                </div>
                            </div>

                            <!-- العمل الجماعي -->
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">العمل الجماعي</span>
                                    <span class="font-medium">{{ $opportunity->eval_teamwork }}/5</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-500 h-2.5 rounded-full"
                                         style="width: {{ ($opportunity->eval_teamwork / 5) * 100 }}%"></div>
                                </div>
                            </div>

                            <!-- القيادة -->
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">المهارات القيادية</span>
                                    <span class="font-medium">{{ $opportunity->eval_leadership }}/5</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-purple-500 h-2.5 rounded-full"
                                         style="width: {{ ($opportunity->eval_leadership / 5) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الملخص -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4">
                            <!-- التقييم الكلي -->
                            <div class="bg-white p-3 rounded-lg shadow-sm text-center">
                                <p class="text-sm text-gray-500 mb-1">التقييم الكلي</p>
                                <p class="text-2xl font-bold text-primary">{{ number_format($opportunity->eval_total, 1)}} / 5</p>
                            </div>

                            <!-- عدد الساعات -->
                            <div class="bg-white p-3 rounded-lg shadow-sm text-center">
                                <p class="text-sm text-gray-500 mb-1">عدد الساعات</p>
                                <p class="text-2xl font-bold text-primary">{{ $opportunity->hours }} ساعة</p>
                            </div>
                        </div>

                        <!-- المؤسسة -->
                        <div class="mt-4 pt-4 border-t border-gray-200 flex items-center">
                            <i class="fas fa-building text-gray-400 ml-2"></i>
                            <span class="text-gray-600">تم التوثيق بواسطة: </span>
                            <span class="font-medium text-primary mr-1">{{ $organization->name }}</span>
                        </div>

                        <!-- الشهادة -->
                        @if($opportunity->certificate_path != null)
                            <div class="mt-4">
                                <a href="{{ asset($opportunity->certificate_path) }}"
                                   class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition">
                                    <i class="fas fa-download ml-2"></i>
                                    تحميل الشهادة
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif($flag)
            <div class="bg-secondaryLight/20 border border-secondaryLight rounded-xl p-8 text-center flex flex-col gap-4 justify-center items-center max-w-md mx-auto my-10">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-secondary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-primaryLight/80">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h3 class="mt-3 text-xl font-medium text-gray-800">تم إرسال طلبك لي توثيق بنجاح . </h3>
                <p class="mt-2 text-gray-600">تم إرسال طلب توثيقك. سوف تقوم مؤسسة بمراجعة طلبك وتوثيق نشاطك في اقرب فرصة ممكنة.</p>
            </div>
    @else
        <!-- حالة عدم التوثيق -->
        <div class="bg-secondaryLight/20 border border-secondaryLight rounded-xl p-8 text-center flex flex-col gap-4 justify-center items-center max-w-md mx-auto my-10">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-secondary/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primaryLight/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h3 class="mt-3 text-xl font-medium text-gray-800">لم يتم التوثيق بعد</h3>
            <p class="mt-2 text-gray-600">لم يتم توثيق نشاطك حتى الآن. يمكنك طلب التوثيق من المؤسسة.</p>
            <button wire:click="toggleShowBox" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                طلب التوثيق
            </button>
        </div>
    @endif
</div>
