<x-guest-layout>

    @section('title', __($page->title))

    <x-slot name="keywords">
        {{ $page->keywords }}
    </x-slot>

    <x-slot name="description">
        {{ $page->description }}
    </x-slot>

    @push('content')
        <div class="container pt-4">
            <div class="h2">{{ __('Contact') }}</div>
        </div>
        <div class="container pt-4">
            {!! $page->content !!}
        </div>
        <div class="container pt-4">
            <div style="width: 100%">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9314.634330626839!2d77.20525870276391!3d11.014501749417512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba9ab2691b34a25%3A0xd4bdfba60d94295a!2sKodangipalayam%20Panchayath%20Office!5e0!3m2!1sen!2sin!4v1718341083696!5m2!1sen!2sin"
                    width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
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
