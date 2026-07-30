<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Trainers
Route::middleware(['auth', 'department:trainers'])->group(function () {
    Route::patch('/trainers/{trainer}/status', [TrainerController::class, 'updateStatus'])->name('trainers.updateStatus');
    Route::get('/trainers/specialties', [TrainerController::class, 'specialties'])->name('trainers.specialties');
    Route::post('/trainers/specialties', [TrainerController::class, 'createSpecialty'])->name('trainers.createSpecialty');
    Route::put('/trainers/specialties/{specialty}', [TrainerController::class, 'editSpecialties'])->name('trainers.editSpecialties');
    Route::delete('/trainers/specialties/{specialty}', [TrainerController::class, 'deleteSpecialties'])->name('trainers.deleteSpecialties');
    Route::resource('trainers', TrainerController::class);
});

//Members
Route::middleware(['auth', 'department:members'])->group(function () {
    Route::resource('members', MemberController::class);
});

//Branches
Route::middleware(['auth', 'department:branches'])->group(function () {
    Route::get('/branches', function () {
        return view('branches.index');
    })->name('branches');
});

//Classes
Route::middleware(['auth', 'department:workouts'])->group(function () {
    Route::get('/workouts', function () {
        return view('workouts.index');
    })->name('workouts');
});

//Warehouses
Route::middleware(['auth', 'department:warehouses'])->group(function () {
    Route::get('/warehouses', function () {
        return view('warehouses.index');
    })->name('warehouses');
});

//Login and Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');








// Route::middleware(['auth', 'department'])->group(function() {
//     Route::get('/dashboard', function () {
//     return view('dashboard');
//     })->name('dashboard');

//     // Trainer routes
//     Route::patch('/trainers/{trainer}/status', [TrainerController::class, 'updateStatus'])->name('trainers.updateStatus')->defaults('department', 'trainers');
//     Route::resource('trainers', TrainerController::class)->defaults('department', 'trainers');

//     // Member routes
//     Route::get('/members/create', [MemberController::class, 'create']);
//     Route::post('/members', [MemberController::class, 'store']);
//     Route::get('/members', [MemberController::class, 'index'])->name('members.index');
//     Route::delete('/members/{id}', [MemberController::class, 'destroy']);
//     Route::get('/members/{id}/edit', [MemberController::class, 'edit']);
//     Route::put('/members/{id}', [MemberController::class, 'update']);

//     //branches
//     Route::get('/branches', function () {
//         return view('branches.index');
//     })->name('branches');

//     //classes
//     Route::get('/classes', function () {
//         return view('classes.index');
//     })->name('classes');

//     //warehouses
//     Route::get('/warehouses', function () {
//         return view('warehouses.index');
//     })->name('warehouses');
// });

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.post');



// routes/web.php
// Route::get('/upload-test', function () {
//     return [
//         'loaded_ini_file' => php_ini_loaded_file(),
//         'scanned_ini_files' => php_ini_scanned_files(),
//         'tmp_dir' => sys_get_temp_dir(),
//         'writable' => is_writable(sys_get_temp_dir()),
//         'upload_tmp_dir_ini' => ini_get('upload_tmp_dir'),
//         'post_max_size' => ini_get('post_max_size'),
//         'upload_max_filesize' => ini_get('upload_max_filesize'),
//     ];
// });
