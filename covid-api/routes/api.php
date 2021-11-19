<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/statuses', [PatientsController::class, 'findAllStatus']);
Route::post('/patients', [PatientsController::class, 'store']);
Route::get('/patients', [PatientsController::class, 'index']);
Route::get('/patients/{id}', [PatientsController::class, 'show']);
Route::get('/patients/search/{name}', [PatientsController::class, 'search']);
Route::put('/patients/{id}', [PatientsController::class, 'updatedatapatient']);
Route::delete('/patients/{id}', [PatientsController::class, 'destroy']);
Route::get('/patients/status/positive', [PatientsController::class, 'statuspositive']);
Route::get('/patients/status/recovered', [PatientsController::class, 'statusrecovered']);
Route::get('/patients/status/dead', [PatientsController::class, 'statusdead']);