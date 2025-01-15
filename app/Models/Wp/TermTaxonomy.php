<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    protected $connection = 'wp';
    protected $table = 'term_taxonomy';

    public function term(){
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
