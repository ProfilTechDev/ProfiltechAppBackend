<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalShipping extends Model
{
    public function scopeAll($query)
    {
        return $query->get();
    }
}
