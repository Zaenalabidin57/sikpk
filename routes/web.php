<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SubmissionDateController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $proposals = $user->hasRole('admin') ? \App\Models\Proposal::all() : \App\Models\Proposal::where('user_id', $user->id)->get();
    return view('dashboard', compact('proposals'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/proposal', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('/proposal/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::patch('/proposal/{proposal}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('/proposal/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
    Route::patch('/proposal/{proposal}/status', [ProposalController::class, 'updateStatus'])->name('proposals.update-status');
});

Route::get('proposal', function () {
    $submissionDates = \App\Models\Tanggal_Submisi::all();
    return view('proposal', compact('submissionDates'));
})->middleware(['auth', 'verified', 'role:admin|mahasiswa'])->name('proposal');

Route::get('jadwal', function () {
    $submissionDates = \App\Models\Tanggal_Submisi::all();
    return view('jadwal', compact('submissionDates'));
})->middleware(['auth', 'verified', 'role:admin|mahasiswa'])->name('jadwal');

Route::get('buat-akun', function () {
    $users = User::role('mahasiswa')->get();
    return view('buat-akun', compact('users'));
})->middleware(['auth', 'verified', 'role:admin'])->name('buat-akun');

Route::get('buat-jadwal', function () {
    $submissionDates = \App\Models\Tanggal_Submisi::all();
    return view('buat-jadwal', compact('submissionDates'));
})->middleware(['auth', 'verified', 'role:admin'])->name('buat-jadwal');

Route::post('admin/create-mahasiswa', [MahasiswaController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:admin'])->name('admin.create-mahasiswa');

Route::post('admin/create-submission-date', [SubmissionDateController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:admin'])->name('admin.create-submission-date');

Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

Route::delete('/submission-dates/{id}', [SubmissionDateController::class, 'delete'])
    ->middleware(['auth', 'verified', 'role:admin'])->name('submission-dates.delete');

require __DIR__.'/auth.php';
