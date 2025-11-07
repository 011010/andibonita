<?php

/**
 * Web Routes
 *
 * Este archivo contiene todas las rutas web de la aplicación.
 * Las rutas están organizadas por funcionalidad y nivel de autenticación.
 *
 * Estructura:
 * - Rutas públicas (login, registro, bienvenida)
 * - Rutas autenticadas (protegidas por middleware auth)
 * - Recursos CRUD (usuarios, tutores, tutorados, REACs, calendarios)
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ReacController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TutoreController;
use App\Http\Controllers\TutoradoController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
| Estas rutas no requieren autenticación
*/

// Página de inicio / Login
Route::get('/', function () {
    return view('Iniciar');
})->name('login');

// Autenticación
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Páginas de registro
Route::get('/registrar', function () {
    return view('registrar');
})->name('registrar');

Route::get('/registraral', function () {
    return view('registraral');
})->name('registraral');

// Página de bienvenida para invitados
Route::get('/welcomeinvitado', function () {
    return view('welcomeinvitado');
})->name('welcomeinvitado');

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas
|--------------------------------------------------------------------------
| Todas estas rutas requieren que el usuario esté autenticado
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard principal
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Página de bienvenida autenticada
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    /*
    |--------------------------------------------------------------------------
    | CRUD de Usuarios
    |--------------------------------------------------------------------------
    */
    Route::resource('usuarios', UsuarioController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD de Tutores
    |--------------------------------------------------------------------------
    */
    Route::resource('tutores', TutoreController::class);

    // Importación masiva de tutores desde Excel
    Route::post('/tutores/import', [TutoreController::class, 'import'])->name('tutores.import');

    /*
    |--------------------------------------------------------------------------
    | CRUD de Tutorados (Estudiantes)
    |--------------------------------------------------------------------------
    */
    Route::resource('tutorados', TutoradoController::class);

    // Importación masiva de tutorados desde Excel
    Route::post('/tutorados/import', [TutoradoController::class, 'import'])->name('tutorados.import');

    /*
    |--------------------------------------------------------------------------
    | Módulo de REAC (Reportes de Actividades de Tutoría)
    |--------------------------------------------------------------------------
    */
    // Rutas RESTful completas para REAC
    Route::resource('reac', ReacController::class)->except(['create', 'store']);

    // Rutas personalizadas para REAC
    Route::get('/reac/create', [ReacController::class, 'create'])->name('reac.create');
    Route::post('/reac', [ReacController::class, 'store'])->name('reac.store');
    Route::get('/reac/{id}/pdf', [ReacController::class, 'generatePDF'])->name('reac.pdf');

    /*
    |--------------------------------------------------------------------------
    | Módulo de Calendario de Tutorías
    |--------------------------------------------------------------------------
    */
    // Rutas RESTful completas para Calendario
    Route::resource('calendario', CalendarioController::class);

    // Ruta personalizada para generar PDF del calendario
    Route::get('/calendario/{id}/pdf', [CalendarioController::class, 'generatePDF'])->name('calendario.pdf');

});

/*
|--------------------------------------------------------------------------
| Rutas con Roles Específicos
|--------------------------------------------------------------------------
| Estas rutas requieren roles específicos además de autenticación
*/

// Rutas solo para administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Aquí irán las rutas administrativas
    // Ejemplo: gestión de divisiones, configuración del sistema, etc.
});

// Rutas solo para tutores
Route::middleware(['auth', 'role:tutor'])->group(function () {
    // Rutas específicas para tutores
    // Ejemplo: ver sus tutorados asignados, crear REACs, etc.
});

// Rutas solo para tutorados
Route::middleware(['auth', 'role:tutorado'])->group(function () {
    // Rutas específicas para estudiantes tutorados
    // Ejemplo: ver su tutor asignado, ver calendarios, etc.
});

/*
|--------------------------------------------------------------------------
| Rutas Comentadas (Antiguas)
|--------------------------------------------------------------------------
| Estas rutas están comentadas para referencia histórica
| Se pueden eliminar en una limpieza futura
*/

/*
// Rutas antiguas de CRUD comentadas
Route::get("/crud", [CrudController::class, 'index'])->name('crud.index');
Route::get("/tablauno", [CrudController::class, 'actividades'])->name('tablauno.actividades');
Route::get("/tablados", [CrudController::class, 'cursos'])->name('tablados.cursos');
Route::get("/tablatres", [CrudController::class, 'lecciones'])->name('tablatres.lecciones');
Route::get("/tablacuatro", [CrudController::class, 'progresoEstudiante'])->name('tablacuatro.progresoEstudiante');
Route::get("/tablacinco", [CrudController::class, 'usuarios'])->name('tablacinco.usuarios');

// Rutas duplicadas antiguas
Route::post('/calendarios', [CalendarioController::class, 'store']);
Route::get('/calendarios/{id}/pdf', [CalendarioController::class, 'generatePDF'])->name('calendario.pdf');

// Recursos comentados
Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('alumnos', App\Http\Controllers\AlumnoController::class);
Route::resource('alumnosus', App\Http\Controllers\AlumnosuController::class);

// Importación Excel genérica
Route::post('/import', [ExcelImportController::class, 'import'])->name('excel.import');
*/