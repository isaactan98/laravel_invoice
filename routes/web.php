<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::get('/profile', [ProfileController::class, 'index'])->middleware(['verified'])->name('profile');
// Route::post('/profile', [ProfileController::class, 'update'])->middleware(['verified']);
// Route::get('/editProfile', [ProfileController::class, 'edit'])->middleware(['verified'])->name('edit_profile');

Route::match(['get', 'post'], '/profile', [ProfileController::class, 'view'])->name('profile');

Route::get('/profile_img', function () {
    return view('profile.image');
})->name('profile_image');

Route::get('/invoice/old/add', [InvoiceController::class, 'create'])->middleware(['auth'])->name('add_old_invoice');
Route::post('/invoice', [InvoiceController::class, 'store'])->middleware(['auth'])->name('invoice');
Route::get('/invoice/all', [InvoiceController::class, 'index'])->middleware(['auth'])->name('invHistory');
Route::get('/invoice/show/old/{id}', [InvoiceController::class, 'show']);
Route::get('/delete/{id}', [InvoiceController::class, 'destroy']);

Route::match(['get', 'post'], '/invoice/add', [InvoiceController::class, 'add'])->name('add_invoice');
Route::match(['get', 'post'], '/invoice/edit/{id}', [InvoiceController::class, 'edit'])->name('edit_invoice');
Route::match(['get', 'post'], '/invoice/view/{id}', [InvoiceController::class, 'view_invoice'])->name('view_invoice');

require __DIR__ . '/auth.php';
