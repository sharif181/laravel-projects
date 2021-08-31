<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\todolist;


class TodolistController extends Controller
{
    public function todos(){
        $todos = todolist::orderBy('id','desc')->get();
        return response()->json($todos);
    }
    public function todo_create(Request $req){
        $todo = todolist::create([
            'task'=>$req->input('task'),
        ]);
        $todo->save();
        return response()->json($req);
    }
    public function delete($id){
        todolist::destroy($id);
        return response()->json("deleted");
    }
    public function search($task){
        $todo = todolist::query()
        ->where('task','Like',"%{$task}%")->get();
        return response()->json($todo);
    }
    public function update(Request $req, $id){
        $todo = todolist::find($id);
        $todo->task = $req->input('task');
        $todo->save();
        return response()->json("updated");
    }

}
