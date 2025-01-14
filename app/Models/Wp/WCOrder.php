<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCOrder extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'wc_orders';

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

    public function scopeExternalShipping($query){
        return $query->whereHas('orderLines', function($query){
            $query->whereHas('product', function($query){
                $query->whereHas('productMeta', function($query){
                    $query->where('external_shipping', 1);
                });
            });
        });
    }

}
