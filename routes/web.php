<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{StudentController as SC,TuitionController as TC,UserController as UC,PaymentController as PC,ClassController as CC,MutationController as MC};

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('student',SC::class);
    Route::resource('mutation',MC::class);
    Route::resource('payment',PC::class);
    Route::resource('tuition',TC::class);
    Route::resource('user',UC::class);
    Route::resource('class',CC::class);
    Route::get('/history',[SC::class,'create']);
});

