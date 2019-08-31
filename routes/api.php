<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tab API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tab. These routes
| are loaded by the ServiceProvider of your tab. They will only be
| loaded when your application is in debug mode. Now, go build!
|
*/

Route::post('search', \StefanBauer\LaracastsTab\Http\Controllers\TabController::class . '@search');
