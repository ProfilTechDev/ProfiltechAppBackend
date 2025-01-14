<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCProduct extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'posts';

        /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('product', function ($builder) {
            $builder->where('post_type', 'product');
        });
    }
}
