<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lucky 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #da8e8e;">
    <div class="container">
        <a class="navbar-brand mr-auto" href="#">Lucky 6 App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                @guest('admin')

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_login') }}">Login</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('admin_register') }}">Register</a>--}}
{{--                    </li>--}}

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_logout') }}">Logout</a>
                    </li>
                    @if(Auth::guard('admin')->user()->admin_type == 0)
                        <li>
                            <a class="nav-link" style="float: right" href="{{ route('admin_register') }}">Register Admin</a>
                        </li>
                    @elseif(Auth::guard('admin')->user()->admin_type == 1)
                        <li>
                            <a class="nav-link" style="float: right" href="{{ route('registration') }}">Register User</a>
                        </li>
                    @endif
                    <li>
                        <a class="nav-link" href="{{ url('/admin_dashboard') }}" >Dashboard</a>
                    </li>
                @endguest
            </ul>

        </div>
        @guest
        @else
            @if(Auth::guard('admin')->user()->id != null)
                <span style="float: right">User: {{Auth::guard('admin')->user()->name}}<br>
                ID:{{Auth::guard('admin')->user()->id}}</span>
            @endif
        @endguest
    </div>
</nav>
<div class="container mt-5">

    @yield('content')

</div>

</body>
</html>
