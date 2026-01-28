<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Request; // Tambahkan ini

class LogActivity extends Model
{
    protected $fillable = ['subject', 'url', 'method', 'agent', 'user_id'];

    public static function addToLog($subject)
    {
        $log = [
            'subject' => $subject,
            'url'     => request()->fullUrl(),
            'method'  => request()->method(),
            'agent'   => request()->header('user-agent'),
            // 'user_id' => auth()->check() ? auth()->user()->id : null,
        ];

        static::create($log);
    }
}
