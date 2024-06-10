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
        @if ($page->slug == 'home' && $sliders->count())
            <div class="swiper" id="main-slider">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <img src="{{ $slider }}" alt="slide">
                        </div>
                    @endforeach
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        @endif
        <div class="container pt-4">
            {!! $page->content !!}
        </div>
    @endpush

</x-guest-layout>
