<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <title>Laravel/Vue/Bootstrap</title>
    </head>
    <body>
        <div id="app" class="container-fluid">
            @if (auth()->check())
            <auth-nav></auth-nav>
            @else
            <no-auth-nav></no-auth-nav>
            @endif
            <global-error></global-error>
            @yield('content')
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>