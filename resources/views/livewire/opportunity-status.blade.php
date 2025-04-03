<div>
    <span class="w-4 px-4 py-1  rounded-md
                @if($opportunity->status == 'active') bg-green-100 text-green-500
                @elseif($opportunity->status == 'completed') bg-blue-100 text-blue-500
                @else bg-yellow-100 text-yellow-600 @endif">

                @if($opportunity->status === 'active')
            نشط
        @elseif($opportunity->status === 'upcoming')
            قريباً
        @elseif($opportunity->status === 'completed')
            مكتملة
        @endif
    </span>
</div>
