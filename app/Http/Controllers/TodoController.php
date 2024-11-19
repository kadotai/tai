<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
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
    


    public function store(Request $request)
    {
    // バリデーションを追加
    $validated = $request->validate([
        'title' => 'required|string|max:30',
        'contents' => 'required|string|max:140',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // 画像ファイルのバリデーション
    ]);

        // dd($request);
        $post = new Task;
        $post -> title = $request -> title;
        $post -> contents = $request -> contents;
        // $post -> image_at = $request -> image_at;
        $post -> user_id = Auth::id();

    // 画像がアップロードされているかを確認
        if ($request->hasFile('image')) {
        // 画像をstorageに保存し、そのパスを取得
        $path = $request->file('image')->store('images', 'public');  // スペースを含まない
        $post->image_at = $path; // パスをデータベースに保存
        //dd($path);
        }

        $post -> save();

        return redirect()->route('todos.index');

    }

    function destroy($id)
    {
        $todo = Task::find($id);
        $todo -> delete();

        return redirect()->route('todos.index');
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'contents' => 'required|string|max:140',
        ]);

        $todo = Task::find($id);

        $todo -> title = $request -> input('title');
        $todo -> contents = $request -> input('contents');
        $todo -> save();

        return redirect()->route('todos.index');
        
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

function store(Request $request)
{
    // バリデーション
    $validatedData = $request->validate([
        'title' => 'required',
        'contents' => 'required',
    ]);

    // 更新対象のタスクを取得
    $post = Task::find($request->id); // IDをリクエストから取得する例

    // データが存在すれば更新
    if ($post) {
    $post->update($validatedData);
    } else {
    return redirect()->route('todos.index')->with('error', '対象のタスクが見つかりません');
    }

    // 更新後、リダイレクト
    return redirect()->route('todos.index')->with('success', 'タスクを更新しました');
}