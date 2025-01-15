<?php

namespace App\Http\Controllers;

use App\Models\Wp\WCOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        return WCOrder::with('orderLines', 'OrderMeta')->paginate($this->limit);
    }

    public function order(Request $request, $id)
    {
        return WCOrder::with('orderLines', 'OrderMeta')->find($id);
    }

    public function externalShippingOrders(){
        $test = WCOrder::filterExternalShipping()->get();
        return $test;
    }
}
