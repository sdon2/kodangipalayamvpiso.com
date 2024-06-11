@if ($texts->count())
    <div class="container-fluid py-2 scroller">
        @foreach ($texts as $text)
            <div class="marquee">{{ $text->scroll_text }}</div>
        @endforeach
    </div>
    <style>
        .scroller {
            background: #FFFF00;
            border-top: 1px solid #222222;
            font-weight: bold;
            border-bottom: 1px solid #222222;
        }
    </style>

    @push('scripts')
        <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.marquee.js') }}"></script>
        <script>
            $('.marquee').marquee({
                count: 50,
                speed: 10
            });
        </script>
    @endpush
@endif
