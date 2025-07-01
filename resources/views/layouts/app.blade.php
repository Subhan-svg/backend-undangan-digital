<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] }}</title>
    
    @if(isset($settings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset($settings['site_favicon']) }}">
    @endif

    {{-- CSS --}}
    @stack('css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @if(!Request::is('login') && !Request::is('register') && !Request::is('/'))
            @include('layouts.partials.sidebar')
        @endif

        <!-- Top Navbar -->
        @if(!Request::is('login') && !Request::is('register') && !Request::is('/'))
            @include('layouts.partials.topbar')
        @endif

        <!-- Main Content -->
        <main class="{{ Request::is('login') || Request::is('register') || Request::is('/') ? 'main-content-login' : 'main-content' }}">
            @yield('content')
        </main>
    </div>

    {{-- Javascript --}}
    @stack('js')
</body>
</html> 