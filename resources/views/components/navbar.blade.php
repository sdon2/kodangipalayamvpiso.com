<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center mr-0" href="/">
            <x-application-logo class="img-fluid pl-0 mr-2 logo_image" width="100px" />
            <div class="nav_heading">
                <h5 class="mt-lg-2 font-17" style="color:#0e446d;font-weight:bold;">
                    கோடங்கிபாளையம் கிராம பஞ்சாயத்து
                </h5>
                <p style="color:black;" class="font-19 h5 mt-2">
                    <b>Kodangipalayam Village Panchayath</b>
                </p>
            </div>
        </a>
        <div class="d-flex d-lg-inine-block justify-content-center justify-content-lg-end w-100 pt-2">
            <div>
                <select onchange="setLocale(this)" class="ml-auto px-2 py-1 border border-dark">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ta" {{ app()->getLocale() == 'ta' ? 'selected' : '' }}>தமிழ்</option>
                </select>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar-expand-lg navbar_menus navbar-light shift">
    <div class="container">
        <div class="row">
            <div class="d-flex d-lg-none py-2 align-items-center">
                <button class="navbar-toggler ml-5" type="button" data-toggle="collapse"
                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="h3 m-0 ml-2" style="color: #fff">{{ config('app.name') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($menu->count())
                <ul class="mt-2 mt-lg-0 collapse navbar-collapse justify-content-around p-mobile"
                    id="navbarNavDropdown">
                    @foreach ($menu as $entry)
                        <li class="nav-item">
                            <a class="nav-link px-2" href="{{ route('page', ['slug' => $entry->slug]) }}">
                                <span class="menu_name {{ $entry->active ? 'active' : '' }}">
                                    <i class="{{ $entry->menu_icon ?: '' }} mr-1"></i>
                                    {{ __($entry->title) }}
                                </span>
                            </a>
                        </li>
                        @if (!$loop->last)
                            <li><span class="menu_seperator"></span></li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        function setLocale(select) {
            window.location.href = "{{ route('locale') }}?lang=" + select.value;
        }
    </script>
@endpush
