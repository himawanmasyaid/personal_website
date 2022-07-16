<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the App/RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// bungkus dulu, biar rapi. dan fungsi namespace biar gapakek nulis admin lagi
Route::prefix('admin')
    ->namespace('Admin')
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // register route, (name label, controller)
        Route::resource('works', 'WorkController');

    });