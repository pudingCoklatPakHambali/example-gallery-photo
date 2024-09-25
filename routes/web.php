<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GaleriPhotocontroller as GaleriPhoto;
use App\Http\Controllers\User\DashboardController as UserDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //route admin
    Route::get('admin-dashboard',[AdminDashboard::class,'index'])->name("admin-dashboard");
    Route::get('admin-galeri-dashboard',[GaleriPhoto::class,'index'])->name("admin-galeri-dashboard");
    Route::get('admin-create-galeri-photo',[GaleriPhoto::class,'create'])->name("admin-create-galeri-photo");
    Route::POST('admin-store-galeri-photo',[GaleriPhoto::class,'store'])->name("admin-store-galeri-photo");
    Route::get('admin-edit-galeri-photo/{post}',[GaleriPhoto::class,'edit'])->name("admin-edit-galeri-photo");
    //route user
    Route::get('/user-dashboard',[UserDashboard::class, 'index'])->name("user-dashboard");
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
