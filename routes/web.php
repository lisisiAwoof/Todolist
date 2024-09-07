<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use Illuminate\Support\Facades\Auth;

// Note to self: Ini untuk mengarahkan user ke halaman awal ketika membuka app (root URL '/')
//               laravel mencari file dgn nama 'login.blade.php' untuk ditampilkan ke user
Route::get('/', function () {
    return view('auth/login');
});

// Note to self: Semua fungsi disini dilindungi dua middleware ('auth' dan 'verified'), ya buat mastiin user aja
//               Routenya untuk mengarahkan user ke dashboard (disini dashboardnya aku ganti sbg halaman todolist)
//               baru bisa akses dashboard kalau user berhasil login
//               dashboard -> nama rute yg manggil fungsi 'index' dari TodolistController buat nampilin halaman dashboard
//               tasks.store -> nama rute yg manggil fungsi 'store' dari TodolistController buat nyimpan data tugas baru
//               tasks.updateStatus -> nama rute yg manggil fungsi 'updateStatus' dari TodolistController buat ganti status tugas (0/1)
//               tasks.destroy -> nama rute yg manggil fungsi 'destroy' dari TodolistController buat hapus data tugas
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TodolistController::class, 'index'])->name('dashboard');
    Route::post('/tasks', [TodolistController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task_id}', [TodolistController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::delete('/tasks/{task_id}', [TodolistController::class, 'destroy'])->name('tasks.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
