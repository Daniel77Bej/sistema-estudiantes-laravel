<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PersonalController;

// ==========================================
// RUTA PRINCIPAL
// ==========================================

Route::get('/', function () {
    return redirect()->route('personal.index');
});

// ==========================================
// OBTENER ESTUDIANTES MEDIANTE JSON
// ==========================================

Route::get('/personal-json', [
    PersonalController::class,
    'obtenerEstudiantes'
])->name('personal.json');

// ==========================================
// RUTAS CRUD DE ESTUDIANTES
// ==========================================

Route::resource('personal', PersonalController::class);

