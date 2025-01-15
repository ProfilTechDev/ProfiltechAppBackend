<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $connection = 'wp';
    protected $table = 'terms';
}
