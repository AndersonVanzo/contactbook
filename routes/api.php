<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;


Route::middleware('api')->group(function() {
    Route::resource('contatos', ContatoController::class);
});