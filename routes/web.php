<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WaitListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'contact-us', 'as' => 'contact.'], function(){
    Route::post('/',[ContactController::class,'message'])->name('send_mail');
});

Route::group(['prefix' => 'waitlist', 'as' =>'waitlist.'], function(){
    Route::post('/add',[WaitListController::class,'store'])->name('add_waitlist');
    Route::get('/waitlist_verification',[WaitListController::class,'loadVerificationPage'])->name('verification_page');
    Route::post('/confirm',[WaitListController::class,'confirm'])->name('confirm_waitlist');
});

Route::get('/', function () {
    return view('index_v2');
})->name('welcome');
