<div class="container my-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Profile Header with Edit Button -->
        <div class="flex justify-between items-center p-6 bg-secondaryLight/10">
            <h2 class="text-2xl font-bold text-primary">الملف الشخصي</h2>
            @can('view' , $volunteer)
                <a href="{{ route('volunteers.edit' , $volunteer->id) }}" class="px-4 py-2 btn-primary">Edit</a>
            @endcan
        </div>

        <!-- Profile Content -->
        <div class="p-6 flex flex-col md:flex-row gap-6">
            <!-- Circular Profile Image -->
            <div class="flex-shrink-0 mx-auto md:mx-0">
                <img class="h-32 w-32 rounded-full object-cover border-4 border-gray-200"
                     src="{{ $volunteer->user->img_url ??  'https://ui-avatars.com/api/?name=' . urlencode($volunteer->first_name . ' ' . $volunteer->last_name) . '&background=random&color=fff' }}"
                     alt="{{ $volunteer->first_name }}'s profile picture">
            </div>

            <!-- Profile Details -->
            <div class="flex-grow space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-700">
                        {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                    </h3>
                    <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ $volunteer->age }} years</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Phone Number</p>
                        <p class="text-gray-800">{{ $volunteer->phone_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Gender</p>
                        <p class="text-gray-800 capitalize">{{ $volunteer->gender }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-500">About</p>
                    <p class="text-gray-800">{{ $volunteer->bio }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
