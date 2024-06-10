@forelse ($announcements as $announcement)
    <div class="col-md-12 py-2 px-0">
        <div class="h3 pb-2">{{ $announcement->title }}</div>
        <div class="my-2">{{ $announcement->content }}</div>
        <div>
            <a href="{{ route('announcement.view', ['id' => $announcement->id]) }}" class="btn btn-warning">Read More</a>
        </div>
    </div>
@empty
@endforelse
