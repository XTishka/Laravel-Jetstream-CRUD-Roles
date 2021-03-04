<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index() {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create() {
        $permission = Permission::pluck('id', 'title', 'slug', 'description');
        return view('permissions.create', compact('permission'));
    }

    public function store(StorePermissionRequest $request) {
        Permission::create($request->validated());
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission) {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission) {
        return view('permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission) {
        $permission->update($request->validated());
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
