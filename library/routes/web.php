<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

 Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route Catalog
// Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
// Route::get('/catalogs/create', [CatalogController::class, 'create'])->name('catalogs.create');
// Route::post('/catalogs', [CatalogController::class, 'store'])->name('catalogs.store');
// Route::get('/catalogs/{catalog}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit');
// Route::put('/catalogs/{catalog}', [CatalogController::class, 'update'])->name('catalogs.update');
// Route::delete('catalogs/{catalog}', [CatalogController::class, 'destroy'])->name('catalogs.delete');
Route::resource('catalogs', CatalogController::class)->except([
    'show'
]);

// Route Author
// Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
Route::resource('authors', AuthorController::class)->except([
    'show', 'create', 'edit'
]);

// Route Api Author
Route::get('/api/authors', [AuthorController::class, 'api'])->name('api.authors');


// Route Publisher
// Route::get('/publishers', [PublisherController::class, 'index'])->name('publisher.index');
Route::resource('publishers', PublisherController::class)->except([
    'show', 'create', 'edit'
]);

// Route Api Author
Route::get('/api/publishers', [PublisherController::class, 'api'])->name('api.publishers');


// Route Member
// Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::resource('members', MemberController::class)->except([
    'show', 'create', 'edit'
]);

// Route Api Member
Route::get('/api/members', [MemberController::class, 'api'])->name('api.members');


// Route Book
// Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::resource('books', BookController::class)->except([
    'show', 'create', 'edit'
])->middleware('auth');

// Route Api Book
Route::get('/api/books', [BookController::class, 'api'])->name('api.books')->middleware('auth');


// Route Transaction Details
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::resource('transactions', TransactionController::class)->middleware('auth');
Route::get('/api/transactions', [TransactionController::class, 'api'])->name('api.transactions')->middleware('auth');

// Route Admin
Route::get('catalogs', [AdminController::class, 'catalog'])->name('catalogs.index');
Route::get('members', [AdminController::class, 'member'])->name('members.index');
Route::get('publishers', [AdminController::class, 'publisher'])->name('publishers.index');
Route::get('authors', [AdminController::class, 'author'])->name('authors.index');
Route::get('books', [AdminController::class, 'book'])->name('books.index');
Route::get('transactions', [AdminController::class, 'transaction'])->name('transactions.index');
Route::get('Graphics', [App\Http\Controllers\AdminController::class, 'dashboard']);

Route::get('/home/test_spatie', [App\Http\Controllers\AdminController::class, 'test_spatie']);