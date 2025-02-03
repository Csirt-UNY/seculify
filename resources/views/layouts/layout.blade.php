<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link href="{{asset('favicon.ico')}}" rel="apple-touch-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
            <a href="{{ url('/') }}" class="logo me-auto"><img
                    src="{{ asset('assets/img/seculify/logo_text_white.png') }}" alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link @yield('homeAct')" href="{{ url('/') }}">Beranda</a></li>
                    @php
                    $lp = \App\Models\Config::where('key', 'link_pengaduan')->first();
                    @endphp
                    @if (isset($lp) && $lp->is_active != 0)
                    <li><a target="_blank" class="nav-link @yield('pengAct')" href="{{ url($lp->value) }}">Pengaduan</a></li>
                    @endif
                    @auth
                    <li><a class="getstarted" href="{{ route('login') }}">Dashboard</a></li>
                    @else
                    @if (Request::route()->getName() === 'login')
                    <li><a class="getstarted" href="{{ route('register') }}">Daftar</a></li>
                    @elseif (Request::route()->getName() === 'register')
                    <li><a class="getstarted" href="{{ route('login') }}">Login</a></li>
                    @else
                    <li><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                    <li><a class="getstarted" href="{{ route('login') }}">Login</a></li>
                    @endif
                    @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer id="footer">
        <div class="container footer-bottom clearfix">
            <div class="copyright">
                © Copyright <strong><span>Team Csirt UNY</span></strong> 2024
            </div>
            <div class="credits">
                {{-- Developed by <a href="http://fian.pw">Dwi Arfian</a> --}}
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
