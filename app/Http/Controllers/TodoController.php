<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// use Illuminate\Support\Facades\Storage;


class TodoController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        if ($query) {
            // 検索クエリが存在する場合はフィルタリング
            $todos = Task::where('title', 'like', "%$query%")
                ->orWhere('contents', 'like', "%$query%")
                ->get();
        } else {
            // クエリがない場合は全件取得
            $todos = Task::all();
        }
    
        return view('todos.index', ['todos' => $todos, 'search' => $query]);
    }

    function mypage()
    {
        $date = date('Y/m/d');
        $resp = Http::get('http://api.jugemkey.jp/api/horoscope/free/' . $date);
        $resp = $resp->json();
        $horoscope = $resp['horoscope'];
        $dateFortune = $horoscope[$date];
        array_multisort(
            array_column($dateFortune, 'rank'), SORT_ASC, $dateFortune
        );

        return view('todos.mypage', compact('dateFortune'));
    }
    

    public function store(Request $request)
    {
    // バリデーションを追加
    $validated = $request->validate([
        'title' => 'required|string|max:30',
        'contents' => 'required|string|max:140',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // 画像ファイルのバリデーション
        'due_date' => 'nullable|date|after_or_equal:today', // 期日のバリデーションを追加
    ]);

        // dd($request);
        $post = new Task();
        $post -> title = $request -> title;
        $post -> contents = $request -> contents;
        $post -> image_at = null;
        $post -> user_id = Auth::id();
        $post->due_date = $request->due_date; // 期日を保存

    // 画像がアップロードされているかを確認
        if ($request->hasFile('image')) {
        // 画像をstorageに保存し、そのパスを取得
        $path = $request->file('image')->store('images', 'public');  // スペースを含まない
        $post->image_at = $path; // パスをデータベースに保存
        //dd($path);
        } else {
            // デフォルト画像を設定
            $post->image_at = 'images/default.png';
        }

        $post -> save();

        return redirect()->route('todos.index')->with('success', 'タスクが作成されました！');

    }
    

    public function destroy($id)
    {
        $todo = Task::find($id);
        $todo -> delete();

        return redirect()->route('todos.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'contents' => 'required|string|max:140',
        ]);

        $todo = Task::find($id);

        $todo -> title = $request -> input('title');
        $todo -> contents = $request -> input('contents');
        $todo -> save();

        return redirect()->route('todos.index')->with('success', 'タスクが更新されました！');
        
    }

    // 追加: 期日を更新するメソッド
    public function updateDueDate(Request $request, $id)
    {
        $request->validate([
            'due_date' => 'required|date|after_or_equal:today', // 期日が今日以降であることを確認
        ]);

        $todo = Task::find($id);

        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'タスクが見つかりません');
        }

        $todo->due_date = $request->input('due_date');
        $todo->save();

        return redirect()->route('todos.index')->with('success', '期日が更新されました！');
    }

}
// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'title' => 'required',
//         'contents' => 'required',
//     ]);
// }
//     バリデーション通過後の処理
//     $post->update($validatedData); // 更新処理など

// function store(Request $request)
// {
//     // バリデーション
//     $validatedData = $request->validate([
//         'title' => 'required',
//         'contents' => 'required',
//     ]);

//     // 更新対象のタスクを取得
//     $post = Task::find($request->id); // IDをリクエストから取得する例

//     // データが存在すれば更新
//     if ($post) {
//     $post->update($validatedData);
//     } else {
//     return redirect()->route('todos.index')->with('error', '対象のタスクが見つかりません');
//     }

//     // 更新後、リダイレクト
//     return redirect()->route('todos.index')->with('success', 'タスクを更新しました');
// }