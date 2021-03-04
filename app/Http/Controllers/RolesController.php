<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Permission;

class RolesController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::pluck('title', 'id');
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request) {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('roles.index');
    }

    public function show(Role $role) {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role) {
        $permissions = Permission::pluck('title', 'id');
        $role->load('permissions');

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        $role->update($request->validated());
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
