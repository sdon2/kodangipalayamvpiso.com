@if ($featured_image)
    <div class="swiper">
        <img src="{{ $featured_image }}" alt="Featured Image" class="w-100" />
    </div>

    @push('styles')
        <style type="text/css">
            .swiper {
                width: auto;
                height: 60vh;
            }
        </style>
    @endpush
@endif
