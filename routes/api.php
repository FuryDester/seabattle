<?php

use Illuminate\Support\Facades\Route;

Route::fallback(static function () {
    // TODO Change to enum
    return response()->json([
        'success' => false,
        'error' => 'not_found',
    ]);
});
