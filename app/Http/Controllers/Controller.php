<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected int $limit;

    public function __construct()
    {
        $this->limit = (int) request()->query('limit', 20);
    }
}
