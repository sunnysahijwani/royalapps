<?php

use App\Http\Controllers\AuthorController\AuthorController;
use App\Http\Controllers\BookController\BookController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

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
    return view('auth.login');
});




Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    //dasboard route
    Route::view('dasboard', 'dashboard')->name('dasboard.view');

    // Author Route here 
    Route::get('/listAuthor', [AuthorController::class, 'list'])->name('list.author');
    Route::get("/viewAuthor/{authorId}", [AuthorController::class, 'view'])->name('view.author');
    Route::delete('/deleteAuthor/{authorId}', [AuthorController::class, 'delete'])->name('delete.author');
    Route::post("/searchAuthor", [AuthorController::class, 'search'])->name('search.author');


    // Book Route here
    Route::delete('/deleteBook/{bookId}', [BookController::class, 'delete'])->name('delete.book');
    Route::get('/createBook', [BookController::class, 'create'])->name('create.book');
    Route::post('/storeBook', [BookController::class, 'store'])->name('store.book');
});
