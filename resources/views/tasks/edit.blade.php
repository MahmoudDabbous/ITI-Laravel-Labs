@extends('layout.index')
@section('title', 'Edit Task')
@section('content')
    <h1>Edit Task</h1>
    @include('includes.errors')
    <form method="POST" action="{{ url("/tasks/{$task->id}") }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ old('title', $task->title) }}">
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea name="description" class="form-control" aria-label="With textarea">{{  old('description', $task->description) }}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input name="image" class="form-control" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
