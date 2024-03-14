@extends('layout.index')
@section('title', 'User')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $msg }} : {{ $id }}</h2>
            </div>
        </div>
@endsection
