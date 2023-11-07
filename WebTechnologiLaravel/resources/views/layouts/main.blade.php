<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/layouts/main.css')}}">
</head>
<body>
    @include('partials._header')

    <div class="content">
        @yield('content')
    </div>

    @include('partials._footer')
</body>
</html>
