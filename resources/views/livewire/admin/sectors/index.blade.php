<div class="container my-4">
    {{-- Stop trying to control. --}}
    <x-layouts.header title="القطاعات"
                      :breadcrumbs="[['الرئيسية', route('admin.dashboard')], ['إدارة القطاعات']]">
        <a href="#" wire:navigate class="px-4 py-1 btn-primary">
            + إضافة قطاع جديد
        </a>
    </x-layouts.header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 m-4">
        @foreach($sectors as $sector)
            <div class="bg-white shadow-sm rounded-md  overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="p-5 space-y-4">
                    <div class="flex flex-row justify-between items-start">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $sector->name }}</h2>
                            <div class="flex items-center mt-2 space-x-4 text-sm text-gray-600">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                {{ $sector->organizations->count() }} مؤسسة
                            </span>
                                <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                {{ $sector->opportunities->count() }} فرصة
                            </span>
                            </div>
                        </div>
                        <button wire:click="editSector({{ $sector->id }})" class="text-gray-400 hover:text-primary transition-colors duration-200 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>

                    <div class="pt-4 flex space-x-3">
                        <a href="#"
                           wire:navigate.keep
                           class="flex-1 text-center px-4 py-2 text-sm font-medium rounded-md
                       shadow-sm text-white bg-primary hover:bg-primaryLight transition-all
                       duration-300 cursor-pointer">
                            عرض التفاصيل
                        </a>
                        <button wire:click="editSector({{ $sector->id }})"
                                class="px-4 py-2 text-sm font-medium rounded-md
                            shadow-sm text-primary bg-white border border-primary hover:bg-gray-50
                            transition-all duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            تعديل
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
        {{ $sectors->links('vendor.pagination.custom') }}
    </div>
</div>
