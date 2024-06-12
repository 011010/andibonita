<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitadoController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ReacController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route ::get("/crud", [CrudController::class, 'index'])-> name('crud.index');
Route ::get("/tablauno", [CrudController::class, 'actividades'])-> name('tablauno.actividades');
Route ::get("/tablados", [CrudController::class, 'cursos'])-> name('tablados.cursos');
Route ::get("/tablatres", [CrudController::class, 'lecciones'])-> name('tablatres.lecciones');
Route ::get("/tablacuatro", [CrudController::class, 'progresoEstudiante'])-> name('tablacuatro.progresoEstudiante');
Route ::get("/tablacinco", [CrudController::class, 'usuarios'])-> name('tablacinco.usuarios');
*/



Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/welcomeinvitado', function () {
    return view('welcomeinvitado');
})->name('welcomeinvitado');

Route::get('/welcomeinvitado', function () {
    return view('welcomeinvitado');
})->name('welcomeinvitado')->middleware('role:invitado');
 
Route::get('/', function () {
    return view('Iniciar');
})->name('login');

Route::get('registrar', function () {
    return view('registrar');
});
Route::get('registraral', function () {
    return view('registraral');
});
Route::get('tutores', function () {
    return view('tutores');
});
Route::get('formulario', function () {
    return view('formulario');
});

Route::get('/reac', function () {
    return view('reac');
});

Route::get('/reac/create', [ReacController::class, 'create']);
Route::post('/reac/store', [ReacController::class, 'store']);

Route::post('/calendarios', [CalendarioController::class, 'store']);
Route::get('/calendarios/{id}/pdf', [CalendarioController::class, 'generatePDF'])->name('calendario.pdf');

Route::post('/calendario', [CalendarioController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'login']);

Route::resource('usuarios', App\http\Controllers\UsuarioController::class);
Route::resource('tutores', App\http\Controllers\TutoreController::class);
Route::resource('tutorados', App\http\Controllers\TutoradoController::class);

/*Route::resource('roles', App\http\Controllers\RoleController::class);
Route::resource('usuarios', App\http\Controllers\UsuarioController::class);
Route::resource('tutores', App\http\Controllers\TutoreController::class);
Route::resource('alumnos', App\http\Controllers\AlumnoController::class);
Route::resource('alumnosus', App\http\Controllers\AlumnosuController::class);

use App\Http\Controllers\ExcelImportController;

Route::post('/import', [ExcelImportController::class, 'import'])->name('excel.import');
*/