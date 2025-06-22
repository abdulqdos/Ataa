<div>

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary/10 text-primary">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">إجمالي المتطوعين</h2>
                        <p class="text-2xl font-bold text-primary">{{ $volunteers->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-secondary/10 text-secondary ">
                        <i class="fas fa-building text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">إجمالي المؤسسات</h2>
                        <p class="text-2xl font-bold text-secondary">{{ $organizations->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/10 text-blue-500">
                        <i class="fas fa-hands-helping text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600"> إجمالي فرص التطوع </h2>
                        <p class="text-2xl font-bold text-blue-500">{{ $opportunities->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
