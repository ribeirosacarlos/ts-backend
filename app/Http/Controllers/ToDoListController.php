<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    // Listar todas as listas
    public function index()
    {
        return ToDoList::with('tasks')->get();
    }

    // Criar uma nova lista
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        return ToDoList::create($request->all());
    }

    // Exibir uma lista específica
    public function show(ToDoList $toDoList)
    {
        return $toDoList->load('tasks');
    }

    // Atualizar uma lista
    public function update(Request $request, ToDoList $toDoList)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $toDoList->update($request->all());
        return $toDoList;
    }

    // Deletar uma lista
    public function destroy(ToDoList $toDoList)
    {
        $toDoList->delete();
        return response()->noContent();
    }
}
