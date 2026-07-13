<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Trainer routes
Route::patch('/trainers/{trainer}/status', [TrainerController::class, 'updateStatus'])->name('trainers.updateStatus');
Route::resource('trainers', TrainerController::class);

// Member routes
Route::get('/members/create', [MemberController::class, 'create']);
Route::post('/members', [MemberController::class, 'store']);
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::delete('/members/{id}', [MemberController::class, 'destroy']);
Route::get('/members/{id}/edit', [MemberController::class, 'edit']);
Route::put('/members/{id}', [MemberController::class, 'update']);


// routes/web.php
Route::get('/upload-test', function () {
    return [
        'loaded_ini_file' => php_ini_loaded_file(),
        'scanned_ini_files' => php_ini_scanned_files(),
        'tmp_dir' => sys_get_temp_dir(),
        'writable' => is_writable(sys_get_temp_dir()),
        'upload_tmp_dir_ini' => ini_get('upload_tmp_dir'),
        'post_max_size' => ini_get('post_max_size'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
    ];
});
