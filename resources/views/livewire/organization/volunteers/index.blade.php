<div>
    <x-layouts.header title="المتطوعون"
                      :breadcrumbs="[
                      ['الرئيسية', route('organization.dashboard')],
                      ['إدارة المتطوعون', route('organization.opportunities-volunteers')],
                      ['المتطوعون']]">
    </x-layouts.header>

    @if($showBox)
        <div class="bg-black/10 fixed inset-0 z-50 flex items-center justify-center">
            <div class="relative w-full max-w-md p-4">
                <div class="relative bg-white rounded-xl shadow-lg">
                    <!-- زر الإغلاق -->
                    <button type="button"
                            wire:click="toggleShowBox"
                            class="absolute top-3 right-3 text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-full w-8 h-8 flex items-center justify-center">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M1 1l12 12M13 1L1 13" />
                        </svg>
                        <span class="sr-only">إغلاق</span>
                    </button>

                    <!-- محتوى المودال -->
                    <form wire:submit.prevent="sendNotification" class="px-6 py-8 text-center">
                        <!-- أيقونة -->
                        <div class="flex justify-center mb-4">
                            <svg class="text-gray-600 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01M21 12A9 9 0 1 1 3 12a9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        <!-- العنوان -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">
                            هل تريد إرسال هذا الإشعار؟
                        </h3>

                        <!-- الحقول -->
                        <div class="space-y-4 mb-6 flex flex-col items-center justify-center">
                            <div class="w-full max-w-sm text-right">
                                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">عنوان الإشعار</label>
                                <input type="text" id="title" wire:model="title"
                                       class="w-full px-4 py-2 input focus:ring focus:ring-primary/80" />
                            </div>

                            @error('title')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror

                            <div class="w-full max-w-sm text-right">
                                <label for="message" class="block mb-1 text-sm font-medium text-gray-700">محتوى الإشعار</label>
                                <input type="text" id="message" wire:model="message"
                                       class="w-full px-4 py-2 input focus:ring focus:ring-primary/80" />
                            </div>

                            @error('message')
                                <x-layouts.x-error-messge :message="$message" />
                            @enderror
                        </div>

                        <!-- أزرار الإجراءات -->
                        <div class="flex gap-4 justify-center space-x-3 rtl:space-x-reverse">
                            <button type="button"
                                    wire:click="toggleShowBox"
                                    class="btn-secondary px-4 py-2 text-sm rounded-md focus:outline-none">
                                إلغاء
                            </button>



                            <button type="submit"
                                    class="btn-yellow px-4 py-2 text-sm rounded-md focus:outline-none">
                                إرسال الإشعار
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    @endif
    @if($status != 'completed')
        <div id="top" class="rounded-md p-5  duration-300" dir="rtl">
            <div class="flex flex-row gap-4">
                <div class="flex flex-col md:flex-row gap-4 items-stretch">
                    <button class="px-4 py-1 btn-yellow text-sm" wire:click="toggleShowBox">إرسال إشعار </button>
                </div>
            </div>
        </div>
    @endif



    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg px-3 py-4 bg-white mx-2 md:mx-5">
        <div class="py-4 bg-white flex flex-col md:flex-row items-start md:items-center justify-start gap-4">
            <!-- Search box -->
            <div class="w-full md:w-auto">
                <label for="table-search" class="sr-only">بحث</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           wire:model.live="searchText"
                           class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full md:w-80 bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           placeholder="ابحث عن  متطوع معين...">
                </div>
            </div>
        </div>

        <div>
            @if($volunteers->count() > 0)
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                           اسم مستخدم
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden sm:table-cell">
                                           اسم المتطوع بالكامل
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            رقم الهاتف
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden md:table-cell">
                                            العمر
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            الجنس
                                        </th>
                                        @if($status == 'completed')
                                            <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                                العملية
                                            </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($volunteers as $volunteer)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                <div class="flex flex-row items-center gap-2 justify-start">
                                                    @if($volunteer->img_url === null)
                                                        <img class="h-6 w-6 rounded-md" src="https://ui-avatars.com/api/?name={{ $volunteer->user->user_name }}&background=random&color=fff" alt="صورة المؤسسة">
                                                    @else
                                                        <img class="h-6 w-6 rounded-md" src="{{ \Illuminate\Support\Facades\Storage::url($volunteer->img_url) }}" alt="صورة المؤسسة">
                                                    @endif
                                                    <a href="{{ route('organization.volunteers.show' , $volunteer->id) }}" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                        {{ $volunteer->user->user_name }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 truncate max-w-[150px] hidden sm:table-cell md:px-6">
                                                {{ $volunteer->first_name . ' ' . $volunteer->last_name }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                {{ $volunteer->phone_number }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell md:px-6">
                                                {{ $volunteer->age }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                {{ $volunteer->gender }}
                                            </td>

                                            @if($status == 'completed')
                                                <td class="px-3 py-4 flex flex-row gap-2 md:gap-4 items-center justify-center md:px-6">

                                                    @if($volunteer->pivot->hours !== null)
                                                        <div class="flex flex-row gap-2 bg-green-50 text-green-500 items-center px-3 py-1 rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span> تم توثيق</span>
                                                        </div>
                                                    @else

                                                    <a href="{{ route('organization.volunteers.documentation.create' , ['opportunity' => $opportunity->id , 'volunteer' => $volunteer->id]) }}" class="group flex flex-col items-center justify-center cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer">توثيق</span>
                                                    </a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if( (!empty($searchText)))
                    <div class="text-center py-10">
                        <div class="bg-primary/10 border-l-4 border-secondaryLight p-4 mb-4">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-bold text-primary">لا توجد نتائج بحث</p>
                                    <p class="text-primary/90">لم يتم العثور على فرص تطابق "{{ $searchText }}"</p>
                                </div>
                            </div>
                            <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                                عرض جميع المتطوعون
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-3 text-lg font-medium text-gray-800">لا يوجد متطوعون مسجلون حاليا</h3>
                        <p class="mt-1 text-sm text-gray-600">لا يوجد متطوعون لي هاذي الفرصة . يمكنك تحقق من طلبات .</p>
                        <div class="mt-4">
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md btn-primary">

                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span class="mr-2"> عرض طلبات </span>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $volunteers->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
        </div>
    </div>
</div>
