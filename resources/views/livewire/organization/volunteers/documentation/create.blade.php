<div class="max-w-lg mx-auto bg-white p-6 rounded-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-5 text-center text-primary">توثيق المشاركة التطوعية</h2>

    <form wire:submit.prevent="store" class="space-y-5">
        <!-- وصف النشاط -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">وصف النشاط <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="description"> * </span></label>
            <textarea wire:model="description" rows="3" class="input focus:ring-secondaryLight focus:border-secondaryLight @error('description') border-red-500 @enderror" placeholder="يرجى إدخال وصف مفصل للنشاط التطوعي الذي تم القيام به"></textarea>
            @error('description')
            <x-layouts.x-error-messge :message="$message" />
            @enderror
        </div>

        <!-- عدد الساعات وتاريخ المشاركة -->
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">عدد الساعات <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="hours"> * </span></label>
                <input type="number" wire:model="hours" class="input focus:ring-secondaryLight focus:border-secondaryLight @error('hours') border-red-500 @enderror" placeholder="مثال: 2">
                @error('hours')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تاريخ المشاركة <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="participation_date"> * </span></label>
                <input type="date" wire:model="participation_date" class="input focus:ring-secondaryLight focus:border-secondaryLight @error('participation_date') border-red-500 @enderror">
                @error('participation_date')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>
        </div>

        <!-- تقرير المنظمة -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">تقرير المنظمة <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="organization_report"> * </span></label>
            <textarea wire:model="report" rows="3" class="input focus:ring-secondaryLight focus:border-secondaryLight @error('report') border-red-500 @enderror" placeholder="يرجى تقديم تقرير من المنظمة المشرفة على النشاط، يصف أداء المتطوع"></textarea>
            @error('report')
            <x-layouts.x-error-messge :message="$message" />
            @enderror
        </div>

        <!-- التقييمات -->
        <div class="grid grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تقييم الالتزام <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="commitment_evaluation"> * </span></label>
                <select wire:model="eval_commitment" class="input @error('commitment_evaluation') border-red-500 @enderror">
                    <option value="">اختر تقييم</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('eval_commitment')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تقييم العمل الجماعي <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="teamwork_evaluation"> * </span></label>
                <select wire:model="eval_teamwork" class="input @error('teamwork_evaluation') border-red-500 @enderror">
                    <option value="">اختر تقييم</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('eval_teamwork')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تقييم القيادة <span class="text-xs text-red-500" wire:dirty.class="hidden" wire:target="leadership_evaluation"> * </span></label>
                <select wire:model="eval_leadership" class="input @error('leadership_evaluation') border-red-500 @enderror">
                    <option value="">اختر تقييم</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('eval_leadership')
                <x-layouts.x-error-messge :message="$message" />
                @enderror
            </div>
        </div>

        <div class="flex items-center mb-4 gap-3">
            <label class="label">أضف شهادة الحضور<span class="text-gray-500 tet-sm">(إختياري)</span></label>
            <div>
                <input type="file" id="certificate" class="hidden" wire:model="certificate">
                <label for="certificate" class="cursor-pointer block items-center px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded hover:bg-gray-100 transition">
                    اختر ملف
                </label>
            </div>
            <div>
                @error("certificate") <x-layouts.x-error-messge :message="$message" /> @enderror
            </div>
        </div>

        <!-- زر الإرسال -->
        <div class="flex flex-row justify-between items-center">
            <a href="{{ route('organization.volunteers', $opportunity->id) }}" class="px-6 py-2 btn-secondary">رجوع</a>

            <button type="submit" class="text-sm px-6 py-2 btn-primary focus:outline-none flex items-center justify-center gap-2">
                <div role="status" wire:loading class="mt-1">
                    <svg aria-hidden="true" class="w-3 h-3 text-gray-200 animate-spin fill-white" viewBox="0 0 100 101">
                        <path d="..." fill="currentColor" />
                        <path d="..." fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <div>حفظ</div>
            </button>
        </div>
    </form>
</div>
