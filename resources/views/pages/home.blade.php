<x-guest-layout>

    <x-slot name="keywords"></x-slot>
    <x-slot name="description"></x-slot>

    <!-- START: Header Title -->
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            {{-- <div style="background-image: url('{{ asset($page->featured_image) }}');"></div> --}}
            <div class="bg-image-overlay" style="background-color: rgba(20, 20, 20, 0.6);"></div>
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title text-white">{{ $page->title }}</h1>
                    <div class="nk-gap"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Header Title -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nk-gap-4"></div>
                <!-- START: Post -->
                <div class="nk-blog-post nk-blog-post-single">
                    <h1>{{ $page->title }}</h1>
                    <div class="nk-post-meta"> {{ $page->created_at->format('F d, Y') }}</div>
                    <!-- START: Post Text -->
                    <div class="nk-post-text">
                        {!! $page->content !!}
                    </div>
                    <!-- END: Post Text -->
                </div>
                <!-- END: Post -->
                <div class="nk-gap-3"></div>
            </div>
        </div>
    </div>

    @push('content')
        <x-main-slider />

        <div class="container pt-4">
            {!! $page->content !!}
        </div>

        <div class="container pt-4 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="h3 px-2 py-2" style="background: #ccc">Recent Announcements</div>
                    <x-announcement-list size="w-100" items-per-page="3" show-pagination="0" />
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="h3 px-2 py-2" style="background: #ccc">Recent Events</div>
                    <x-event-list size="w-100" items-per-page="3" show-pagination="0" />
                </div>
            </div>
        </div>
    @endpush

</x-guest-layout>
