@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Edit task</h3></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('custom.messages')
                        <form action="{{ route('task.update', $task->id) }}" method="post">
                            <div class="form-group">
                                <label for="name">Task Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of task" value="{{ old('name', $task->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
                            </div>
                            @if($isAdmin)
                            <div class="form-group">
                                <label for="user">User</label>
                                @foreach($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_id"
                                               id="user-{{$user->id}}"
                                               value="{{$user->id}}"
                                               @if( old('user_id', $task->users_id) == $user->id)
                                                checked
                                               @endif
                                        >
                                        <label class="form-check-label" for="user_id">
                                            {{$user->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="status">Status</label>
                                @foreach($status as $value)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="status_id"
                                               id="status-{{$value->id}}"
                                               value="{{$value->id}}"
                                               @if( old('user_id', $task->statuses_id) == $value->id)
                                               checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="user_id">
                                            {{$value->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
