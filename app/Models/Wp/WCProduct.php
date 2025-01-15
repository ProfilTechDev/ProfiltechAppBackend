<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCProduct extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'posts';
    protected $primaryKey = 'ID';

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


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    
    public function termTaxonomies(){
        return $this->hasManyThrough(
            TermTaxonomy::class,
            TermRelations::class,
            'object_id',
            'term_taxonomy_id',
            'ID',
            'term_taxonomy_id'
        );
    }

    public function shippingClasses(){
        return $this->termTaxonomies()->where('taxonomy', 'product_shipping_class')->with('term');
    }



    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getShippingClassAttribute()
    {
        // Returnér den første shipping class, hvis den findes
        return $this->shippingClasses->first();
    }


}
