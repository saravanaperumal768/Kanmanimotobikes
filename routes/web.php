<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salesFormController;
// use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FormDataController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->name('index');

// Route::post('/form/store', 'ContactFormController@store')->name('contact.store');
Route::post('/form/store', [FormDataController::class, 'store'])->name('contact.store');
