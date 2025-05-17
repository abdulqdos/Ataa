<div>

    <div class="w-full flex flex-col lg:flex-row gap-4 md:gap-6 my-2">


    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mb-6">
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

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-500 flex items-center">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">ساعات التطوع</h2>
                        <p class="text-2xl font-bold text-yellow-500">215</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/10 text-blue-500 flex items-center">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">طلبات الانضمام</h2>
                        <p class="text-2xl font-bold text-blue-500">{{ $requests_count->count() }}</p>
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
                        @foreach($opportunities as $opportunity)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4"> {{ $opportunity->title }} </td>
                                <td class="py-3 hidden md:table-cell">{{ $opportunity->accepted_count }}/ {{ $opportunity->count }}</td>
                                <td class="py-3 hidden md:table-cell"> {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}</td>
                                <td class="py-3"><div>
                                        <x-layouts.status-opportunity :opportunity="$opportunity" />
                                    </div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Volunteers and Stats in 2 columns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Volunteers -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium">آخر المتطوعين المنضمين</h2>
                </div>
                <div class="p-4">
                    <ul>
                        @foreach($volunteers as $volunteer)
                            <li class="flex items-center py-3 border-b border-gray-100">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=أحمد+محمد&background=106665&color=fff" alt="صورة المتطوع">
                                <div class="mr-3 flex-1">
                                    <p class="text-sm font-medium">{{ $volunteer->first_name . ' ' . $volunteer->last_name }}</p>
                                    <p class="text-xs text-gray-500">{{  $volunteer->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-xs text-white bg-primary rounded-full px-2 py-1">5 ساعات تطوع</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">طلبات الانضمام المعلقة</h2>
                </div>
                <div class="p-4">
                    <ul>
                        @foreach($requests as $request)
                            <li class="flex items-center py-3 border-b border-gray-100">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=عمر+خالد&background=106665&color=fff" alt="صورة المتطوع">
                                <div class="mr-3 flex-1">
                                    <p class="text-sm font-medium">{{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name  }}</p>
                                    <p class="text-xs text-gray-500">
                                        تقدم بطلب {{ $request->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{  route('organization.requests.show' ,  $request->id ) }}" class="px-3 py-1 btn-secondary  text-xs"> عرض </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
