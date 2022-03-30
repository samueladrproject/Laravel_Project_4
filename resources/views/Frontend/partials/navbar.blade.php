<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ URL::to('/') }}">SP Dempster Shafer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $navLink == 'home' ? 'active' : '' }}" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $navLink == 'diagnosa' ? 'active' : '' }}"
                        href="{{ URL::to('diagnosa') }}">Diagnosa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $navLink == 'pedoman' ? 'active' : '' }}"
                        href="{{ URL::to('pedoman') }}">Pedoman</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
