<div class="space-y-2">
    <div id="album_thumb-container" class="relative w-full mb-4">
        <label for="album_thumb" class="inline-block text-md font-semibold text-neutral-800 mt-2.5 mb-2">
            Thumbnail
        </label>
        <input type="file" id="album_thumb" name="album_thumb" class="hidden" onchange="handleFileSelect(this)"
            accept=".png,.jpg,.jpeg,.webp" />

        <label for="album_thumb"
            class="flex justify-center p-12 bg-white border border-dashed cursor-pointer border-neutral-300 rounded-xl">
            <div class="text-center">
                <span
                    class="inline-flex items-center justify-center rounded-full text-neutral-800 bg-neutral-100 size-16">
                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" x2="12" y1="3" y2="15"></line>
                    </svg>
                </span>

                <div class="flex flex-wrap justify-center mt-4 text-sm leading-6 text-neutral-600">
                    <span class="font-medium text-neutral-800 pe-1">
                        Drop your file here or
                    </span>
                    <span
                        class="font-semibold text-blue-600 bg-white rounded-lg hover:text-blue-700 decoration-2 hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2">browse</span>
                </div>

                <p class="mt-1 text-xs text-neutral-400">
                    Pick a file up to 2MB.
                </p>
            </div>
        </label>

        <div id="file-preview" class="mt-4 space-y-2 empty:mt-0"></div>
    </div>

    <div class="flex items-center justify-center w-full">
        @if ($album->album_thumb)
            <img class="w-64 rounded-xl" src="{{ asset($album->path) }}" alt="{{ $album->album_name }}">
        @endif
    </div>

    <script>
        function handleFileSelect(input) {
            const previewContainer = document.getElementById('file-preview');
            previewContainer.innerHTML = '';

            if (input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    const fileSize = (file.size / 1024).toFixed(2);
                    const fileName = file.name;
                    const fileExt = fileName.split('.').pop();

                    const previewHTML = `
                        <div class="p-3 bg-white border border-solid border-neutral-300 rounded-xl">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-x-3">
                            <p class="flex items-center justify-center border rounded-lg text-neutral-500 border-neutral-200 size-10">
                                <span>${fileExt.toUpperCase()}</span>
                            </p>
                            <div>
                                <p class="text-sm font-medium text-neutral-800">
                                <span class="truncate inline-block max-w-[300px] align-bottom">${fileName}</span>
                                </p>
                                <p class="text-xs text-neutral-500">${fileSize} KB</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    `;

                    previewContainer.innerHTML = previewHTML;
                });
            }
        }
    </script>
</div>
