<x-templates.default>

    @if ($category->id)
        <x-slot:title>
            Edit Category: {{ $category->category_name }}
        </x-slot:title>
        <h1 class="text-3xl font-semibold">Edit Category: {{ $category->category_name }}</h1>
        <hr class="my-5">
        @include('partials.input-errors')
        <div class="max-w-4xl px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
            <form method="post" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
                @method('PATCH')
            @else
                <x-slot:title>
                    New Category
                </x-slot:title>
                <h1 class="text-3xl font-semibold">
                    New Category
                </h1>
                <hr class="my-5">
                @include('partials.input-errors')
                <div class="max-w-4xl px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
                    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
    @endif
    @csrf

    <div class="bg-white shadow rounded-xl">
        <div class="p-4 pt-0 sm:pt-0 sm:p-7">
            <div class="pt-4 space-y-4 sm:space-y-6">
                <div class="space-y-2">
                    <label for="category_name" class="inline-block text-md font-semibold text-neutral-800 mt-2.5">
                        Category name
                    </label>

                    <input name="category_name" id="category_name" type="text"
                        class="block w-full px-3 py-2 text-sm rounded-lg shadow-sm border-neutral-200 pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                        placeholder="Enter category name"
                        value="{{ old('category_name') ?? $category->category_name }}">
                </div>
            </div>

            <div class="flex justify-center mt-5 gap-x-2">
                <button type="submit"
                    class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Submit your edits
                </button>
            </div>
        </div>
    </div>
    </form>
    </div>
</x-templates.default>
