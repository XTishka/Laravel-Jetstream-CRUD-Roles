<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogingActions
{
    // TODO: Уйти в логгировании от статичного метода
    // TODO: Добавить отлов ошибок при записи лога
    public static function writeLog($channel, $object, $action, $id, $data)
    {
        $user = Auth::user()->id;
        $action = ($action === 'store') ? "[$action] " : "[$action]";
        Log::channel($channel)->info("[user_$user] | $action | [$object" . "_" ."$id] | ", [$data]);
    }
}
