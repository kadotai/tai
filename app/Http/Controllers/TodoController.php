<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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
        // dd($request);
        $post = new Task;
        $post -> title = $request -> title;
        $post -> contents = $request -> contents;
        $post -> user_id = Auth::id();

        $post -> save();

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
