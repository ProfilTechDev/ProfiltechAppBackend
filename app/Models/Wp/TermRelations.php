<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TermRelations extends Pivot
{
    protected $connection = 'wp';
    protected $table = 'term_relationships';
}
