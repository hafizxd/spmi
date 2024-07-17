<?php

use App\Constants\UserRole;
use App\Http\Controllers\Auditor\AuditStandardController;
use App\Http\Controllers\Auditor\ConclusionController;
use App\Http\Controllers\Auditor\DashboardController;
use App\Http\Controllers\Auditor\AuditController;
use App\Http\Controllers\Auditor\MechanismController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:' . UserRole::AUDITOR, 'prefix' => 'auditor', 'as' => 'auditor.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'audits', 'as' => 'audits.'], function () {
        Route::get('/', [AuditController::class, 'index'])->name('index');
        Route::post('store', [AuditController::class, 'store'])->name('store');
        
        Route::group(['prefix' => '{id}'], function () {
            Route::group(['prefix' => 'mechanisms', 'as' => 'mechanisms.'], function () {
                Route::get('/', [MechanismController::class, 'index'])->name('index');
                Route::post('store', [MechanismController::class, 'store'])->name('store');
                Route::post('save', [MechanismController::class, 'save'])->name('save');
                Route::delete('{mechanismId}/delete', [MechanismController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'audit-standards', 'as' => 'audit_standards.'], function () {
                Route::get('/', [AuditStandardController::class, 'index'])->name('index');
                Route::post('save', [AuditStandardController::class, 'save'])->name('save');
                Route::get('{auditStandardId}/edit', [AuditStandardController::class, 'edit'])->name('edit');
                Route::put('{auditStandardId}/update', [AuditStandardController::class, 'update'])->name('update');
            });

            Route::group(['prefix' => 'conclusions', 'as' => 'conclusions.'], function () {
                Route::get('/', [ConclusionController::class, 'index'])->name('index');
                Route::post('/update', [ConclusionController::class, 'update'])->name('update');
            });

            Route::get('/rtm', [AuditController::class, 'rtmIndex'])->name('rtm.index');
            Route::put('/rtm/update', [AuditController::class, 'rtmUpdate'])->name('rtm.update');
        });
    });
});
