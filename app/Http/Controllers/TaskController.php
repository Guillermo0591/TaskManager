<?php

namespace App\Http\Controllers;

use App\TaskManager\Models\Task;
use App\TaskManager\Models\TaskStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Psy\CodeCleaner\UseStatementPass;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'task.index');

        $userLogged = auth()->user();
        $isAdmin = $userLogged->getIsAdmin();

        if ($isAdmin){
            $tasks = Task::orderBy('id', 'asc')->paginate(10);
        } else {
            $tasks = Task::where('users_id', $userLogged->id)
                ->orderBy('id', 'asc')->paginate(10);
        }

        return view('task.index', compact('tasks', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'task.create');

        $users = User::whereHas('roles', function ($query){
            $query->where('isAdmin', false);
        })->get();

        return view('task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'max:200',
            'user_id' => 'required'
        ]);

        $task = Task::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $request->get('user_id'),
            'status_id' => 1
        ]);

        return redirect()->route('task.index')
            ->with('status_success', 'Task saved successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $users = User::whereHas('roles', function ($query){
            $query->where('isAdmin', false);
        })->get();
        $status = TaskStatus::all();
        $userLogged = auth()->user();
        $isAdmin = $userLogged->getIsAdmin();
        return view('task.view', compact('users', 'task', 'status', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::whereHas('roles', function ($query){
            $query->where('isAdmin', false);
        })->get();
        $status = TaskStatus::all();
        $userLogged = auth()->user();
        $isAdmin = $userLogged->getIsAdmin();
        return view('task.edit', compact('users', 'task', 'status', 'isAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $userLogged = auth()->user();
        $isAdmin = $userLogged->getIsAdmin();

        $request->validate([
            'name' => 'required|max:50',
            'description' => 'max:200',
            'status_id' => 'required'
        ]);

        $task->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'users_id' => ($isAdmin) ? $request->get('user_id') : $userLogged->id,
            'statuses_id' => $request->get('status_id')
        ]);

        return redirect()->route('task.edit', $task->id)
            ->with('status_success', 'Task saved successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index', $task->id)
            ->with('status_success', 'Task removed successful');
    }
}
