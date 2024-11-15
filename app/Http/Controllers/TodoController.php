<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Task;

class TodoController extends Controller
{
    //
    function index()
    {   
        $todos = Task::all();
        //dd($todos);
        return view('todos.index',['todos'=>$todos]);
    }
}






// public function update(Request $request)
// {
//     $validatedData = $request->validate([
//         'title' => 'required',
//         'detail' => 'required',
//     ]);

    // バリデーション通過後の処理
    // $post->update($validatedData); // 更新処理など
// }
