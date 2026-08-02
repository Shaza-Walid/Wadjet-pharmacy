<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'Wadjet API is working (now running as MVC)']);
});
