<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WCOrderLineMeta extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'woocommerce_order_itemmeta';

    public function orderLine(){
        return $this->belongsTo(WCOrderLines::class, 'order_item_id', 'order_item_id');
    }

    public function product(){
        return $this->hasOne(WCProduct::class, 'ID', 'meta_value');
    }
}
