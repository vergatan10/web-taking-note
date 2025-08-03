<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/process-login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/process-register', [AuthController::class, 'registerProcess'])->name('register.process');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomepageController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}', [NoteController::class, 'detail'])->name('notes.detail');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::get('/notes/{note}/delete', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::post('/notes/{note}/comment', [NoteController::class, 'comment'])->name('notes.comment');
    Route::post('/notes/{note}/share', [NoteController::class, 'share'])->name('notes.share');
    Route::post('/notes/{note}/unshare', [NoteController::class, 'unshare'])->name('notes.unshare');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('/update-password', [UserController::class, 'changePassword'])->name('users.password');
    Route::delete('/users/:id', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/users/deactivate', [UserController::class, 'deleteAccount'])->name('users.deactivate');
});

Route::get('/', function () {
    return redirect()->route('home');
});
