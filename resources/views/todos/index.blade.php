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
                <a class="dropdown-toggle1" href="/logout">&nbsp;Logout</a>
            <!-- 新規投稿モーダル -->
            <div id="modal">
            <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <h2>What will you do?</h2>
              <input class="text1" name='title' placeholder="Title" maxlength="30">
              <br>
              <textarea class="text2" name='contents' placeholder="Contents" maxlength="140"></textarea>
              <br>
              <label for="image" class="image_button">Select Image</label>
              <input id="image" type="file" name="image" accept="image/*" style="display: none;">
              <button id="closeModalButton">Ok</button>
              <a class="dropdown-toggle1" href="/todos">&nbsp;Back</a>
            </form>
              {{-- <button id="closeModalButton">close</button> --}}
              <!-- タイトルのエラーメッセージ -->
              {{-- @if ($errors->has('title'))
              <p style="color:red;">{{ $errors->first('title') }}</p>
              @endif --}}

              <!-- 詳細のエラーメッセージ -->
              {{-- @if ($errors->has('detail'))
              <p style="color:red;">{{ $errors->first('detail') }}</p>
              @endif --}}

              <!-- エラーメッセージ -->
              @if ($errors->has('title'))
              <p class="error-message" style="color:red;">{{ $errors->first('title') }}</p>
              @endif

              @if ($errors->has('contents'))
              <p class="error-message" style="color:red;">{{ $errors->first('contents') }}</p>
              @endif

            </div>
            <form id="searchForm" action="{{ route('todos.index') }}" method="GET" style="margin-bottom: 10px;">
                <input type="text" id="searchInput" name="search" placeholder="Search by title or content" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>
    </header>
    <main>
        
        <div id="big_box">
            @foreach($todos as $todo)
            <div id="small_box">
                @if($todo->image_at === 'images/default.png')
                <img src="{{ asset($todo->image_at) }}" alt="HITODE" width="100px">
                @else
                <img src="{{ asset('storage/' . $todo->image_at) }}" alt="アイコン" width="210px">
                @endif
                <label class="ECM_CheckboxInput">
                    <input class="ECM_CheckboxInput-Input" type="checkbox">
                    <span class="ECM_CheckboxInput-DummyInput"></span>
                    {{-- <span class="ECM_CheckboxInput-LabelText"> --}}
                        <h5 class="card-title">{{ $todo->title }}<br></h5>
                    {{-- </span> --}}
                </label>
                <p class="card-text">{{ $todo->contents }}</p>
                <!-- 編集モーダル用のオーバーレイ -->
                <div id="modalOverlay1"></div>
                <!-- 編集ボタン -->
                <div class="button">
                    <button id="openModalButton1" data-id="{{ $todo->id }}" data-title="{{ $todo->title }}" data-contents="{{ $todo->contents }}">Edit</button>

                    <form id="deleteForm{{ $todo->id }}" action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button" data-id="{{ $todo->id }}">Delete</button>
                    </form>
                </div>

                <!-- 編集モーダル -->
                <div id="modal{{ $todo->id }}" class="modal" style="display: none;">
                    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $todo->title }}" placeholder="Title">
                        <br>
                        <input type="text" name="contents" value="{{ $todo->contents }}" placeholder="Detail">
                        <br>
                        <button type="submit">Ok</button>
                        <button type="button" class="closeModalButton">Close</button>
                    </form>
                </div>

                {{-- 前のやつ、念のため残している --}}
                {{-- <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div id="modal1">
                        <input type="text" placeholder="Title">
                        <br>
                        <input type="text" placeholder="Detail">
                        <br>
                        <button id="closeModalButton1">ok</button>
                        <button id="closeModalButton1">close</button>
                    </div>
                </form> --}}
        </div>
            @endforeach
    </main>
    <footer>
        <p>&copy; 2024 Tai team</p>
    </footer>
</body>
<script src="{{ asset('js/script.js') }}"></script>
</html>