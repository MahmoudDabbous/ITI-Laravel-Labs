@extends('layout.index')
@section('title', 'Create Task')
@section('content')
    <h1>Create Task</h1>
    @include('includes.errors')
    <form method="POST" action="{{ url('/tasks') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('title')}}">
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea name="description" class="form-control" aria-label="With textarea">{{old('description')}}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input name="image" class="form-control" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
