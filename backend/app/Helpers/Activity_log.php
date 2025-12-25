<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('activity_log')) {
    function activity_log(
        string $action,
        string|null $model = null,
        int|null $model_id = null,
        string|null $description = null
    ): void {
        ActivityLog::create([
            'user_id'     => Auth::id(), // aman walau belum login
            'action'      => $action,
            'model'       => $model,
            'model_id'    => $model_id,
            'description' => $description,
        ]);
    }
}
