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
