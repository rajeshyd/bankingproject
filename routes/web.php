<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 Route::get('/', function () {
    return view('welcome');
 });
Route::get('/testview', function () {
    return view('test');
});
Route::get('/testview', function () {
    return view('test');
});


// Route::post('deposit', [BankController::class, 'deposit']);
// Route::post('withdraw', [BankController::class, 'withdraw']);
// Route::post('transfer', [BankController::class, 'transfer']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('statement', [BankController::class, 'statementreport']);

    Route::get('/withdraw', function () {
        return view('withdraw');
    });

    Route::get('/transfer', function () {
        return view('transfer');
    });
    Route::get('/deposit', function () {
        return view('deposit');
    });

Route::post('deposit', [BankController::class, 'deposit']);
Route::post('withdraw', [BankController::class, 'withdraw']);
Route::post('transfer', [BankController::class, 'transfer']);

});

 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
 ])->group(function () {

    Route::get('home', [BankController::class, 'home']);




 });
