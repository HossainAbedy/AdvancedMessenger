<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SaFaRaChAt') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    .cover {
                background-image: url('{{ asset('uploads/cover/cover.jpg') }}');
                background-repeat: no-repeat;
                background-size: cover;
                height: 1500px;
            }
</style>
<body>
    <div id="app">
     <div class="cover">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'SaFaRaChAt') }}
                </a>
                     
              
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                    <incoming :id="{{Auth::id()}}"></incoming>
    
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <i class="fas fa-comments green float-right" style="font-size:18px;padding-right:18px"></i>
                     </a>
    
                     <a class="navbar-brand" href="{{ url('/profile') }}">
                         <i class="fas fa-user cyan float-right" style="font-size:18px;padding-right:18px"></i>
                     </a>
    
                     <a class="navbar-brand" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off red float-right" style="font-size:18px;padding-right:18px"></i>
                     </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                     </form>
                    
                     <notification :id="{{Auth::id()}}"></notification>
    
                    @endguest
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
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:35px; height:35px; position:absolute; top:0px; left:0px; border-radius:50%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
                                    <a class="dropdown-item" href="{{ url('/profile') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/home') }}"
                                   >
                                        {{ __('ChatBox') }}
                                    </a>
                                    <form id="profile-form" action="{{ url('/profile') }}" method="POST" style="display: none;">
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
    </div>
    {{-- <script src="/js/app.js"></script> --}}
    {{-- <script>        
        @if(Session::has('success'))
            noty({
                type: 'success',
                layout: 'bottomLeft',
                text: '{{ Session::get('success') }}'
            });
        @endif
    </script> --}}
</body>
</html>
