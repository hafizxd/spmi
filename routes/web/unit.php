<?php

use App\Constants\UserRole;
use App\Http\Controllers\Unit\AuditController;
use App\Http\Controllers\Unit\DashboardController;
use App\Http\Controllers\Unit\FileController;
use App\Http\Controllers\Unit\StandardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:' . UserRole::UNIT_JURUSAN . ',' . UserRole::UNIT_PRODI, 'prefix' => 'unit', 'as' => 'unit.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'audits', 'as' => 'audits.'], function () {
        Route::get('/', [AuditController::class, 'index'])->name('index');
        
        Route::group(['prefix' => '{id}'], function () {
            Route::get('mechanisms', [AuditController::class, 'indexMechanism'])->name('mechanisms.index');
            Route::get('audit-standards', [AuditController::class, 'indexAuditStandard'])->name('audit_standards.index');
            Route::get('audit-standards/{auditStandardId}', [AuditController::class, 'showAuditStandard'])->name('audit_standards.show');
            Route::get('conclusions', [AuditController::class, 'indexConclusion'])->name('conclusions.index');
            
            Route::put('lock', [AuditController::class, 'lock'])->name('lock');
            Route::get('print', [AuditController::class, 'print'])->name('print');
        });
    });

    Route::get('standards', [StandardController::class, 'index'])->name('standards.index');
    Route::get('standards/{id}/detail', [StandardController::class, 'detail'])->name('standards.show');
    Route::get('standards/{id}/edit', [StandardController::class, 'edit'])->name('standards.edit');
    Route::put('standards/{id}/update', [StandardController::class, 'update'])->name('standards.update');

    Route::get('files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('files/store', [FileController::class, 'store'])->name('files.store');
});
