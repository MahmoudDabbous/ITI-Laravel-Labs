<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('user')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreTaskRequest $request)
    {
        $task = new Task($request->validated());
        $task->user()->associate(auth()->user());
        $task->save();
        return redirect()->route('tasks.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id)->first();
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('tasks.index');
    }

    public function trash(string $id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index');
    }

    public function restore(string $id)
    {
        Task::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('tasks.index');
    }

    public function showTrash()
    {
        $tasks = Task::onlyTrashed()->where('user_id', '=', Auth::id())->paginate(10);
        return view('tasks.trash', compact('tasks'));
    }
}
