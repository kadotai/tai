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
            <h1>TaiToDo</h1>
            <!-- 新規投稿モーダル用のオーバーレイ -->
            <div id="modalOverlay"></div>
            <!-- 新規投稿ボタン -->
            <button id="openModalButton">New Post</button>
            {{-- ユーザーネーム --}}
            <div class="dropdown nav">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
                </a>
                <a href="/logout">Logout</a>
            <!-- 新規投稿モーダル -->
            <div id="modal">
            <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <h2>What will you do?</h2>
              <input type="text" name='title' placeholder="Title">
              <br>
              <input type="text" name='contents' placeholder="Contents">
              <br>
              <label for="image">Image:</label>
              <input id="image" type="file" name="image" accept="image/*">
              <button id="closeModalButton">ok</button>
            </form>
              {{-- <button id="closeModalButton">close</button> --}}
              <!-- タイトルのエラーメッセージ -->
              @if ($errors->has('title'))
              <p style="color:red;">{{ $errors->first('title') }}</p>
              @endif

              <!-- 詳細のエラーメッセージ -->
              @if ($errors->has('detail'))
              <p style="color:red;">{{ $errors->first('detail') }}</p>
              @endif

            </div>
        </div>
    </header>
    <main>
        
        <div id="big_box">
            @foreach($todos as $todo)
            <div id="small_box">
                <img src="{{ asset('storage/' . $todo->image_at) }}" alt="アイコン" width="100px">
                <h5 class="card-title">タイトル : {{ $todo->title }}<br></h5>
                <p class="card-text">内容 : {{ $todo->contents }}<br></p>
                <!-- 編集モーダル用のオーバーレイ -->
                <div id="modalOverlay1"></div>
                <!-- 編集ボタン -->
                <div class="button">
                <button id="openModalButton1">edit</button>

                <form id="deleteForm{{ $todo->id }}" action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete-button" data-id="{{ $todo->id }}">delete</button>
                </form>
                </div>
                <!-- 編集モーダル -->
                <form actions="{{ route('todos.update', $todo->id) }}" method="POST">
                <div id="modal1">
                  <input type="text" value="{{ $todo->title }} "placeholder="Title">
                  <br>
                  <input type="text" value="{{ $todo->contents }}" placeholder="Detail">
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