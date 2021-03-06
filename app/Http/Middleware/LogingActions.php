<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogingActions
{
    // TODO: Уйти в логгировании от статичного метода
    // TODO: Добавить отлов ошибок при записи лога
    public static function writeLog($object, $action, $id, $data)
    {
        $channel = [
            'user'       => 'settings_users',
            'role'       => 'settings_roles',
            'permission' => 'settings_permissions'
        ];
        $user    = Auth::user()->id;
        $action  = ($action === 'store') ? "[$action] " : "[$action]";
        Log::channel($channel[$object])->info("[user_$user] | $action | [$object" . "_" . "$id] | ", [$data]);
    }
}
