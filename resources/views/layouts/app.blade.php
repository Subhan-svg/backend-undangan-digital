<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    {{-- @if(isset($settings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset($settings['site_favicon']) }}">
    @endif --}}

    {{-- CSS --}}
    @stack('css')
    {{-- Custom CSS --}}
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Top Navbar -->
        @include('layouts.partials.topbar')

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- Javascript --}}
    @stack('js')
    {{-- Custom Script --}}
    @stack('scripts')
</body>
</html> 