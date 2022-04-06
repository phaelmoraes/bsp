<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
  //  return view('base');
//});

Route::get('/demo-search', [App\Http\Controllers\SearchController::class, 'index'])->name('teste1');
Route::get('/autocomplete', [App\Http\Controllers\SearchController::class, 'autocomplete'])->name('autocomplete');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/consumers', [App\Http\Controllers\ConsumerController::class, 'index'])->name('consumers');
Route::post('/consumers', [App\Http\Controllers\ConsumerController::class, 'store']);
Route::get('/consumer/{id}', [App\Http\Controllers\ConsumerController::class, 'edit'])->name('consumerEdit');
Route::post('/consumer/edit/{id}', [App\Http\Controllers\ConsumerController::class, 'update'])->name('consumerEditPost');
Route::get('/loan', [App\Http\Controllers\LoanController::class, 'index'])->name('loan');
Route::post('/loan', [App\Http\Controllers\LoanController::class, 'store'])->name('borrow');
Route::get('/loan/{id}', [App\Http\Controllers\LoanController::class, 'show'])->name('showLoan');
Route::get('/loan/edit/{id}', [App\Http\Controllers\LoanController::class, 'edit'])->name('editInstallments');  
Route::get('/loan/cancel/{id}', [App\Http\Controllers\LoanController::class, 'cancel'])->name('cancel');
Route::post('/loan/renegotiate/{id}', [App\Http\Controllers\LoanController::class, 'renegotiate'])->name('renegotiate');
Route::get('/loan/finish/{id}', [App\Http\Controllers\LoanController::class, 'finish'])->name('finish');
Route::get('/collaborators', [App\Http\Controllers\CollaboratorController::class, 'index'])->name('collaborators');
Route::post('/collaborators', [App\Http\Controllers\CollaboratorController::class, 'store']);
Route::get('/balance', [App\Http\Controllers\CollaboratorController::class, 'balance'])->name('balance');
Route::get('/balance/zerar/{id}', [App\Http\Controllers\CollaboratorController::class, 'zerarBalance'])->name('zerarBalance');
Route::post('/AddBalance', [App\Http\Controllers\CollaboratorController::class, 'AddBalance'])->name('AddBalance');
Route::get('/collaborator/{id}', [App\Http\Controllers\CollaboratorController::class, 'edit'])->name('collaboratorEdit');
Route::post('/collaborator/edit/{id}', [App\Http\Controllers\CollaboratorController::class, 'update'])->name('collaboratorEditPost');
Route::post('/region', [App\Http\Controllers\RegionsController::class, 'store']);
Route::get('/region/{id}', [App\Http\Controllers\RegionsController::class, 'edit'])->name('regionEdit');
Route::post('/region/edit/{id}', [App\Http\Controllers\RegionsController::class, 'update'])->name('regionEditPost');



Route::get('/contact/{id}/{consumerId}', [App\Http\Controllers\ContactsController::class, 'delete'])->name('destroy');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
