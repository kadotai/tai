<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    //
    function index()
    {   
        $todos = Task::all();
        //dd($todos);
        return view('todos.index',['todos'=>$todos]);
    }


    function store(Request $request)
    {
    // バリデーションを追加
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'contents' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像ファイルのバリデーション
    ]);

        // dd($request);
        $post = new Task;
        $post -> title = $request -> title;
        $post -> contents = $request -> contents;
        $post -> image_at = $request -> image_at;
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

}
// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'title' => 'required',
//         'contents' => 'required',
//     ]);
// }
    // バリデーション通過後の処理
    // $post->update($validatedData); // 更新処理など
// 