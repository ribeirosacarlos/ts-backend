<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Criar uma nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'to_do_list_id' => 'required|exists:to_do_lists,id',
            'description' => 'required|string|max:255',
        ]);

        return Task::create($request->all());
    }

    // Atualizar uma tarefa
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'is_completed' => 'required|boolean',
        ]);

        $task->update($request->all());
        return $task;
    }

    // Deletar uma tarefa
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}