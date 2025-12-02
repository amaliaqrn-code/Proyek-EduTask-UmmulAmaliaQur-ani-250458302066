<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">

        <a class="navbar-brand nav-brand text-white" href="{{ route('home') }}">
            <h1>EduTask</h1>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{-- LEFT MENU --}}
            @guest
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}#beranda" class="nav-link text-white">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}#fitur" class="nav-link text-white">Fitur</a>
                </li>
            </ul>
            @endguest

            {{-- RIGHT MENU --}}
            <ul class="navbar-nav ms-auto">

                @guest
                <li class="nav-menu">
                    <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                </li>
                @else
                {{-- hanya untuk mahasiswa --}}
                @if(auth()->user()->role === 'mahasiswa')
                <li class="nav-menu">
                    <a href="{{ route('mahasiswa.notifications') }}" class="nav-link position-relative text-white">
                        <i class="bi bi-bell fs-4"></i>
                        @php
                            $unreadNotifications = \App\Models\Notification::where('user_id', auth()->id())
                                                    ->where('is_read', 0)
                                                    ->count();
                        @endphp
                        @if($unreadNotifications > 0)
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ $unreadNotifications }}
                            </span>
                        @endif
                    </a>
                </li>
                @endif

                {{-- Profile Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center"
                       href="{{ route('mahasiswa.dashboard') }}" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown">
                        @php
                            $photo = 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name);
                        @endphp
                        <img src="{{ $photo }}" class="rounded-circle me-2" width="36" height="36">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if(auth()->user()->role === 'mahasiswa')
                        <li>
                            <a class="dropdown-item" href="{{ route('mahasiswa.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('mahasiswa.profile.edit') }}">
                                Lengkapi Profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-light">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
