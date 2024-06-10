<x-guest-layout>
    @push('content')
        <div class="container mt-4">
            <div class="col-md-12 py-2 px-0">
                <div class="h3 pb-2">{{ $announcement->title }}</div>
                <div class="my-2">{!! $announcement->content !!}</div>
                @if ($announcement->hasMedia('announcement-files'))
                <div>
                    <a class="btn btn-sm btn-success" href="{{ $announcement->getFirstMediaUrl('announcement-files') }}" target="_blank">View Attachment</a>
                </div>
                @endif
            </div>
        </div>
    @endpush
</x-guest-layout>
