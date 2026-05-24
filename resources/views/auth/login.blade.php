<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Login</h2>

        <form method="POST" action="/login">
            @csrf
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button style="width:100%;">Login</button>
        </form>

        <a href="/register" class="auth-link">Registrati</a>
    </div>
</div>

</body>
</html>