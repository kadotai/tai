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
