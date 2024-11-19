<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyPage</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <header>
        <div id="first">
            <h1>TaiToDo</h1>
            {{-- ユーザーネーム --}}
            <div class="dropdown nav">
                <a class="dropdown-toggle" href="/todos" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Home
                    </a>
                <a class="dropdown-toggle1" href="/logout">&nbsp;Logout</a>
        </div>
    </header>
    <main>
        <div class="namebox">
            <img src="{{ asset('images/fish.png') }}" alt="">
            <p class="name">UserName:{{ Auth::user()->name }}</p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Tai team</p>
    </footer>
</body>
</html>