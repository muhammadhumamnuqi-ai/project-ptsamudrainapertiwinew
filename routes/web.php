<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbkController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\McuController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DokumenPelautController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\KeberangkatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Models\Notification;

// Public Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'handlelogin']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'handleregister']);
});

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Auth protected routes
Route::middleware('auth')->group(function () {
    
    // Redirect to correct dashboard based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notification mark as read
    Route::post('/notification/read/{id}', function ($id) {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
        $notification->status_baca = true;
        $notification->save();
        return back();
    })->name('notification.read');

    // ABK Candidate Group
    Route::middleware('role:abk')->group(function () {
        Route::get('/dashboard/abk', [DashboardController::class, 'abk'])->name('dashboard.abk');
        Route::post('/profile/update', [AbkController::class, 'updateProfile'])->name('profile.update');
        Route::post('/dokumen/upload', [DokumenController::class, 'upload'])->name('dokumen.upload');
        Route::post('/mcu/upload', [McuController::class, 'upload'])->name('mcu.upload');
        Route::post('/dokumen-pelaut/upload', [DokumenPelautController::class, 'upload'])->name('dokumen_pelaut.upload');
    });

    // Operator & Admin Shared Group
    Route::middleware('role:operator|super_admin')->group(function () {
        Route::get('/dashboard/operator', [DashboardController::class, 'operator'])->name('dashboard.operator');
        Route::get('/operator/abk/{id}', [AbkController::class, 'show'])->name('operator.abk.show');
        Route::post('/operator/abk/{id}/status', [AbkController::class, 'updateStage'])->name('operator.abk.update_stage');
        
        // Verifications
        Route::post('/operator/dokumen/{id}/verify', [DokumenController::class, 'verify'])->name('operator.dokumen.verify');
        Route::post('/operator/mcu/{id}/verify', [McuController::class, 'verify'])->name('operator.mcu.verify');
        Route::post('/operator/diklat/{id}/schedule', [DiklatController::class, 'schedule'])->name('operator.diklat.schedule');
        Route::post('/operator/diklat/{id}/verify', [DiklatController::class, 'verify'])->name('operator.diklat.verify');
        Route::post('/operator/dokumen-pelaut/{id}/verify', [DokumenPelautController::class, 'verify'])->name('operator.dokumen_pelaut.verify');
        Route::post('/operator/job/{id}/assign', [JobOrderController::class, 'assign'])->name('operator.job.assign');
        Route::post('/operator/keberangkatan/{id}/save', [KeberangkatanController::class, 'save'])->name('operator.keberangkatan.save');

        // Reports
        Route::get('/reports/export/csv', [ReportController::class, 'exportCsv'])->name('reports.export.csv');
        Route::get('/reports/export/pdf', [ReportController::class, 'printPdf'])->name('reports.export.pdf');
    });

    // Super Admin Group
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
        
        // User CRUD
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
        
        // System logs
        Route::get('/admin/logs', [AdminController::class, 'logs'])->name('admin.logs');
    });
});