<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center mr-0" href="/">
            <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid pl-0 mr-2 logo_image"
                alt="Rural Development &amp; Panchayat Raj , Tamil Nadu"
                title="Rural Development &amp; Panchayat Raj, Tamil Nadu" style="">
            <div class="nav_heading">
                <h5 class="mt-lg-2 font-17" style="color:#0e446d;font-weight:bold;">
                    கோடங்கிபாளையம் கிராம பஞ்சாயத்து
                </h5>
                <p style="color:black;" class="font-19 h5 mt-2">
                    <b>Kodangipalayam Village Panchayath</b>
                </p>
            </div>
        </a>
    </div>
</nav>

<nav class="navbar-expand-lg navbar_menus navbar-light shift">
    <div class="container">
        <div class="row">
            <button class="navbar-toggler ml-5" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if ($menu->count())
                <ul class="collapse navbar-collapse justify-content-around p-mobile" id="navbarNavDropdown">
                    @foreach ($menu as $entry)
                        <li class="nav-item">
                            <a class="nav-link px-2" href="{{ route('page', ['slug' => $entry->slug]) }}">
                                <span class="menu_name {{ $entry->active ? 'active' : '' }}">
                                    <i class="{{ $entry->menu_icon ?: '' }} mr-1"></i>
                                    {{ $entry->title }}
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
