<x-templates.default>
    <x-slot:title>
        Album: {{ $album->album_name }}
    </x-slot:title>

    @if (session()->has('message'))
        <x-alert-info />
    @endif
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-neutral-200">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-neutral-500 uppercase">Id</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-neutral-500 uppercase">created at
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-neutral-500 uppercase">title
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-neutral-500 uppercase">album
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-neutral-500 uppercase">
                                    Thumbnail
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-neutral-500 uppercase">actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse ($photos as $photo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-neutral-800">
                                        {{ $photo->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-800">
                                        {{ $photo->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-800">
                                        {{ $photo->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-800">
                                        {{ $album->album_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-800">
                                        <img class="rounded-xl w-32" src="{{ asset($photo->path) }}"
                                            alt="{{ $photo->name }}">
                                    </td>
                                    <td>
                                        <a class="px-3 py-1 text-white bg-blue-500 border border-blue-700 rounded-md edit-btn"
                                            href="{{ route('photos.edit', $photo) }}">Edit</a>
                                        <a class="px-3 py-1 text-white bg-red-500 border border-red-700 delete-btn rounded-md"
                                            href="{{ route('photos.destroy', $photo) }}">Delete</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="p-5 text-center text-neutral-600 font-semibold text-sm">
                                        No Photos Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $photos->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>

    @section('footer')
        @parent
        <script>
            $('document').ready(function() {
                $('div.alert-info').fadeOut(5000);
                $('tbody').on('click', 'a.delete-btn', function(evt) {
                    evt.preventDefault();
                    const urlPhoto = $(this).attr('href');
                    const tr = evt.target.parentNode.parentNode;
                    $.ajax(urlPhoto, {
                        method: 'delete',
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
