@forelse ($announcements as $announcement)
    <div class="col-md-12 py-2 px-0">
        <div class="h3">{{ $announcement->title }}</div>
        <div class="pb-2">entered on {{ \Carbon\Carbon::parse($announcement->announcement_date)->toFormattedDateString() }}</div>
        <div class="my-2">{{ $announcement->content }}</div>
        <div>
            <a href="{{ route('announcement.view', ['id' => $announcement->id]) }}" class="btn btn-warning">Read More</a>
        </div>
    </div>
@empty
    <div class="col-md-12 py-2 px-0">
        <div class="alert alert-warning">
            No announcements found. Please try after sometime.
        </div>
    </div>
@endforelse
