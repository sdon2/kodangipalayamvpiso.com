@push('styles')
    <style>
        .pagination {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dcdcdc;
            justify-content: space-around;
        }
    </style>
@endpush

@forelse ($events as $event)
    <div class="{{ $size }} py-2 px-0">
        <div class="h3">{{ $event->title }}</div>
        <div class="pb-2">entered on
            {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</div>
        <div class="my-2">{{ $event->content }}</div>
        <div>
            <a href="{{ route('event.view', ['id' => $event->id]) }}" class="btn btn-warning">{{ __('Read More') }}</a>
        </div>
    </div>
@empty
    <div class="{{ $size }} py-2 px-0">
        <div class="alert alert-warning">
            No events found. Please try after sometime.
        </div>
    </div>
@endforelse

@if ($events->hasPages() && $showPagination)
    <div class="{{ $size }} px-0">
        {{ $events->links() }}
    </div>
@endif
