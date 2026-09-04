<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use function Laravel\Prompts\text;
use function PHPUnit\Framework\isEmpty;

class TodoController extends Controller
{
    public function todo_list_form()
    {
        $todos = Todo::all();
        return view('todo-list-form', compact('todos'));

    }

    public function todo_list_create(Request $request)
    {
        $todo = Todo::create([
            'text' => $request->input('todo-input'),
        ]);
        return redirect(route('todo_list_form'));
    }

    public function todo_list_delete(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect(route('todo_list_form'));
    }
}
