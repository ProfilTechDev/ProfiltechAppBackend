<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotificationSettings extends Model
{
    protected $fillable = ['user_id', 'type', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
