<?php

namespace App\Http\Controllers;

use App\Models\AppNotificationSettings;
use App\Models\EmailNotificationSettings;
use App\Models\Wp\WCProduct;
use Illuminate\Http\Request;
use Log;

class UserController extends Controller
{
    public function getAuthenticatedUser(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();
            $user->update($request->all());
            return $user;
        } catch (\Throwable $th) {
            Log::error('User update failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'User update failed!'], 500);
        }
    }


    public function test(){
        $product = WCProduct::with('shippingClasses')->find(520);
        $test = $product->shippingClass;
    }
}
