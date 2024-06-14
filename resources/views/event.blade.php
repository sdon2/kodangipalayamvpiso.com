<x-guest-layout>

    @push('content')
        <div class="container mt-4">
            <div class="col-md-12 py-2 px-0">
                <div class="h3 pb-2">{{ $event->title }}</div>
                <div class="pb-2">entered on {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</div>
                <div class="my-2">{!! $event->content !!}</div>
                @if ($event->hasMedia('event-images'))
                    <x-event-slider :event="$event" />
                @endif
            </div>
        </div>
    @endpush

</x-guest-layout>
