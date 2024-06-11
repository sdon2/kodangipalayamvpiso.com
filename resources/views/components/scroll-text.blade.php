@if ($texts->count())
    <div class="container-fluid scroller">
        <div class="marquee3k py-2 w-100" data-speed="1" data-reverse="true" data-pausable="false">
            @foreach ($texts as $text)
                <span style="padding-left: 200px;">{{ $text->scroll_text }}</span>
            @endforeach
        </div>
    </div>
    <style>
        .scroller {
            background: #FFFF00;
            border-top: 1px solid #222222;
            font-weight: bold;
            border-bottom: 1px solid #222222;
        }
        .marquee3k > span:first-child {
            display: none;
        }
    </style>

    @push('scripts')
        <script src="{{ asset('assets/js/marquee3k.min.js') }}"></script>
        <script>
            Marquee3k.init();
        </script>
    @endpush
@endif
