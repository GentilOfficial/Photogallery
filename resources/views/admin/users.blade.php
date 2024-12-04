<x-templates.admin>
    <x-slot:title>
        Users
    </x-slot:title>
    <div class="border bg-neutral-50 rounded-xl">
        <div class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center">
            <h1 class="text-xl font-semibold text-neutral-800">Users</h1>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden rounded-lg rounded-t-none">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Created
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Role
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Deleted
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                            {{ $user->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                            {{ $user->user_role }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                            @if ($user->deleted_at)
                                                {{ $user->deleted_at->diffForHumans() }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td
                                            class="flex items-center justify-end gap-1.5 px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <button
                                                class="flex items-center justify-center p-1 bg-blue-500 border border-blue-900 rounded-lg w-fit h-fit text-neutral-100 size-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path
                                                        d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                    <path
                                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                </svg>
                                            </button>
                                            <button
                                                class="flex items-center justify-center p-1 bg-red-500 border border-red-900 rounded-lg w-fit h-fit text-neutral-100 size-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path fill-rule="evenodd"
                                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($users->hasPages())
                <div class="w-full p-2 border-t">
                    {{ $users->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </div>
</x-templates.admin>
