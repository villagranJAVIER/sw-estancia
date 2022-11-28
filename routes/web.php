<?php

use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\controlador;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\EspaciosController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\TemplateFormatsController;
use App\Http\Controllers\UniversidadesController;
use App\Http\Controllers\UsuarioController;
use App\Models\Documentos;
use App\Models\Recursos;
use App\Models\TemplateFormats;
use App\Models\Universidades;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::group(['middleware' => 'maestro'], function () {
    });

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('universidades', UniversidadesController::class)->parameters(['universidades' => 'universidades']);
        Route::resource('espacios', EspaciosController::class)->parameters(['espacios' => 'espacios']);
        Route::get('espacios/download/{URL}', [EspaciosController::class, 'downloadFile'])->name('download');
        Route::post('espacios/upload/subir', [EspaciosController::class, 'uploadFile'])->name('upload');
        Route::resource('documentos', DocumentosController::class)->parameters(['documentos' => 'documentos']);
        Route::get('documentos/create/{id}', [DocumentosController::class, 'subir'])->name('subir');
        Route::get('documentos/downloadDoc/{URL}', [DocumentosController::class, 'downloadFile'])->name('downloadDoc');
        Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'usuarios']);
        Route::resource('estudiantes', EstudianteController::class)->parameters(['estudiantes' => 'estudiantes']);
        Route::resource('asignaciones', AsignacionController::class)->parameters(['asignaciones' => 'asignaciones']);

        Route::get('recursos/create/{id}', [RecursosController::class, 'subir'])->name('subirDoc');
    });

    Route::group(['middleware' => 'estudiante'], function () {
        Route::resource('documentos', DocumentosController::class)->parameters(['documentos' => 'documentos']);
        Route::get('documentos/create/{id}', [DocumentosController::class, 'subir'])->name('subir');
    });

    Route::group(['middleware' => 'asistente'], function () {
        Route::resource('estudiantes', EstudianteController::class)->parameters(['estudiantes' => 'estudiantes']);
        Route::get('documentos/downloadDoc/{URL}', [DocumentosController::class, 'downloadFile'])->name('downloadDoc');
        Route::resource('asignaciones', AsignacionController::class)->parameters(['asignaciones' => 'asignaciones']);

        Route::resource('recursos', RecursosController::class)->parameters(['recursos' => 'recursos']);

        Route::get('recursos/create/{id}', [RecursosController::class, 'subir'])->name('subirDoc');
    });
    
});
