@props(['opportunity' => false])
<span class="px-5 py-1 rounded-lg text-sm
      @if($opportunity->start_date <= now() && $opportunity->end_date >= now())
      bg-green-100 text-green-500
      @elseif($opportunity->end_date < now())
      bg-blue-100 text-blue-500
      @elseif($opportunity->start_date > now())
      bg-yellow-100 text-yellow-600
      @endif">
            @if($opportunity->start_date <= now() && $opportunity->end_date >= now())
                نشط
            @elseif($opportunity->start_date > now())
                قريباً
            @elseif($opportunity->end_date < now())
                مكتملة
            @endif
</span>
