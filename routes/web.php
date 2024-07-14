<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function() {
    return view('landing-page');
})->name('landing-page');

Route::get('login', [AuthController::class, 'loginIndex'])->name('auth.login.index');
Route::post('login/store', [AuthController::class, 'loginStore'])->name('auth.login.store');

Route::get('register', [AuthController::class, 'registerIndex'])->name('auth.register.index');
Route::post('register/store', [AuthController::class, 'registerStore'])->name('auth.register.store');

Route::middleware('auth')->group(function () {
    Route::get('cycles', [AuthController::class, 'cycleIndex'])->name('auth.cycles.index');
    Route::post('cycles/store', [AuthController::class, 'cycleStore'])->name('auth.cycles.store');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

require __DIR__ . '/web/admin.php';
require __DIR__ . '/web/auditor.php';
require __DIR__ . '/web/unit.php';

use App\Http\Controllers\Resource\ResourceController;

Route::group(['prefix' => 'resources', 'as' => 'resource.'], function () {
    Route::get('prodi', [ResourceController::class, 'getProdi'])->name('prodi.index');
    Route::get('auditors', [ResourceController::class, 'getAuditor'])->name('auditors.index');
});