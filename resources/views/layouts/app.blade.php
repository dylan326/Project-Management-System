<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   
<script src="https://use.fontawesome.com/f7f8a64fba.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Pmanager') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ route('companies.index') }}"><i class="fa fa-building"></i>  My Companies</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i>  Projects</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fa fa-tasks"></i>  Tasks</a>
                                </li>
                        @if(Auth::user()->role_id == 2)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i>  Admin <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" rold="menu">
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i>All Projects</a>
                                </li>  
                                 <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i>All Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i>All Tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i>All Companies</a>
                                </li>

                            </ul>
                            </li>

                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        <div class="container">

        @include('partials.errors')
        @include('partials.success')

         <div class="row">
            @yield('content')
         </div>
        </div>
        </main>
    </div>
</body>
</html>
