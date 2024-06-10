<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pages') }}
            </h2>

            <!-- Add Page -->
            <div>
                <a class="px-4 py-3 bg-blue-500 text-white hover:bg-blue-700 rounded" href="{{ route('admin.pages.add') }}">Add Page</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-flash-messages />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($pages->count() > 0)
                    <div class="py-4 px-4 bg-white shadow-xl sm:rounded-lg md:mb-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left px-4 py-2 text-gray-800">No</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Title</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Created On</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Updated On</th>
                                    <th class="text-left px-4 py-2 text-gray-800">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr class="border-collapse border border-gray-300">
                                    <td class="px-4 py-2 text-gray-800 font-medium">{{ $loop->index + 1 }}</td>
                                    <td class="px-4 py-2 text-gray-800 font-medium">{{ $page->title }}</td>
                                    <td class="px-4 py-2 text-gray-800 font-medium">{{ $page->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-2 text-gray-800 font-medium">{{ $page->updated_at->diffForHumans() }}</td>
                                    <td class="px-4 py-2 text-gray-800 font-medium">
                                        <div class="flex items-center">
                                            <a title="View Page" href="{{ route('page', $page->slug) }}" class="inline-block mr-2 border-2 border-indigo-200 rounded-md p-1 hover:bg-indigo-700 text-indigo-500 hover:text-white hover:border-indigo-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a title="Edit Page" href="{{ route('admin.pages.edit', $page->id) }}" class="inline-block mr-2 border-2 border-blue-200 rounded-md p-1 hover:bg-blue-700 text-blue-500 hover:text-white hover:border-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-current">
                                                    <path d="M 18 2 L 15.585938 4.4140625 L 19.585938 8.4140625 L 22 6 L 18 2 z M 14.076172 5.9238281 L 3 17 L 3 21 L 7 21 L 18.076172 9.9238281 L 14.076172 5.9238281 z"/>
                                                </svg>
                                            </a>
                                            <button title="Delete Page" type="button" onclick="deletePage({{ $page->id }})" class="border-2 border-red-200 rounded-md p-1 text-red-500 hover:bg-red-600 hover:text-white hover:border-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                    No Pages Found.
                </div>
                @endif
            </div>
        </div>
    </div>

    <form id="deleteForm" method="post" action="{{ route('admin.pages.delete') }}">
        @csrf
        <input type="hidden" id="pageId" name="id" value="">
    </form>

@push('scripts')
    <script>
        function deletePage(pageId)
        {
            if (!confirm('Are you sure about deleting this page?')) return;
            document.getElementById('pageId').value = pageId;
            document.getElementById('deleteForm').submit();
        }
    </script>
@endpush

</x-app-layout>
