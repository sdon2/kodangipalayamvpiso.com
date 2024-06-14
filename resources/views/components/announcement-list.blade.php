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

@forelse ($announcements as $announcement)
    <div class="{{ $size }} py-2 px-0">
        <div class="h3">{{ $announcement->title }}</div>
        <div class="pb-2">entered on
            {{ \Carbon\Carbon::parse($announcement->announcement_date)->toFormattedDateString() }}</div>
        <div class="my-2">{{ $announcement->content }}</div>
        <div>
            <a href="{{ route('announcement.view', ['id' => $announcement->id]) }}" class="btn btn-warning">{{ __('Read More') }}</a>
        </div>
    </div>
@empty
    <div class="{{ $size }} py-2 px-0">
        <div class="alert alert-warning">
            {{ __('No announcements found') }}. {{ __('Please try after sometime') }}.
        </div>
    </div>
@endforelse

@if ($announcements->hasPages() && $showPagination)
    <div class="{{ $size }} px-0">
        {{ $announcements->links() }}
    </div>
@endif
