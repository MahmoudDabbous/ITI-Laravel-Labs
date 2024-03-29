@extends('layout.index')
@section('title', 'Tasks List')
@section('content')
    <h1>Tasks List</h1>
    @if (Auth::check())
        <a href="{{ url('/tasks/create') }}" class="btn btn-primary">Create Task</a>
        <a href="{{ url('/tasks/trash') }}" class="btn btn-danger">Trash</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">User</th>
                <th colspan="4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <th scope="row">{{ $task->title }}</th>
                    <th scope="row">{{ $task->user->name }}</th>
                    <td colspan="4" scope="row">
                        <a href="{{ url("/tasks/{$task->id}") }}" class="btn btn-info">More</a>
                        @if ($task->user_id == Auth::id())
                            <a href="{{ url("/tasks/{$task->id}/edit") }}" class="btn btn-warning">Edit</a>
                            <form method="post" action="{{ url("/tasks/{$task->id}/trash") }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        {!! $tasks->links('pagination::bootstrap-5') !!}
    </table>
@endsection
