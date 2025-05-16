<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Criar uma nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'to_do_list_id' => 'required|exists:to_do_lists,id',
            'description' => 'required|string|max:255',
        ]);

        $toDoList = ToDoList::findOrFail($request->to_do_list_id);
        
        if ($toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return Task::create($request->all());
    }

    // Atualizar uma tarefa
    public function update(Request $request, Task $task)
    {
        if ($task->toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'is_completed' => 'required|boolean',
        ]);

        $task->update($request->all());
        return $task;
    }

    // Deletar uma tarefa
    public function destroy(Task $task)
    {
        if ($task->toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->delete();
        return response()->noContent();
    }
}