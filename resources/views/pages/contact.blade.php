<x-guest-layout>

    @push('content')
        <div class="container pt-4">
            <div class="h2">Contact</div>
        </div>
        <div class="container pt-4">
            {!! $page->content !!}
        </div>
        <div class="container pt-4">
            <div style="width: 100%">
                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=Kodangipalayam+(Village%20Panchath%20Office)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    <a href="https://www.gps.ie/">gps tracker sport</a></iframe>
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
