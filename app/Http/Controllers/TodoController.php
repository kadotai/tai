<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Todo;

class TodoController extends Controller
{
    //
    function index()
    {   
        // $todos = Todo::all();
        return view('todos.index');
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
