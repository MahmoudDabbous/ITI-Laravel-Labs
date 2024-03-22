<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
        }
        $task = new Task($request->validated());
        $task->image = $imageName;
        $task->user()->associate(auth()->user());
        $task->save();
        return redirect()->route('tasks.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $task = Task::findOrFail($id);
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
        }
        $task = Task::findOrFail($id);
        if ($request->hasFile('image')) {
            $task->image ? unlink(public_path('images/' . $task->image)) : '';
            $task->image = $imageName;
        }
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $task->image ?? '',
        ]);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->image ? unlink(public_path('images/' . $task->image)) : '';
        $task->forceDelete();
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
