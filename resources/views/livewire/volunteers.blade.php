<div>
    {{-- In work, do what you enjoy. --}}
    @foreach($volunteers as $volunteer)
        <p> {{ $volunteer->first_name }}</p>
    @endforeach
</div>
