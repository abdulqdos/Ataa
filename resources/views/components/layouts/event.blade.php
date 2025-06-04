<div class="flex items-center space-x-1 space-x-reverse">
    @if($event === 'created')
        <div class="flex items-center ">
            <div class="text-green-500 bg-green-100 p-1 rounded-full">
                <i class="fas fa-plus fa-sm text-green-500"></i>
            </div>
        </div>
    @elseif($event === 'updated')
        <div class="flex items-center text-yellow-500">
            <div class="text-yellow-500 bg-yellow-100 p-1 rounded-full">
                <i class="fas fa-pen-square fa-sm"></i>
            </div>
        </div>
    @elseif($event === 'deleted')
        <div class="flex items-center text-red-500">
            <div class="text-red-500 bg-red-100 p-1 rounded-full">
                <i class="fas fa-trash-alt fa-sm"></i>
            </div>
        </div>
    @endif
</div>
