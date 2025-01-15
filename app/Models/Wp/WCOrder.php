<?php

namespace App\Models\Wp;

use App\Models\ExternalShipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCOrder extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'wc_orders';
    protected $with = ['orderLines', 'orderMeta'];

    public function orderLines(){
        return $this->hasMany(WCOrderLines::class, 'order_id', 'id')->where('order_item_type', 'line_item');
    }

    public function orderMeta(){
        return $this->hasMany(WCOrderMeta::class, 'order_id', 'id');
    }

    public function scopeSpecialOrder($query){
        return $query->whereHas('orderLines.orderLineMeta', function($query){
            $query->where('meta_key', '_measurement_data');
        });
    }

    // public function externalShipping(){
    //     return $this->belongsTo(ExternalShipping::class);
    // }


    /**
     * Scope a query to only include orders that require external shipping.
     *
     * This function filters the query to orders that have order lines with products
     * belonging to specific shipping classes. The shipping classes considered for
     * external shipping are identified by their term taxonomy IDs:
     * - 23: Mindre pakker (Smaller packages)
     * - 22: Større pakker (Larger packages)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterExternalShipping($query){
        return $query
            ->whereHas('orderLines.product.shippingClasses', function($query){
            $query->whereIn('term_taxonomy.term_taxonomy_id', [
                23, // Mindre pakker
                22, // Større pakker
            ]);
        });
    }

}
