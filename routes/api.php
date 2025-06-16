<?php
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClimaController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login',[LoginController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('membresias')->group(function () {
    Route::get('/Todas', [MembresiaController::class, 'index']);
    Route::get('/only/{id}', [MembresiaController::class, 'show']); 
    Route::post('/nueva', [MembresiaController::class, 'store']);     
    Route::put('/actualizarMebre/{id}', [MembresiaController::class, 'update']); 
    Route::delete('/eliminarMebre/{id}', [MembresiaController::class, 'destroy']); 
});

Route::get('/clima/{ciudad}', [ClimaController::class, 'obtenerClima']);

Route::middleware('auth:sanctum')->prefix('usuarios')->group(function () {
    Route::get('/Todos', [UserController::class, 'index']);       
    Route::post('/usuario', [UserController::class, 'store']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);   
    Route::put('/actualizar/{id}', [UserController::class, 'update']); 
    Route::delete('/eliminar/{id}', [UserController::class, 'destroy']);
});