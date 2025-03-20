<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-5 text-center">تعديل فرصة تطوعية</h2>

    <form wire:submit.prevent="update" class="space-y-5">
        <!-- العنوان -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
            <div class="relative">
                <input type="text" wire:model="title" class="w-full p-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)] focus:outline-none transition @error('title') border-red-500 @enderror" placeholder="مثال: حملة تنظيف الشواطئ">

            </div>
        </div>

        @error('title')
            <x-layouts.x-error-messge :message="$message" />
        @enderror

        <!-- الوصف -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
            <textarea wire:model="description" rows="3" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)] focus:outline-none transition @error('description') border-red-500 @enderror" placeholder="وصف مختصر للفرصة التطوعية"></textarea>
        </div>

        @error('description')
            <x-layouts.x-error-messge :message="$message" />
        @enderror

        <!-- التواريخ -->
        <div class="grid grid-cols-2 gap-4">
            <!-- تاريخ البداية -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تاريخ البداية</label>
                <input type="date" wire:model="start_date" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)] focus:outline-none transition @error('start_date') border-red-500 @enderror">
            </div>



            <!-- تاريخ النهاية -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تاريخ النهاية</label>
                <input type="date" wire:model="end_date" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)] focus:outline-none transition @error('end_date') border-red-500 @enderror">
            </div>

        </div>

        <div class="flex flex-row justify-start items-center gap-x-8">
            @error('start_date')
                <x-layouts.x-error-messge :message="$message" />
            @enderror

            @error('end_date')
                <x-layouts.x-error-messge :message="$message" />
            @enderror
        </div>

        <!-- رفع الصورة -->
        <div class="mb-4">
            <label class="block text-md font-semibold text-gray-700 mb-2">صورة الفرصة</label>
            <label for="img" class="cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-gray-400 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition duration-300 @error('img') border-red-500 @enderror">
                @if ($img)
                    <img class="w-full h-40 object-cover rounded-lg shadow-md" src="{{ $img->temporaryUrl() }}" />
                    <button type="button" wire:click="removeImage" class="mt-2 text-red-600 text-sm hover:underline">إزالة الصورة</button>
                @elseif($img_url)
                    <img class="w-full h-40 object-cover rounded-lg shadow-md" src="{{ \Illuminate\Support\Facades\Storage::url($img_url) }}" />
                    <button type="button" wire:click="removeImage" class="mt-2 text-red-600 text-sm hover:underline">إزالة الصورة</button>
                @else
                    <span class="text-gray-400 text-sm">اضغط لإضافة صورة</span>
                @endif
                <input type="file" id="img" wire:model="img" class="hidden">
            </label>
        </div>

        @error('img')
            <x-layouts.x-error-messge :message="$message" />
        @enderror

        <div class="flex flex-row justify-between items-center">
            <a href="{{ route('organization.opportunity') }}" class="px-3 py-2 text-white bg-[var(--darkGray)] transition duration-300 hover:bg-[var(--lightGray)] cursor-pointer rounded-md"> رجوع </a>

            <button type="submit" class="bg-[var(--primary)] text-white  text-sm p-3 rounded-md  hover:bg-[var(--primaryLight)] transition duration-300 cursor-pointer focus:outline-none flex items-center justify-center gap-2">
                <div role="status" wire:loading class="mt-1">
                    <svg aria-hidden="true" class="w-3 h-3 text-gray-200 animate-spin fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <div>
                    تعديل الفرصة
                </div>
            </button>
        </div>

    </form>
</div>
