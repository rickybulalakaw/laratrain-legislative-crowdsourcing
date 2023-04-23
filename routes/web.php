<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

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

/*
index - show all 
show - show one 
create - show form to create  new 
store - store new 
edit - show form to edit one 
update - save new data of edited 
destroy - delete one 
*/


Route::post('/add-comment', [BillController::class, 'addComment'])->name('add-comment');
Route::get('/edit/{bill}', [BillController::class, 'edit'])->name('edit-bill');
Route::post('/edit/{bill}', [BillController::class, 'update']);

Route::get('/show/{bill}', [BillController::class, 'show'])->name('show-bill');
Route::get('/', [BillController::class, 'index'])->name('bills');
// Route::post('/like', [BillController::class, 'store'])->name('like');
Route::get('/add-bill', [BillController::class, 'create'])->name('add-bill');
Route::post('/add-bill', [BillController::class, 'store']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
