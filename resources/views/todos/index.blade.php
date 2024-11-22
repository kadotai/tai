<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaiToDo</title>
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
                @if (Auth::check())  <!-- 認証済みユーザーかどうかを確認 -->
                    <a class="dropdown-toggle" href="/todos/mypage" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <a class="dropdown-toggle1" href="/logout">&nbsp;Logout</a>
                    @else
                    <p>Please log in</p> <!-- ログインしていない場合のメッセージ -->
                @endif
                <div class="search">
                <form id="searchForm" action="{{ route('todos.index') }}" method="GET" style="margin-bottom: 10px;">
                    <input type="text" id="searchInput" name="search" placeholder="Search by title or content" value="{{ request('search') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
            </div>
            <!-- 新規投稿モーダル -->
            <div id="modal">
            <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>What will you do?</h2>
            <input class="text1" name='title' placeholder="Title" maxlength="30">
            <br>
            <textarea class="text2" name='contents' placeholder="Contents" maxlength="140"></textarea>
            <!-- 期日入力フォーム -->
            <br>
            <label for="due_date">〆</label>
            <input type="date" name="due_date" id="due_date">
            <br>
            <br>
            <label for="image" class="image_button">Select Image</label>
            <input id="image" type="file" name="image" accept="image/*" style="display: none;">
            {{-- <!-- 期日入力フォーム -->
            <br>
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" id="due_date">
            <br> --}}
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
            {{-- <form id="searchForm" action="{{ route('todos.index') }}" method="GET" style="margin-bottom: 10px;">
                <input type="text" id="searchInput" name="search" placeholder="Search by title or content" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form> --}}
        </div>
    </header>
    <main>
        <div class="search_mobile">
            <form id="searchForm" action="{{ route('todos.index') }}" method="GET" style="margin-bottom: 10px;">
                <input type="text" id="searchInput" name="search" placeholder="Search by title or content" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        <div id="big_box">
            @foreach($todos as $todo)
            <div id="small_box">
                   @if($todo->image_at === 'images/default.png')
                   <img src="{{ asset($todo->image_at) }}" alt="HITODE" width="100px">
                   @else
                   <img src="{{ asset('storage/' . $todo->image_at) }}" alt="アイコン" width="210px" class="image_box">
                   @endif
                <label class="ECM_CheckboxInput">
                    <input class="ECM_CheckboxInput-Input" type="checkbox">
                    <span class="ECM_CheckboxInput-DummyInput"></span>
                    {{-- <span class="ECM_CheckboxInput-LabelText"> --}}
                        <h5 class="card-title">&nbsp;{{ $todo->title }}<br></h5>
                    {{-- </span> --}}
                </label>
                <p class="card-text">{{ $todo->contents }}</p>
                <!-- 期日を表示 -->
                <p class="card-limit-text">〆 {{ $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('Y-m-d') : 'No due date' }}</p>
                <!-- 編集モーダル用のオーバーレイ -->
                <div id="modalOverlay1"></div>
                <!-- 編集ボタン -->
                <div class="button">
                    <button class="edit-button" data-id="{{ $todo->id }}" data-title="{{ $todo->title }}" data-contents="{{ $todo->contents }}">Edit</button>


                    {{-- 削除 --}}
                    <form id="deleteForm{{ $todo->id }}" action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button" data-id="{{ $todo->id }}">Delete</button>
                    </form>
                </div>

                <!-- 編集モーダル -->
                @foreach($todos as $todo)
                <div id="modalEdit{{ $todo->id }}" class="modalEdit" style="display: none;">
                    <form action="{{ route('todos.update', $todo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $todo->title }}" placeholder="Title">
                        <br>
                        <input type="text" name="contents" value="{{ $todo->contents }}" placeholder="Detail">
                        <br>
                        <input id="image{{ $todo->id }}" type="file" name="image" accept="image/*" style="display: none;">
                        <div id="imagePreview{{ $todo->id }}">
                            @if($todo->image_at)
                                <img src="{{ asset('storage/' . $todo->image_at) }}" alt="Current Image" width="300px">
                            @endif
                        </div>
                        <label for="image{{ $todo->id }}" class="image_button">Select Image</label>
                        <br>
                        <!-- 期日編集フォーム -->
                        <label for="due_date_{{ $todo->id }}">〆 {{ $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('Y-m-d') : 'No due date' }}</label>
                        <input id="due_date_{{ $todo->id }}" type="date" name="due_date" value="{{ $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('Y-m-d') : '' }}">
                        <br>
                        <button type="submit" id="submitButton{{ $todo->id }}">Ok</button>
                        <button type="button" class="closeModalButton">Close</button>
                        </form>
                    </form>
                
                    </form>
                </div>
                @endforeach
        </div>
            @endforeach
    </main>
    <footer>
        <p>&copy; 2024 Tai team</p>
    </footer>
</body>
<script src="{{ asset('js/script.js') }}"></script>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        var reader = new FileReader();
        
        reader.onload = function(event) {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '<img src="' + event.target.result + '" width="100px">'; 
        };

        if (e.target.files.length > 0) {
            reader.readAsDataURL(e.target.files[0]);
        } else {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = ''; 
        }
    });
</script>
</html>

