<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Registrazione</h2>

<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="Nome"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button>Registrati</button>
</form>

<a href="/login">Hai già un account?</a>

</body>
</html>