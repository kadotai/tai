<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <header>
        <div id="first">
            <h1 >Tai To Do</h1>
            <!-- 新規投稿モーダル用のオーバーレイ -->
            <div id="modalOverlay"></div>
            <!-- 新規投稿ボタン -->
            <button id="openModalButton">New Post</button>
            <!-- 新規投稿モーダル -->
            @foreach($todos as $todo)
            <div id="modal">
              <h2>What will you do?</h2>
              <form action="{{ route('todos.store', $todo->id) }}" method="POST">
                @csrf
                @method('put') 
              <input type="text" name="title" value="{{ $todo->title }}" placeholder="Title">
              <br>
              <input type="text" name="contents" value="{{ $todo->contents }}" placeholder="Detail">
              <br>
              <button type="submit" id="closeModalButton">ok</button>
              <button type="button" id="closeModalButton">close</button>
            </div>
        @endforeach 
        </div>
    </header>
    <main>
        
        <div id="big_box">
            @foreach($todos as $todo)
            <div id="small_box">
                <img src="" alt="アイコン">
                <h5 class="card-title">タイトル : {{ $todo->title }}<br></h5>
                <p class="card-text">内容 : {{ $todo->contents }}<br></p>
                <!-- 編集モーダル用のオーバーレイ -->
                <div id="modalOverlay1"></div>
                <!-- 編集ボタン -->
                <button id="openModalButton1">edit</button>
                <button id="Button2">delete</button>
                
                <!-- 編集モーダル -->
                <div id="modal1">
                  <input type="text" placeholder="Title">
                  <br>
                  <input type="text" placeholder="Detail">
                  <br>
                  <button id="closeModalButton1">ok</button>
                  <button id="closeModalButton1">close</button>
            </div>
        </div>
        @endforeach
    </main>
    <footer>
        <p>&copy; 2024 Tai team</p>
    </footer>
</body>
<script src="{{ asset('js/script.js') }}"></script>
</html>