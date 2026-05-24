<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar">
        <a href="/">Home</a>
        <a href="/topics/history">History</a>

        @auth
            <form method="POST" action="/logout">
                @csrf
                <button>Logout</button>
            </form>
        @endauth
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>