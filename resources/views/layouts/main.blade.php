<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Message App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/layouts/main.css') }}">
    @yield('head')
</head>

<body>
    <header class="container-fluid header--bg">
        <nav class="row d-flex  justify-content-between align-items-center">
            <a class="col-2" href="{{route('root')}}">
                <img class="nav-icon-size" src="{{ asset('assets/images/site_logo.svg') }}" alt="">
            </a>
            <img class="col-2 d-md-none nav-icon-size" src="{{ asset('assets/images/menu_btn.svg') }}" alt="">
            <ul class="col-md-5 col-xl-4 d-none m-0 d-md-flex justify-content-around align-items-center ">
                @if (!Auth::check())
                    <a href="{{route('auth.register')}}" class=" btn p-2 bg-primary text-light  ">Register</a>
                    <a href="{{route('auth.login')}}" class=" btn p-2 bg-primary text-light  ">Login</a>
                @else
                    @if (Auth::user() && Auth::user()->is_admin)
                        <a href="{{route('admin-panel')}}" class=" btn p-2 bg-primary text-light ">Admin Panel</a>
                    @endif
                    <a href="{{route('user.profile')}}" class=" btn p-2 bg-primary text-light  ">Profile</a>
                    <a href="{{route('auth.logout')}}" class=" btn p-2 bg-primary text-light  ">Logout</a>
                @endif
            </ul>
        </nav>
    </header>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>

</html>
