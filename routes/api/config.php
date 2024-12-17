<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("v1/")
    ->middleware('auth:sanctum')
    ->name('api.v1.')
    ->group(function () {
    include_once "v1.php";
});
