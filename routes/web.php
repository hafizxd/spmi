<?php
use App\Http\Controllers\ProfileController;
use App\Models\Audit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function() {
    return view('landing-page');
})->name('landing-page');

Route::get('login/{userRole}', [AuthController::class, 'loginIndex'])->name('auth.login.index');
Route::post('login/{userRole}/store', [AuthController::class, 'loginStore'])->name('auth.login.store');

Route::get('cycles', [AuthController::class, 'cycleIndex'])->name('auth.cycles.index');
Route::post('cycles/store', [AuthController::class, 'cycleStore'])->name('auth.cycles.store');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(['prefix' => 'profile', 'as' => 'profiles.', 'controller' => ProfileController::class], function() {
        Route::get('/', 'index')->name('index');
        Route::put('update', 'update')->name('update');
        Route::get('reset-password', 'passwordIndex')->name('password.index');
        Route::put('reset-password/update', 'passwordUpdate')->name('password.update');
    }); 

    Route::get('audits/{id}/print', function ($id) {
        $audit = Audit::where('is_done', true)->findOrFail($id);

        $pdf = PDF::loadView('export.lap-audit', compact('audit'));
        return $pdf->download('lap-audit-'.time().'.pdf');
    })->name('audits.print');
});

require __DIR__ . '/web/admin.php';
require __DIR__ . '/web/auditor.php';
require __DIR__ . '/web/unit.php';

use App\Http\Controllers\Resource\ResourceController;

Route::group(['prefix' => 'resources', 'as' => 'resource.'], function () {
    Route::get('prodi', [ResourceController::class, 'getProdi'])->name('prodi.index');
    Route::get('auditors', [ResourceController::class, 'getAuditor'])->name('auditors.index');
});