<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Autenticacion
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Comubicados
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::post('/announcements', [AnnouncementController::class, 'store']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);

//Eventos
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

//pdf
Route::get('/cards', [CardController::class, 'index']);
Route::post('/cards', [CardController::class, 'store']); // Para crear una nueva tarjeta
Route::post('/cards/{id}', [CardController::class, 'store']); // Para actualizar una tarjeta existente
Route::delete('/cards/{id}', [CardController::class, 'destroy']); // Para eliminar una tarjeta

//Change img
Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('auth:sanctum');
// Ruta para subir la imagen
Route::post('/upload-image', [AuthController::class, 'uploadImage'])->middleware('auth:sanctum');

// Ruta para actualizar la imagen del usuario
Route::put('/user/update-image', [AuthController::class, 'updateImage'])->middleware('auth:sanctum');
Route::post('/remove-image', [AuthController::class, 'removeImage']);

