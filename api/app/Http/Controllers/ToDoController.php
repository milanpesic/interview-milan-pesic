<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class ToDoController extends Controller
{
    
    public function showToDoList()
    {
        return Task::get();
    }

    public function createToDoList(Request $request)
    {
        $toDoCreate = Task::create([
            'task' => $request->task,
            'checked' => $request->checked
        ]);

        return Task::get();
    }

    public function updateToDoList(Request $request, $id)
    {
        $toDoUpdate = Task::where('id', $id)->update([
            'task' => $request->task
        ]);
    }

    public function checkedToDoList(Request $request, $id)
    {
        $toDoChecked = Task::where('id', $id)->update([
            'checked' => $request->checked
        ]);
    }

    public function deleteToDoList($id)
    {

        $toDoDelete = Task::destroy($id);

        return Task::get();

    }
}