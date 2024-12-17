<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\TestData;
use Illuminate\Http\Request;

class TestDataController extends ApiController
{
    public function getTestData(){
        $test = TestData::with('relation')->paginate($this->limit);
        return response()->json(
            $test
        );
    }


}
