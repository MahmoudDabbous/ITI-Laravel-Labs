@extends('layout.index')
@section('title', 'Trash')
@section('content')
    <h1>Trash</h1>
    <a href="{{ url('/tasks') }}" class="btn btn-info">Back</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <th scope="row">{{ $task->title }}</th>
                </tr>
            @endforeach
        </tbody>
        {!! $tasks->links('pagination::bootstrap-5') !!}
    </table>
@endsection
