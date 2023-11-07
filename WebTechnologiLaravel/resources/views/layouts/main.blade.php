<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/layouts/main.css')}}">
</head>
<body>
    @include('partials._header')

    <div class="content">
        @yield('content')
    </div>

    @include('partials._footer')

    @yield('scripts')
</body>
</html>
