<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Admihn Soal {{ config('app.name') }}</title>
  @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('favicon.ico')}}" alt="Seculify Logo" height="70" width="60">
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
            <i class="fas fa-user mr-2"></i>
            <p class="mb-0">{{Auth::user()->name}}</p>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </a>
          </div>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('favicon.ico')}}" alt="Logo" class="brand-image">
        <span class="brand-text font-weight-light">Seculify</span>
      </a>

      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{route('creator')}}" class="nav-link @yield('berAct')">
                <i class="nav-icon fas fa-home"></i>
                <p>Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('creator.categories')}}" class="nav-link @yield('catAct')">
                <i class="nav-icon fas fa-book"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('creator.tests')}}" class="nav-link @yield('tesAct')">
                <i class="nav-icon fas fa-pen"></i>
                <p>Tes</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      @yield('content')
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a href="{{url('/')}}">Tim Csirt UNY</a></strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>
  @yield('js')
</body>

</html>
