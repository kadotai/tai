<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        dd($request->title);
        
        $todo = new Task;
        $todo -> title = $request -> title;
        $todo -> contents = $request -> contents;
        $todo -> user_id = Auth::id();
        
        $todo -> save();

        return redirect()->route('todos.index');
    }

    public function update(Request $request, $id)
    {
        $todo = Task::find($id);

        $todo -> title = $request -> input('title');
        $todo -> contents = $request -> input('contents');
        // $todo ->image_at = now();
        $todo->user_id = auth()->user()->id;
        $todo -> save();

        return redirect()->route('todos.index'); 

    }
}
