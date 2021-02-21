<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ config('app.name', 'Blog') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Ionicons CDN -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>
<body class="hold-transition sidebar-mini" >

    <div class="wrapper">

        <!-----------------------------------------AdminLTE-------------------------------------------------->
        <section id="adminLTE">

            <!-----------------------------------------Nav--------------------------------------------------->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Right Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-circle mt-2"></i>
                            @if(Auth::user() != null)
                                <span>&nbsp;{{Auth::user()->name}}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="/home" class="dropdown-item">
                                <i class="fas fa-home fa-fw" aria-hidden="true"></i>Home</a>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-----------------------------------------./Nav--------------------------------------------------->

            <!-----------------------------------------Sidebar--------------------------------------------------->
            @include('inc.sidebar')
            <!-----------------------------------------./Sidebar--------------------------------------------------->

            <!-----------------------------------------ContentWrapper--------------------------------------------------->
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="content">
                        <div class="container-fluid">
                            <main class="py-4">
                                <!-- Render route component -->
                                <router-view></router-view>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
            <!-----------------------------------------./ContentWrapper--------------------------------------------------->

        </section>
        <!-----------------------------------------./AdminLTE--------------------------------------------------->

        <!-----------------------------------------Footer--------------------------------------------------->
        <footer class="main-footer">
            <strong class="pull-center">&copy;&nbsp;{{date('Y')}}&nbsp;{{config('app.name', 'Blog')}}.</strong>
        </footer>
        <!-----------------------------------------./Footer--------------------------------------------------->

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
