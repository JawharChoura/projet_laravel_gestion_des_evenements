<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

Route::redirect('/', '/events');

Route::get('/image/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    abort_unless(file_exists($fullPath), 404);
    return response()->file($fullPath);
})->where('path', '.*');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', fn() => view('profile'))->name('profile');
    
    Route::prefix('events/{event}')->group(function () {
        Route::post('/register', [RegistrationController::class, 'register'])->name('registrations.register');
        Route::post('/unregister', [RegistrationController::class, 'unregister'])->name('registrations.unregister');
    });
    
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])->name('user.registrations');
    
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/events', [AdminController::class, 'events'])->name('admin.events.index');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        
        Route::resource('categories', CategoryController::class)->except(['show']);
        
        Route::get('/registrations', [RegistrationController::class, 'allRegistrations'])->name('registrations.index');
    });
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
