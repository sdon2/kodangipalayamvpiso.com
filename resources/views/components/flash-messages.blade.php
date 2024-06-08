@if (\Session::has('success'))
    <div style="background:rgb(16,185,129);color:white;border-radius:0.25rem;width:100%;margin:1rem 0;padding:1rem;">
        {!! \Session::get('success') !!}
    </div>
@endif

@if (\Session::has('error'))
    <div style="background:rgb(239,68,68);color:white;border-radius:0.25rem;width:100%;margin:1rem 0;padding:1rem;">
        {!! \Session::get('error') !!}
    </div>
@endif
