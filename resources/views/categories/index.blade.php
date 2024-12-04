<x-templates.default>
    <x-slot:title>
        Categories
    </x-slot:title>

    <h1 class="text-3xl font-semibold">Categories</h1>
    @if (session()->has('message'))
        <x-alert-info />
    @endif

    <table class="min-w-full mt-10 divide-y divide-gray-200">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">ID</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Name</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Created
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Updated
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Albums
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($categories as $category)
                <tr id="tr-{{ $category->id }}">
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                        {{ $category->id }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                        {{ $category->category_name }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                        {{ $category->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                        {{ $category->updated_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                        <a class="font-medium text-blue-600 underline hover:text-blue-800"
                            href="{{ route('albums.index') }}?category_id={{ $category->id }}">{{ $category->albums_count }}</a>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                        <div class="flex justify-end gap-1">

                            <a class="flex items-center justify-center px-3 py-1 text-white bg-blue-500 border border-blue-700 rounded-md edit-btn"
                                href="{{ route('categories.edit', $category) }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <form id="form-{{ $category->id }}" method="post"
                                action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button id="{{ $category->id }}"
                                    class="flex items-center justify-center px-3 py-1 text-white bg-red-500 border border-red-700 rounded-md delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-5">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->links('vendor.pagination.tailwind') }}

    @section('footer')
        @parent
        <script>
            $('document').ready(function() {
                $('div.alert-info').fadeOut(5000);
                $('tbody').on('click', 'button.delete-btn', function(evt) {
                    evt.preventDefault();

                    const id = $(this).attr('id');
                    const form = $('#form-' + id);
                    const urlAlbum = form.attr('action');
                    const tr = $('#tr-' + id);

                    $.ajax(urlAlbum, {
                        method: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        complete: function(res, status) {
                            if (status !== 'error' && Number(res.responseText) === 1) {
                                $(tr).remove();
                            } else {
                                console.log(res.responseText);
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
</x-templates.default>
