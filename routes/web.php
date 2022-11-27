<?php

use App\Http\Controllers\controlador;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\EspaciosController;
use App\Http\Controllers\TemplateFormatsController;
use App\Http\Controllers\UniversidadesController;
use App\Http\Controllers\UsuarioController;
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
        Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'usuarios']);
    });

    Route::group(['middleware' => 'estudiante'], function () {
        Route::resource('documentos', DocumentosController::class)->parameters(['documentos' => 'documentos']);
        Route::get('documentos/create/{id}', [DocumentosController::class, 'subir'])->name('subir');
    });

    Route::group(['middleware' => 'asistente'], function () {
     
    });
    
});
