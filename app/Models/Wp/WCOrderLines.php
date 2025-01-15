<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCOrderLines extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'woocommerce_order_items';
    protected $primaryKey = 'order_item_id';

    public function order(){
        return $this->belongsTo(WCOrder::class, 'order_id', 'id');
    }

    public function orderLineMeta(){
        return $this->hasMany(WCOrderLineMeta::class, 'order_item_id', 'order_item_id');
    }

    public function product(){
        return $this->hasOne(WCProduct::class, 'ID', 'order_item_id');
    }
}
