<?php

use App\Http\Controllers\Admin\AdminUsersController;


Route::prefix("admin")->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/users', AdminUsersController::class);

    Route::view('/', 'admin.index');

    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
});
