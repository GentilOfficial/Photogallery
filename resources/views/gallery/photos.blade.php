<x-templates.default>
    <x-slot:title>
        Album: {{ $album->album_name }}
    </x-slot:title>
    <x-slot:head>
        <link href="/lightbox/css/lightbox.css" rel="stylesheet" />
    </x-slot:head>

    <div class="grid gap-4 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4">
        @foreach ($photos as $photo)
            <div class="mx-auto">
                <a class="flex flex-col h-full overflow-hidden transition bg-white border shadow-sm group rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg"
                    href="{{ asset($photo->path) }}" data-lightbox="{{ $album->album_name }}"
                    data-title="{{ $photo->name }}">
                    <div class="relative pt-[50%] sm:pt-[60%] lg:pt-[80%] rounded-t-xl overflow-hidden">
                        <img class="absolute top-0 object-cover transition-transform duration-500 ease-in-out size-full start-0 group-hover:scale-105 group-focus:scale-105 rounded-t-xl"
                            src="{{ asset($photo->path) }}" alt="{{ $photo->name }}">
                    </div>
                    <div class="p-4 md:p-5">
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $photo->name }}
                        </h3>
                        <p class="mt-1 text-gray-500">
                            {{ $photo->description }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <hr class="my-5">
    {{ $photos->links('vendor.pagination.tailwind') }}

    @section('footer')
        @parent
        <script src="/lightbox/js/lightbox.js"></script>
    @endsection
</x-templates.default>
