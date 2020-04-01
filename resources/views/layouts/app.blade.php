<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white">
<div id="app">
    <div class="container p-0">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <a class="navbar-brand mr-0" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a class="nav-link" href="/today">{{ __('general.Today') }}</a>
                    <a class="nav-link" href="/new">{{ __('general.New') }}</a>
                </ul>


                <!-- left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ورود</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">ثبت‌نام</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left text-center" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->‌isAdmin())
                                    <a class="dropdown-item bg-danger text-white" href="{{ route('admin.home') }}">
                                        {{ __('general.Admin Page') }}
                                    </a>
                                @endif

                                <a href="{{ route('home') }}" class="dropdown-item">{{__('general.My Posts')}}</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('general.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <main class="py-4 bg-light">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

            @yield('content')
        </main>
        <footer class="bg-light">
            <hr class="bg-dark mt-0"/>
            <div class="row m-0 mt-3">
                <div class="col-12 text-center">
                    <h3>به دانش گرای و بدو شو بلند&nbsp;&nbsp;&nbsp;&nbsp;چو خواهی که از بد نیابی گزند</h3>
                    <h3 class="text-secondary"> - حکیم ابولقاسم فردوسی</h3>
                </div>
            </div>
            <div class="row m-0 mt-2 ">
                <div class="col-12 text-center">
                    <ul>
                        <li>قوانین</li>
                        |
                        <li>سوالات متداول</li>
                        |
                        <li>امنیت</li>
                        |
                        <li>ارتباط‌باما</li>
                    </ul>
                </div>
            </div>

        </footer>

    </div>

</div>
@yield('scripts')
</body>

</html>
