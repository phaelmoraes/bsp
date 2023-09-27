<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'homeCompact'])->name('home');
// Route::get('/register', [App\Http\Controllers\HomeController::class, 'homeCompact'])->name('home');

Route::get('/homeComplete', [App\Http\Controllers\HomeController::class, 'index'])->name('homeComplete')->middleware('auth');
Route::get('/consumers', [App\Http\Controllers\ConsumerController::class, 'index'])->name('consumers')->middleware('auth');
Route::post('/consumers', [App\Http\Controllers\ConsumerController::class, 'store'])->middleware('auth');
Route::get('/consumer/{id}', [App\Http\Controllers\ConsumerController::class, 'edit'])->name('consumerEdit')->middleware('auth');
Route::post('/consumer/edit/{id}', [App\Http\Controllers\ConsumerController::class, 'update'])->name('consumerEditPost')->middleware('auth');
Route::get('/spend', [App\Http\Controllers\ConsumerController::class, 'spend'])->name('spend')->middleware('auth');
Route::post('/spend', [App\Http\Controllers\ConsumerController::class, 'spendAdd'])->name('spendAdd')->middleware('auth');
Route::get('/spend/accepted/{id}', [App\Http\Controllers\ConsumerController::class, 'accepted'])->name('accepted')->middleware('auth');
Route::get('/spend/denied/{id}', [App\Http\Controllers\ConsumerController::class, 'denied'])->name('denied')->middleware('auth');
Route::get('/loan', [App\Http\Controllers\LoanController::class, 'index'])->name('loan')->middleware('auth');
Route::post('/loan', [App\Http\Controllers\LoanController::class, 'store'])->name('borrow')->middleware('auth');
Route::get('/loan/{id}', [App\Http\Controllers\LoanController::class, 'show'])->name('showLoan')->middleware('auth');
Route::get('/loan/edit/{id}', [App\Http\Controllers\LoanController::class, 'edit'])->name('editInstallments')->middleware('auth');  
Route::get('/loan/cancel/{id}', [App\Http\Controllers\LoanController::class, 'cancel'])->name('cancel')->middleware('auth');
Route::post('/loan/renegotiate/{id}', [App\Http\Controllers\LoanController::class, 'renegotiate'])->name('renegotiate')->middleware('auth');
Route::get('/loan/finish/{id}', [App\Http\Controllers\LoanController::class, 'finish'])->name('finish')->middleware('auth');
Route::get('/collaborators', [App\Http\Controllers\CollaboratorController::class, 'index'])->name('collaborators')->middleware('auth');
Route::post('/collaborators', [App\Http\Controllers\CollaboratorController::class, 'store'])->middleware('auth');
Route::get('/balance', [App\Http\Controllers\CollaboratorController::class, 'balance'])->name('balance')->middleware('auth');
Route::get('/balance/zerar/{id}', [App\Http\Controllers\CollaboratorController::class, 'zerarBalance'])->name('zerarBalance')->middleware('auth');
Route::post('/AddBalance', [App\Http\Controllers\CollaboratorController::class, 'AddBalance'])->name('AddBalance')->middleware('auth');
Route::get('/collaborator/{id}', [App\Http\Controllers\CollaboratorController::class, 'edit'])->name('collaboratorEdit')->middleware('auth');
Route::post('/collaborator/edit/{id}', [App\Http\Controllers\CollaboratorController::class, 'update'])->name('collaboratorEditPost')->middleware('auth');
Route::post('/region', [App\Http\Controllers\RegionsController::class, 'store'])->middleware('auth');
Route::get('/region/{id}', [App\Http\Controllers\RegionsController::class, 'edit'])->name('regionEdit')->middleware('auth');
Route::post('/region/edit/{id}', [App\Http\Controllers\RegionsController::class, 'update'])->name('regionEditPost')->middleware('auth');

Route::get('/inspection', [App\Http\Controllers\InspectionController::class, 'index'])->name('inspection')->middleware('auth');
Route::get('/inspection/week', [App\Http\Controllers\InspectionController::class, 'week'])->name('week')->middleware('auth');
Route::get('/inspection/month', [App\Http\Controllers\InspectionController::class, 'month'])->name('month')->middleware('auth');
Route::get('/inspection/year', [App\Http\Controllers\InspectionController::class, 'year'])->name('year')->middleware('auth');


Route::get('/contact/{id}/{consumerId}', [App\Http\Controllers\ContactsController::class, 'delete'])->name('destroy')->middleware('auth');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
