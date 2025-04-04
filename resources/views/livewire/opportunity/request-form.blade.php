<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-mf shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    سبب رغبتك في التطوع:
                </h3>
                <button type="button" class="text-gray-400 bg-transparent  hover:text-red-500 cursor-pointer rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition duration-300" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" wire:click="dispatch('toggle')">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" wire:submit.prevent="sendRequest">

                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-1">
                        <label for="reason" class="block mb-2 text-sm font-medium text-gray-900">سبب رغبتك في التطوع</label>
                        <textarea
                            id="reason"
                            rows="4"
                            wire:model="reason"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-primaryLight focus:border-primaryLight focus:outline-none @error('reason') border-red-500 @enderror " placeholder="أكتب هنا سبب رغبتك في التطوع..."></textarea>
                    </div>
                </div>

                @error('reason')
                    <x-layouts.x-error-messge :message="$message" />
                @enderror

                <div class="flex justify-between mt-6">

                    <button type="submit"
                            wire:target="sendRequest"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="px-4 py-2 btn-primary">
                        <span wire:loading wire:target="sendRequest">جاري الإرسال...</span>
                        <span wire:loading.remove wire:target="sendRequest">إرسال</span>
                    </button>

                    <button wire:click="dispatch('toggle')" type="button" class="px-4 py-2 btn-secondary  text-sm font-semibold  shadow-md cursor-pointer" data-modal-toggle="crud-modal">
                        إلغاء
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
