<?php

use App\Http\Controllers\api\utsSaitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('uts-sait')->group(function () {
    Route::get('/get-data-mahasiswa', [utsSaitController::class, 'index']);
    Route::get('/get-data-mahasiswa-by-nim', [utsSaitController::class, 'indexByNim']);
    // gausah -------
    Route::get('/get-mahasiswa-update-view', [utsSaitController::class, 'updateView']);
    // ------
    Route::post('/tambah-nilai', [utsSaitController::class, 'addNilai']);
    Route::post('/update-nilai', [utsSaitController::class, 'update']);
    Route::delete('/delete-nilai', [utsSaitController::class, 'delete']);
});
