<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\LogingActions;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->input('password'))]);
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        LogingActions::writeLog('settings_users', 'user', 'store', $user->id, $request->all());
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $password = $request->input('password');
        if ( $password != null) {
            $request->merge(['password' => Hash::make($password)]);
            $user->update($request->all());
        } else {
            $user->update($request->validated());
        }
        $user->roles()->sync($request->input('roles', []));
        LogingActions::writeLog('settings_users', 'user','update', $user->id, $request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->delete();
        LogingActions::writeLog('settings_users', 'user','delete', $user->id, null);
        return redirect()->route('users.index');
    }
}
