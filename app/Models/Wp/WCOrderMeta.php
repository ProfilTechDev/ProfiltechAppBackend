<?php

namespace App\Models\Wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WCOrderMeta extends Model
{
    use HasFactory;

    protected $connection = 'wp';
    protected $table = 'wc_orders_meta';

    public function order(){
        return $this->belongsTo(WCOrder::class, 'order_id', 'id');
    }
}
