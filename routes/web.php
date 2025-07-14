<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\RoleManager;
use App\Livewire\Admin\TaskManager;
use App\Livewire\TaskBoard;
use App\Livewire\Admin\PermissionManager;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get('/mailable-test', function () {
//     $task = App\Models\Task::with('user')->latest()->first();
//     return new App\Mail\TaskAssigned($task);
// });

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/my-tasks', TaskBoard::class)->name('user.tasks');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', UserManager::class)->name('admin.users');
    Route::get('/roles', RoleManager::class)->name('admin.roles');
    Route::get('/permissions', PermissionManager::class)->name('admin.permissions');

    Route::get('/tasks', TaskManager::class)->name('admin.tasks');
});

require __DIR__.'/auth.php';
