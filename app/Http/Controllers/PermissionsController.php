<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogingActions;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    public function index() {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all()->sortByDesc('title');
        return view('permissions.index', compact('permissions'));
    }

    public function create() {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission = Permission::pluck('id', 'title', 'slug', 'description');
        return view('permissions.create', compact('permission'));
    }

    public function store(StorePermissionRequest $request) {
        $permission = Permission::create($request->validated());
        LogingActions::writeLog('permission', 'store', $permission->id, $request->all());
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission) {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission) {
        abort_if(Gate::denies('permissions_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('permissions.edit', compact('permission'));
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
