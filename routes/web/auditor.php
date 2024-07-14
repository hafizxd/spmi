<?php

use App\Constants\UserRole;
use App\Http\Controllers\Auditor\DashboardController;
use App\Http\Controllers\Auditor\AuditController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:' . UserRole::AUDITOR, 'prefix' => 'auditor', 'as' => 'auditor.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'audits', 'as' => 'audits.'], function () {
        Route::get('/', [AuditController::class, 'index']);
    });
});
