<x-guest-layout>

    @push('content')
        <div class="container pt-4">
            <div class="h2">Announcements</div>
        </div>
        <div class="container pt-4">
            {!! $page->content !!}
        </div>
        <div class="container pt-4">
            <x-announcement-list />
        </div>
    @endpush

    @push('styles')
        <style type="text/css">
            .nk-post-text {
                color: #222222;
                font-size: 1.25rem;
            }
        </style>
    @endpush

</x-guest-layout>
