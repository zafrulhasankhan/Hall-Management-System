<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hall Management') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" style="font-family:cursive;" href="{{ url('/') }}">
                    Hall Management
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('AddInstuition') }}">{{ __('Add instuition') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('complain_form') }}">{{ __('Complain') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('coupon_form') }}">{{ __("Meal's Coupon") }}</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                        <!-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        // start coupon's date setting
        const timenow = new Date();
        document.getElementById("today_date").innerHTML = timenow.toDateString();

        var today = new Date()
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var show_token_config = document.getElementById("show_token_config");
        
        var set_time = '<?php echo $set_time ?>';
        var dead_time = set_time+":"+00+":"+0;
        // console.log(dead_time);
        if (time >= "17:00:0" && time <= dead_time){
          show_token_config.style.display = "block";
        }
        else{
          show_token_config.style.display = "none";
          var time_over_card = document.getElementById("time_over_card");
          time_over_card.style.display = "block";
        }
            
        // end coupon's date setting
    </script>
</body>

</html>