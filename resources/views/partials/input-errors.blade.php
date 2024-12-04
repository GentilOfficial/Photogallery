@if (count($errors))
    <div class="w-full mx-auto">
        <div class="bg-red-100 border-l-8 border-red-800 shadow-sm rounded-r-2xl">
            <div class="flex items-center">
                <div class="p-2">
                    <div class="flex items-center">
                        <div class="ml-2">
                        </div>
                        <p class="px-6 py-4 text-lg font-semibold text-red-800">Error!</p>
                    </div>
                    <ul class="px-16 mb-4 text-sm font-bold text-red-500 list-disc text-md">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>



@endif
