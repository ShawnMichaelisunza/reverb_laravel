<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('student/', 'index')->name('students');

        Route::get('student/create/', 'create')->name('students.create');
        Route::get('student/store/', 'store')->name('students.store');

        Route::post('student/status/{id}', 'status')->name('students.status');

        Route::get('student/edit/{id}', 'edit')->name('students.edit');
        Route::put('student/update/{id}', 'update')->name('students.update');

        Route::get('student/delete/{id}', 'delete')->name('students.delete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
