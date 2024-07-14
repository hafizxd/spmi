<?php

use App\Constants\UserRole;
use App\Http\Controllers\Admin\Audits\AuditController;
use App\Http\Controllers\Admin\Audits\CycleController;
use App\Http\Controllers\Admin\Audits\IncompatibilityController;
use App\Http\Controllers\Admin\Audits\StandardController;
use App\Http\Controllers\Admin\Users\UnitJurusanController;
use App\Http\Controllers\Admin\Users\UnitProdiController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\AuditorController;

Route::group(['middleware' => 'auth:' . UserRole::ADMIN, 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('unit-jurusan', UnitJurusanController::class);
        Route::resource('unit-jurusan/{jurusan}/unit-prodi', UnitProdiController::class);
        Route::resource('auditors', AuditorController::class);
    });

    Route::group(['prefix' => 'audits', 'as' => 'audits.'], function () {
        Route::resource('audits', AuditController::class);
        Route::resource('cycles', CycleController::class);
        Route::resource('standards', StandardController::class);
        Route::resource('incompatibilities', IncompatibilityController::class);
    });
});
