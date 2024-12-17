<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Request;

abstract class ApiController extends Controller
{
    protected int $limit;

    public function __construct()
    {
        $this->limit = (int) request()->query('limit', 20);
    }
}
