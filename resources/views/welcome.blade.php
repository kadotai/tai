<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">
</head>
<body class="antialiased">
    <h1>TaiToDo</h1>
    <div class="glass"><img src="{{ asset('images/welcome.png') }}" alt="" ></div>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/home') }}" class="link">Home</a>
                @else
                    <a href="{{ route('login') }}" class="link">LogIn</a>
                    <br>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="link">Register</a>
                    @endif
                @endauth
            </div>
        @endif

</body>
</html>
