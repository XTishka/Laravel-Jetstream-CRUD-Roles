<?php

namespace Modules\Tasks\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Modules\Auth\Http\Requests\StoreTaskRequest;
use Modules\Auth\Http\Requests\UpdateTaskRequest;
use Modules\Tasks\Entities\Task;
use Modules\Auth\Http\Controllers\AuthController;

class TasksController extends AuthController
{
    public function index()
    {
        abort_if(Gate::denies('tasks_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tasks = Task::all();
        return view('tasks::tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('tasks_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tasks::tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('tasks_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tasks::tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('tasks_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tasks::tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('tasks_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
