<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Scroll Texts') }}
            </h2>

            <!-- Add Page -->
            <div>
                <a class="px-4 py-3 bg-blue-500 text-white hover:bg-blue-700 rounded"
                    href="{{ route('admin.scroll-texts.add') }}">Add Scroll Text</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-flash-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($scroll_texts->count() > 0)
                    <div class="py-4 px-4 bg-white shadow-xl sm:rounded-lg md:mb-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left px-4 py-2 text-gray-800">No</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Text</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Created On</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Updated On</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($scroll_texts as $scroll_text)
                                    <tr class="border-collapse border border-gray-300">
                                        <td class="px-4 py-2 text-gray-800 font-medium">{{ $loop->index + 1 }}</td>
                                        <td class="px-4 py-2 text-gray-800 font-medium">{{ Str::limit($scroll_text->scroll_text, 100) }}</td>
                                        <td class="px-4 py-2 text-gray-800 font-medium">
                                            {{ $scroll_text->created_at->diffForHumans() }}</td>
                                        <td class="px-4 py-2 text-gray-800 font-medium">
                                            {{ $scroll_text->updated_at->diffForHumans() }}</td>
                                        <td class="px-4 py-2 text-gray-800 font-medium">
                                            <div class="flex items-center">
                                                <button title="Delete" type="button"
                                                    onclick="deleteText({{ $scroll_text->id }})"
                                                    class="border-2 border-red-200 rounded-md p-1 text-red-500 hover:bg-red-600 hover:text-white hover:border-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                        class="h-4 w-4 text-current">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        No scroll texts Found.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form id="deleteForm" method="post" action="{{ route('admin.scroll-texts.delete') }}">
        @csrf
        <input type="hidden" id="textId" name="id" value="">
    </form>

    @push('scripts')
        <script>
            function deleteText(textId) {
                if (!confirm('Are you sure about deleting this scroll text?')) return;
                document.getElementById('textId').value = textId;
                document.getElementById('deleteForm').submit();
            }
        </script>
    @endpush

</x-app-layout>
