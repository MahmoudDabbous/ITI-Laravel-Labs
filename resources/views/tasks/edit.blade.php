@extends('layout.index')
@section('title', 'Edit Task')
@section('content')
    <h1>Edit Task</h1>
    @include('includes.errors')
    <form method="POST" action="{{ url("/tasks/{$task->id}") }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $task->title ?? old('title') }}">
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea name="description" class="form-control" aria-label="With textarea">{{ $task->description ?? old('description') }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
