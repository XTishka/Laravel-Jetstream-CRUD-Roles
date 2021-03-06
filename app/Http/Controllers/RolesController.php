<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogingActions;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index() {
        abort_if(Gate::denies('roles_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create() {
        abort_if(Gate::denies('roles_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::pluck('title', 'id');
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request) {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions', []));
        LogingActions::writeLog('role', 'store', $role->id, $request->all());
        return redirect()->route('roles.index');
    }

    public function show(Role $role) {
        abort_if(Gate::denies('roles_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role) {
        abort_if(Gate::denies('roles_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::pluck('title', 'id');
        $role->load('permissions');

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        $role->update($request->validated());
        $role->permissions()->sync($request->input('permissions', []));
        LogingActions::writeLog('role','update', $role->id, $request->all());
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role) {
        abort_if(Gate::denies('roles_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->delete();
        LogingActions::writeLog('role','update', $role->id, null);
        return redirect()->route('roles.index');
    }
}
