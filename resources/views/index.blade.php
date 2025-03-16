<x-layouts.app>
    <x-slot:title> عطاء - للأعمال التطوعية</x-slot:title>

    <div>
        <!-- Hero Section -->
        <div class="relative">
            <div class="hero-gradient absolute inset-0"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">ساهم في تغيير المجتمع</span>
                    <span class="block text-2xl mt-3 font-semibold">منصة عطاء للأعمال التطوعية</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-white sm:max-w-3xl">
                    انضم الآن وابدأ رحلتك التطوعية. تصفح آلاف الفرص التطوعية وساهم في مجتمعك.
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                    <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                        <x-layouts.volunteers.middle-secondary-btn href="#">
                            تصفح الفرص التطوعية
                        </x-layouts.volunteers.middle-secondary-btn>
                        <a href="#" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[var(--secondary)] hover:bg-[var(--secondaryLight)] transition duration-800 cursor-pointer sm:px-8">
                            سجل كمتطوع
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        الفرص التطوعية المميزة
                    </h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                        اكتشف أحدث فرص التطوع المتاحة وساهم في إحداث فرق في مجتمعك
                    </p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Opportunity Card 1 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://source.unsplash.com/random/800x600/?volunteer,charity" alt="صورة للفرصة التطوعية">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-[var(--primary)]">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        متاح
                                    </span>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">توزيع المساعدات الرمضانية</p>
                                    <p class="mt-3 text-base text-gray-500">مساعدة العائلات المتعففة خلال شهر رمضان المبارك من خلال توزيع السلال الغذائية والمساعدات.</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=مؤسسة+الخير&background=106665&color=fff" alt="صورة المؤسسة">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        مؤسسة الخير التطوعية
                                    </p>
                                    <div class="flex space-x-1 space-x-reverse text-sm text-gray-500">
                                        <p>20 متطوع مطلوب</p>
                                        <span aria-hidden="true">&middot;</span>
                                        <p>20-03-2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opportunity Card 2 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://source.unsplash.com/random/800x600/?environment,planting" alt="صورة للفرصة التطوعية">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-[var(--primary)]">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        متاح
                                    </span>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">حملة التشجير المحلية</p>
                                    <p class="mt-3 text-base text-gray-500">المساهمة في زراعة الأشجار في المناطق العامة لتحسين البيئة المحلية وزيادة المساحات الخضراء.</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=جمعية+البيئة&background=2d8c8a&color=fff" alt="صورة المؤسسة">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        جمعية البيئة الخضراء
                                    </p>
                                    <div class="flex space-x-1 space-x-reverse text-sm text-gray-500">
                                        <p>25 متطوع مطلوب</p>
                                        <span aria-hidden="true">&middot;</span>
                                        <p>10-03-2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opportunity Card 3 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://source.unsplash.com/random/800x600/?elderly,care" alt="صورة للفرصة التطوعية">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-[var(--primary)]">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        قريباً
                                    </span>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">دعم المسنين</p>
                                    <p class="mt-3 text-base text-gray-500">تقديم الدعم والمساندة للمسنين من خلال زيارات منزلية وتقديم الرعاية الاجتماعية والنفسية.</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=مركز+الرعاية&background=106665&color=fff" alt="صورة المؤسسة">
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        مركز الرعاية الاجتماعية
                                    </p>
                                    <div class="flex space-x-1 space-x-reverse text-sm text-gray-500">
                                        <p>15 متطوع مطلوب</p>
                                        <span aria-hidden="true">&middot;</span>
                                        <p>05-04-2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <x-layouts.volunteers.middle-primary-btn href="#"> عرض جميع الفرص التطوعية</x-layouts.volunteers.middle-primary-btn>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-gray-50 pt-12 sm:pt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        تأثيرنا بالأرقام
                    </h2>
                    <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                        إحصائيات التطوع على منصة عطاء حتى اليوم
                    </p>
                </div>
            </div>
            <div class="mt-10 pb-12 bg-white sm:pb-16">
                <div class="relative">
                    <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto">
                            <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        متطوع
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-[var(--primary)]">
                                        5,300+
                                    </dd>
                                </div>
                                <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        فرصة تطوعية
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-[var(--primary)]">
                                        1,200+
                                    </dd>
                                </div>
                                <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        ساعة تطوع
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-[var(--primary)]">
                                        42,000+
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Organizations -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        المؤسسات المتميزة
                    </h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                        تعرف على المؤسسات التطوعية البارزة في مجتمعنا
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 md:grid-cols-4">
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-16" src="https://ui-avatars.com/api/?name=مؤسسة+الخير&background=106665&color=fff&size=128&bold=true" alt="مؤسسة الخير">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-16" src="https://ui-avatars.com/api/?name=جمعية+البيئة&background=2d8c8a&color=fff&size=128&bold=true" alt="جمعية البيئة">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-16" src="https://ui-avatars.com/api/?name=مركز+الرعاية&background=106665&color=fff&size=128&bold=true" alt="مركز الرعاية">
                    </div>
                    <div class="col-span-1 flex justify-center items-center">
                        <img class="h-16" src="https://ui-avatars.com/api/?name=مؤسسة+النماء&background=2d8c8a&color=fff&size=128&bold=true" alt="مؤسسة النماء">
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layouts.app>
