<?php

use App\Constants\UserRole;
use App\Http\Controllers\Admin\Audits\AuditController;
use App\Http\Controllers\Admin\Audits\CycleController;
use App\Http\Controllers\Admin\Audits\IncompatibilityController;
use App\Http\Controllers\Admin\Audits\StandardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\Users\AdminController;
use App\Http\Controllers\Admin\Users\UnitJurusanController;
use App\Http\Controllers\Admin\Users\UnitProdiController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\AuditorController;
use App\Http\Controllers\Admin\Audits\ProsesAuditController;

Route::group(['middleware' => 'auth:' . UserRole::ADMIN, 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'proses-audits', 'as' => 'proses_audits.'], function () {
        Route::get('/', [ProsesAuditController::class, 'index'])->name('index');
        
        Route::group(['prefix' => '{id}'], function () {
            Route::get('mechanisms', [ProsesAuditController::class, 'indexMechanism'])->name('mechanisms.index');
            Route::get('audit-standards', [ProsesAuditController::class, 'indexAuditStandard'])->name('audit_standards.index');
            Route::get('conclusions', [ProsesAuditController::class, 'indexConclusion'])->name('conclusions.index');
        });
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('unit-jurusan', UnitJurusanController::class);
        Route::resource('unit-jurusan/{jurusan}/unit-prodi', UnitProdiController::class);
        Route::resource('auditors', AuditorController::class);
        Route::resource('admins', AdminController::class);
    });

    Route::group(['prefix' => 'audits', 'as' => 'audits.'], function () {
        Route::resource('audits', AuditController::class);
        Route::resource('cycles', CycleController::class);
        Route::resource('standards', StandardController::class);
        Route::resource('incompatibilities', IncompatibilityController::class);
    });

    Route::resource('{type}/files', FileController::class);
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');
});
