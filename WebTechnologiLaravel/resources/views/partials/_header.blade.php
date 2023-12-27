<head>
    <meta charset="UTF-8">
    <title>header</title>
    <link rel="stylesheet" href="{{asset('css/partials/_headerStyle.css')}}">
</head>
<div class="header-background">
    <div class="header">
        <div class="logo">
            <h2>Magic Samples</h2>
            <div class="header-links-box">
                <li><a href="{{ asset('/sample-page') }}" class="header-link">Samples</a></li>
                <li><a href="google.com" class="header-link">Community</a></li>
                <li><a href="{{ asset('/blogs') }}" class="header-link">Blog</a></li>
            </div>
        </div>
        <div class="login-info">
            @if(Auth::check())
                @if(Request::is('my-page-creator'))
                    <li><a href="{{ asset('/') }}" class="my-page-button">Home</a></li>
                @else
                    <li><a href="{{ asset('/my-page-creator') }}" class="my-page-button">My Page</a></li>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li><button class="logout-button">Log Out</button></li>
                </form>
            @else
                <li><a href="{{ asset('/login') }}" class="login-button">Log In</a></li>
                <li><a href="{{ asset('/signup') }}" class="signup-button">Sign Up</a></li>
            @endif
        </div>
    </div>
</div>

