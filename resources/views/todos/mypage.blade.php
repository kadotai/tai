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
    <div class="horoscope">Horoscope</div>
    <div class="uranai">
        @foreach ( $dateFortune as $fortune )
  <section class="uranai_box">
    <h2>{{ $fortune['sign'] }}</h2>
    <ul>
      <li>ランク: {{ $fortune['rank'] }}</li>
      <li>内容: {{ $fortune['content'] }}</li>
      <li>ラッキーアイテム: {{ $fortune['item'] }}</li>
      <li>ラッキーカラー: {{$fortune['color']}}</li>
    </ul>
  </section>
  @endforeach
</div>
    </main>
    <footer>
        <p>&copy; 2024 Tai team</p>
    </footer>
</body>
</html>