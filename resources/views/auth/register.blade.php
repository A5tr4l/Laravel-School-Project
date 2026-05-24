<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Registrazione</h2>

        <form method="POST" action="/register">
            @csrf
            <input type="text" name="name" placeholder="Nome">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button style="width:100%;">Registrati</button>
        </form>

        <a href="/login" class="auth-link">Hai già un account?</a>
    </div>
</div>

</body>
</html>