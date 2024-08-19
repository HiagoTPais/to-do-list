<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToDoListRequest;
use App\Http\Requests\UpdateToDoListRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Log;

class ToDoListController extends Controller
{
    public function index()
    {
        $todolist = ToDoList::all()->where("user_id", Auth::id());

        return view('home', compact('todolist'));
    }

    public function store(StoreToDoListRequest $request)
    {
        $todolist = ToDoList::create([
            "task" => $request->input("task"),
            "description" => $request->input("description"),
            "status" => $request->input("status"),
            "due_date" => $request->input("due_date"),
            "user_id" => Auth::id()
        ]);

        return redirect()->back()->with('msg', 'A tarefa foi cadastrada com sucesso');
    }

    public function show(ToDoList $toDoList)
    {
        $todolist = ToDoList::findOrFail($toDoList->id);

        return view('home', compact('todolist'));
    }

    public function edit(ToDoList $toDoList, $id)
    {
        $todolist = $toDoList::find($id);

        return view('edit', compact('todolist'));
    }

    public function update(UpdateToDoListRequest $request, ToDoList $toDoList)
    {
        $todolist = $toDoList::find($request->id);

        $todolist->task = $request->input("task");
        $todolist->status = $request->input("status");
        $todolist->description = $request->input("description");
        $todolist->due_date = $request->input("due_date");

        $todolist->save();

        return redirect()->back()->with('msg', 'A tarefa foi alterada com sucesso');
    }

    public function destroy(Request $request)
    {
        ToDoList::findOrFail($request->id)->delete();

        return redirect()->back()->with('msg', 'A tarefa foi removida com sucesso');
    }
}
