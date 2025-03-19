<div>

    <div class="max-w-full mx-10 px-4 py-2 mb-4 bg-white shadow-md rounded-md">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-xl px-1 py-2 text-[var(--primary)]"> فرص التطوعية </h1>
            <a href="{{ route('organization.opportunity.create') }}" wire:navigate class="bg-[var(--primary)] px-4 py-1 cursor-pointer hover:bg-[var(--primaryLight)] transition duration-300 text-white rounded-md">
                + إضافة فرصة جديدة
            </a>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-3 py-1 bg-white mx-10">
        <div class="py-4 bg-white">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search" class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-1 focus:outline-none focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)]" placeholder="Search for items">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-900 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>

                <th scope="col" class="px-6 py-3">
                    عنوان االفرصة
                </th>
                <th scope="col" class="px-6 py-3">
                    وصف الفرصة
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ البداية
                </th>
                <th scope="col" class="px-6 py-3">
                    تاريخ النهاية
                </th>
                <th scope="col" class="px-6 py-3">
                    الحالة
                </th>
                <th scope="col" class="px-6 py-3">
                    العملية
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($opportunities as $opportunity)
                    <tr class="bg-white  hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $opportunity->title }}
                        </th>
                        <td class="px-6 py-4 truncate ... max-w-[150px]">
                            {{ $opportunity->description }}
                        </td>
                        <td class="px-6 py-4">
                           {{ $opportunity->start_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $opportunity->end_date }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold
                                @if($opportunity->status == 'ongoing')
                                    text-blue-600 border border-blue-600 bg-white
                                @elseif($opportunity->status == 'completed')
                                    text-green-600 border border-green-600 bg-white
                                @elseif($opportunity->status == 'available')
                                    text-yellow-600 border border-yellow-600 bg-white
                                @endif
                                px-2 py-1 rounded-md">
                                @if($opportunity->status == 'ongoing')
                                    مستمرة
                                @elseif($opportunity->status == 'completed')
                                    مكتملة
                                @elseif($opportunity->status == 'available')
                                    متاحة
                                @endif
                            </span>
                        </td>

                        <td class="px-6 py-4 flex flex-row gap-4">
                            <a href="#" class="font-medium bg-blue-600 px-4 py-1 text-white cursor-pointer hover:bg-blue-800 transition duration-300 rounded-md">Edit</a>
                            <a href="#" class="font-medium bg-red-600  px-4 py-1 text-white cursor-pointer hover:bg-red-800 transition duration-300 rounded-md">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
