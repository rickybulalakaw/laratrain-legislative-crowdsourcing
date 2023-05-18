<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

/*
index - show all 
show - show one 
create - show form to create  new 
store - store new 
edit - show form to edit one 
update - save new data of edited 
destroy - delete one 
*/

Route::delete('/delete/{bill}', [BillController::class, 'delete'])->name('delete-bill');
Route::post('/like/{bill}', [BillController::class, 'likeBill'])->name('like-bill');
Route::delete('/delete/{bill}', [BillController::class, 'destroy'])->name('delete-bill');
Route::post('/download-bill/{bill}', [BillController::class, 'downloadBill'])->name('download-bill');
Route::post('/add-comment', [BillController::class, 'addComment'])->name('add-comment');
Route::get('/edit/{bill}', [BillController::class, 'edit'])->name('edit-bill')->middleware(['password.confirm']);
Route::put('/edit/{bill}', [BillController::class, 'update']);

Route::get('/show/{bill}', [BillController::class, 'show'])->name('show-bill');
Route::get('/', [BillController::class, 'index'])->name('home');
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
