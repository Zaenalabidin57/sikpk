<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin');

Route::get('penulis', function () {
    return '<h1>Hello Penulis</h1>';
})->middleware(['auth', 'verified', 'role:penulis']);


Route::get('tulisan', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role:admin|penulis'])
->name('tulisan');

Route::get('proposal', function () {
    return view('proposal');
})->middleware(['auth', 'verified', 'role:admin|penulis'])
->name('proposal');

Route::get('jadwal', function () {
    return view('jadwal');
})->middleware(['auth', 'verified', 'role:admin|penulis'])
->name('jadwal');

require __DIR__.'/auth.php';
