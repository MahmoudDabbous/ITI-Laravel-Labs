@extends('layout.index')
@section('title', 'User')
@section('content')
    <h1>Tasks List</h1>
    <a href="{{ url('/tasks') }}" class="btn btn-info">Back</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th colspan="4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <th scope="row">{{ $task->title }}</th>
                    <td colspan="4" scope="row">
                        <form method="post" action="{{ url("/tasks/{$task->id}/restore") }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info">Restore</button>
                        </form>
                        <form method="post" action="{{ url("/tasks/{$task->id}") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {!! $tasks->links('pagination::bootstrap-5') !!}
    </table>
@endsection
