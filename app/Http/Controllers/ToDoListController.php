<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Listar todas as listas
    public function index()
    {
        return ToDoList::with('tasks')
            ->where('user_id', Auth::id())
            ->get();
    }

    // Criar uma nova lista
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        $toDoList = ToDoList::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        return response()->json($toDoList, 201);
    }

    // Exibir uma lista específica
    public function show(ToDoList $toDoList)
    {
        if ($toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return $toDoList->load('tasks');
    }

    // Atualizar uma lista
    public function update(Request $request, ToDoList $toDoList)
    {
        if ($toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['name' => 'required|string|max:255']);
        $toDoList->update($request->all());
        return $toDoList;
    }

    // Deletar uma lista
    public function destroy(ToDoList $toDoList)
    {
        if ($toDoList->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $toDoList->delete();
        return response()->noContent();
    }
}
