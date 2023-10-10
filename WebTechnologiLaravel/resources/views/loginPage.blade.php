<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/loginPageStyle.css')}}">
</head>
<body>
<form id="loginForm" method="post" action="{{ route('login') }}">
    @csrf
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit" class="login-button">Login</button>
</form>
</body>
</html>
