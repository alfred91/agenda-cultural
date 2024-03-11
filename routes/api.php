<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\EventApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\ExperienceApiController;
use App\Http\Controllers\API\RegistrationApiController;

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

Route::middleware('auth:sanctum')->group(function () {

    // EVENTOS
    Route::get('/agencult/evento', [EventApiController::class, 'index']);
    Route::get('/agencult/evento/{id}', [EventApiController::class, 'show']);
    Route::put('/agencult/evento', [EventApiController::class, 'store']);
    Route::delete('/agencult/evento/{id}', [EventApiController::class, 'destroy']);

    // USUARIOS
    Route::get('/agencult/asistente/{dni}', [UserApiController::class, 'show']);

    // CATEGORÍAS
    Route::get('/agencult/categorías/{id}', [CategoryApiController::class, 'show']);

    // INSCRIPCIONES
    Route::get('/agencult/asistente/{dni}/inscripciones', [RegistrationApiController::class, 'index']);
    Route::get('/agencult/asistente/{dni}/inscripcion/{idEvento}', [RegistrationApiController::class, 'show']);

    // EXPERIENCIAS
    Route::get('/agencult/experiencias', [ExperienceApiController::class, 'index']);
});

//OBTENER UN TOKEN
Route::get('/token', function (Request $request) {
    $user = User::find(1);
    if ($user) {
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => $token]);
    }
    return response()->json(['message' => 'Usuario no encontrado']);
});
