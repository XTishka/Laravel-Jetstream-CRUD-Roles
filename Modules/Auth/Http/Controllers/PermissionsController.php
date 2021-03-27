<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Http\Requests\StorePermissionRequest;
use Modules\Auth\Http\Requests\UpdatePermissionRequest;
use Modules\Auth\Http\Middleware\LogingActions;


class PermissionsController extends AuthController
{
    public function index() {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all()->sortByDesc('title');
        return view('auth::permissions.index', compact('permissions'));
    }

    public function create() {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission = Permission::pluck('id', 'title', 'slug', 'description');
        return view('auth::permissions.create', compact('permission'));
    }

    public function store(StorePermissionRequest $request) {
        $permission = Permission::create($request->validated());
        LogingActions::writeLog('permission', 'store', $permission->id, $request->all());
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission) {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('auth::permissions.show', compact('permission'));
    }

    public function edit(Permission $permission) {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('auth::permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission) {
        $permission->update($request->validated());
        LogingActions::writeLog('permission', 'update', $permission->id, $request->all());
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission) {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission->delete();
        LogingActions::writeLog('permission', 'delete', $permission->id,null);
        return redirect()->route('permissions.index');
    }
}
