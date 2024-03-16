@extends('layout.index')
@section('title', 'Tasks List')
@section('content')
    <h1>Users List</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th colspan="4">tasks count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <th scope="row">{{ $user->name }}</th>
                    <td colspan="4" scope="row">
                        {{ $user->tasks_count }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        {!! $users->links('pagination::bootstrap-5') !!}
    </table>
@endsection
