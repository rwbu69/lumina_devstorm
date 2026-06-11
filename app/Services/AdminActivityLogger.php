<?php

namespace App\Services;

use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;

class AdminActivityLogger
{
    public static function log(string $action, ?string $description = null): void
    {
        if (Auth::check()) {
            AdminLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'description' => $description,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
