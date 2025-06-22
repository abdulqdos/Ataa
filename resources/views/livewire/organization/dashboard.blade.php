<div>

    <div class="w-full flex flex-col lg:flex-row gap-4 md:gap-6 my-2">


    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-2 mb-6">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary/10 text-primary">
                        <i class="fas fa-hands-helping text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">الفرص التطوعية</h2>
                        <p class="text-2xl font-bold text-primary">{{ $opportunities->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-secondary/10  text-secondary">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">المتطوعون المسجلون</h2>
                        <p class="text-2xl font-bold text-secondary">{{ $volunteers_count->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Opportunities -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium">أحدث الفرص التطوعية</h2>
                <a href="{{ route('organization.opportunity') }}" class="text-primary hover:text-primaryLight text-sm transition duration-300">عرض الكل</a>
            </div>
            <div class="p-4">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-gray-600 text-sm">
                            <th class="pb-3 pr-4">عنوان الفرصة</th>
                            <th class="pb-3 hidden md:table-cell">عدد المتطوعين</th>
                            <th class="pb-3 hidden md:table-cell">تاريخ البدء</th>
                            <th class="pb-3">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($opportunities->take(4) as $opportunity)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4"> {{ $opportunity->title }} </td>
                            <td class="py-3 hidden md:table-cell">{{ $opportunity->accepted_count }}/ {{ $opportunity->count }}</td>
                            <td class="py-3 hidden md:table-cell"> {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}</td>
                            <td class="py-3">
                                <div>
                                    <x-layouts.status-opportunity :opportunity="$opportunity" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
