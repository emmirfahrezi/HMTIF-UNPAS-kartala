<?php
namespace App\Http\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogActivityService
{
    /**
     * Catat aktivitas
     * 
     * @param string $action   'create', 'update', 'delete', 'login', dll
     * @param string $desc     Deskripsi aktivitas
     * @param mixed|null $model Instance model yang terlibat (opsional)
     */
    public static function log(string $action, string $desc, $model = null): void
    {
        ActivityLog::create([
            'user_id'     => Auth::id(), 
            'action'      => $action,
            'description' => $desc,
            'model_type'  => $model ? get_class($model) : null,
            'model_id'    => $model ? $model->id : null,
        ]);
    }
}