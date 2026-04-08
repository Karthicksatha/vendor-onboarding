<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admin\VendorReviewController;
use App\Http\Controllers\ReportController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Vendor Application Routes (User)
    |--------------------------------------------------------------------------
    */

    Route::resource('vendors', VendorController::class);

    // Submit application for admin review
    Route::post(
        '/vendors/{id}/submit',
        [VendorController::class, 'submit']
    )->name('vendors.submit');

    // Status history
    Route::get(
        '/vendors/{id}/history',
        [VendorController::class, 'history']
    )->name('vendors.history');


    /*
    |--------------------------------------------------------------------------
    | Admin Vendor Review
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->middleware('admin')
        ->name('admin.')
        ->group(function () {

            Route::post(
                '/vendors/{id}/approve',
                [VendorReviewController::class, 'approve']
            )->name('vendors.approve');

            Route::post(
                '/vendors/{id}/reject',
                [VendorReviewController::class, 'reject']
            )->name('vendors.reject');

            Route::post(
                '/vendors/{id}/send-back',
                [VendorReviewController::class, 'sendBack']
            )->name('vendors.sendBack');
        });

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
});


require __DIR__ . '/auth.php';
