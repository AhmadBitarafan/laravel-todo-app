<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use function Brotli\compress_add;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        $total_todos_count = (int)count($todos);
        $total_done_todos_count = (int)count($todos->where('completed', true));
//        dd($todos);
        return view('index', compact('todos', 'total_todos_count', 'total_done_todos_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTodoRequest $request)
    {
        $todo = Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('todos.index')->with('success', 'todo created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $todo = Todo::findOrFail($id);
        return view('show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $todo = Todo::findOrFail($id);
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $todo = Todo::findOrFail($id);
        $data = [];

        if ($request->filled('title')) {
            $data['title'] = $request->input('title');
        }

        if ($request->filled('description')) {
            $data['description'] = $request->input('description');
        }

        if ($request->has('completed')) {
            $data['completed'] = $request->input('completed');
        }
        $todo->update($data);

        return redirect()->back()->with('success', 'Todo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect()->back();
    }
    public function trashed_list(){
        $trashed_items = Todo::onlyTrashed()->get();
        $trashed_count = count($trashed_items);
        return view('trash',compact('trashed_items', 'trashed_count'));
    }
    public function restore(string $id){

    $trashed_item = Todo::onlyTrashed()->findOrFail($id);
    $trashed_item->restore();

    return redirect()
        ->route('todos.trashed')
        ->with('success', 'Todo restored successfully');
    }
    public function force_delete(string $id){
        $trashed_item = Todo::onlyTrashed()->findOrFail($id);
        $trashed_item->forceDelete();
        return redirect()->route('todos.index')->with('success', 'todo deleted successfully');
    }
    public function pending(){
        $pending_todos=Todo::all()->where('completed',false);
        $pending_count = count($pending_todos);
        return view('pending',compact('pending_todos','pending_count'));

    }
    public function completed(){
        $completed_todos = Todo::all()->where('completed',true);
        $completed_count = count($completed_todos);
        return view('completed',compact('completed_todos','completed_count'));
    }


}
