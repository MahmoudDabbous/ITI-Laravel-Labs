@extends('layout.index')
@section('title', 'Task')
@section('content')
    <a href="{{ url('/tasks') }}" class="row btn btn-primary">Back</a>
    <table class="table">
        <tbody>
            <tr>
                <th>{{ $task->id }}</th>
                <th>{{ $task->title }}</th>
                <th>{{ $task->description }}</th>
            </tr>
            <tr>
                @empty ($task->image)
                    <th>No image</th>
                @else
                    <img src="{{ asset('images/' . $task->image) }}" alt="image" width="100" height="100">
                @endif
            </tr>
            <tr>
                @if ($task->user_id == Auth::id())
                    <td>
                        <a href="{{ url("/tasks/{$task->id}/edit") }}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ url("/tasks/{$task->id}/trash") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        </tbody>
    </table>
@endsection
