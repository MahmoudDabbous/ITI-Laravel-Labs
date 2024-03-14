@extends('layout.index')
@section('title', 'User')
@section('content')
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
                        <a href="{{ url("/tasks/{$task->id}") }}" class="btn btn-info">More</a>
                        <a href="{{ url("/tasks/{$task->id}/edit") }}" class="btn btn-warning">Edit</a>
                        <form method="post" action="{{ url("/tasks/{$task->id}") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            {!! $tasks->links('pagination::bootstrap-5') !!}
        </tbody>
    </table>
@endsection
