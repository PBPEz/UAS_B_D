<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/email/verify/{id}', [App\Http\Controllers\Api\AuthController::class, 'verify'])
// ->middleware(['auth', 'signed'])->name('verification.verify');

Auth::routes([
    'verify' => true
]);

Route::get('/email/verify/need-verification', [App\Http\Controllers\Api\VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}', [App\Http\Controllers\Api\VerificationController::class, 'verify'])->name('verification.verify');
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::middleware('auth:api')->post('logout', 'Api\AuthController@logout');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('barang', 'Api\BarangController@index');
    Route::get('barang/{id}', 'Api\BarangController@show');
    Route::post('barang', 'Api\BarangController@store');
    Route::put('barang/{id}', 'Api\BarangController@update');
    Route::delete('barang/{id}', 'Api\BarangController@destroy');
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', 'Api\UserController@index');
    Route::get('user{id}', 'Api\UserController@show');
    Route::put('user/{id}', 'Api\UserController@update');
    Route::delete('user/{id}', 'Api\UserController@destroy');
}); 

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('keranjang', 'Api\KeranjangController@index');
    Route::get('keranjang/{id}', 'Api\KeranjangController@show');
    Route::post('keranjang', 'Api\KeranjangController@store');
    Route::put('keranjang/{id}', 'Api\KeranjangController@update');
    Route::delete('keranjang/{id}', 'Api\KeranjangController@destroy');
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('membership', 'Api\MembershipController@index');
    Route::get('membership/{id}', 'Api\MembershipController@show');
    Route::post('membership', 'Api\MembershipController@store');
    Route::put('membership/{id}', 'Api\MembershipController@update');
    Route::delete('membership/{id}', 'Api\MembershipController@destroy');
});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');
 
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');