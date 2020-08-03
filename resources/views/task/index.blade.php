@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>List of tasks</h3></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('custom.messages')
                        @if($isAdmin)
                                <a class="btn btn-primary float-right" href="{{ route('task.create') }}">Create Task</a>
                                <br><br>
                        @endif

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <!--th scope="col">Description</th-->
                                <th scope="col">Status</th>
                                @if($isAdmin)
                                <th scope="col">User</th>
                                @endif
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td><a href="{{ route('task.show', $task->id) }}">{{ $task->id }}</a></td>
                                    <td>{{ $task->name }}</td>
                                    <!--td>{{ $task->description }}</td-->
                                    <td>{{ $task->statuses->name }}</td>
                                    @if($isAdmin)
                                        <td>
                                            {{ $task->users->name }}
                                        </td>
                                    @endif
                                    <td>
                                        <div class="btn-group mr-2" role="group">
                                            <a class="btn btn-warning" href="{{ route('task.edit', $task->id) }}">Edit</a>
                                        </div>
                                        <div class="btn-group mr-2" role="group">
                                            <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
