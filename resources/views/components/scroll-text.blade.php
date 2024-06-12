@if ($texts->count())
    <div class="container-fluid scroller" style="display: none">
        <div class="marquee py-2 w-100">
            @foreach ($texts as $text)
                <div><span>{{ $text->scroll_text }}</span></div>
            @endforeach
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/ticker.min.js') }}"></script>
    <script>
        $(function() {
            $('.scroller').css('display', 'block')
                .css('font-weight', 'bold');
            $('.marquee').ticker();
        });
    </script>
@endpush
