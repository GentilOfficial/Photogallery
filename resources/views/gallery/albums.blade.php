<x-templates.default>
    <x-slot:title>
        Gallery
    </x-slot:title>
    <div class="grid gap-4 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4">
        @foreach ($albums as $album)
            <div class="w-full h-full mx-auto">
                <div class="grid h-full overflow-hidden transition bg-white border shadow-sm group rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg"
                    href="{{ route('gallery.album.photos', $album) }}">
                    <a href="{{ route('gallery.album.photos', $album) }}"
                        class="relative pt-[50%] sm:pt-[60%] lg:pt-[80%] rounded-t-xl overflow-hidden">
                        <img class="absolute top-0 object-cover object-center transition-transform duration-500 ease-in-out size-full start-0 group-hover:scale-105 group-focus:scale-105 rounded-t-xl"
                            src="{{ asset($album->path) }}" alt="{{ $album->album_name }}">
                    </a>
                    <div class="h-full p-4 md:p-5">
                        <h3 class="text-lg font-bold text-neutral-800">
                            {{ $album->album_name }}
                        </h3>
                        <p class="mt-1 text-neutral-500">
                            {{ $album->description }}
                        </p>
                        <div class="flex items-center gap-1 mt-3">
                            @foreach ($album->categories as $category)
                                @if ($category_id !== $category->id)
                                    <a href="{{ route('gallery.category.albums', $category->id) }}"
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-2xl text-xs font-medium bg-neutral-100 text-neutral-800 hover:bg-indigo-100 hover:text-indigo-800 hover:shadow select-none">
                                        {{ $category->category_name }}
                                    </a>
                                @else
                                    <span
                                        class="line-through inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-2xl text-xs font-medium bg-neutral-50 text-neutral-400 cursor-default select-none">
                                        {{ $category->category_name }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="my-5">
    {{ $albums->links('vendor.pagination.tailwind') }}
</x-templates.default>
