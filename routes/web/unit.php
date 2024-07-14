<?php

use App\Constants\UserRole;
use App\Http\Controllers\Unit\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:' . UserRole::AUDITOR, 'prefix' => 'unit', 'as' => 'unit.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
