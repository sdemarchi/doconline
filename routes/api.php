<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\TurnosController;
use App\Http\Controllers\Api\CalendarioController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\GrowController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\PagoController;
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
Route::post('turnero.login', [UserController::class, 'loginTurnero']);

Route::get('pacienteSelect',[PacienteController::class, 'getSelectSearch'])->name('api.pacienteSelect');
Route::get('paciente/{id}',[PacienteController::class, 'getPaciente']);
Route::get('vinculador.pacientes',[PacienteController::class, 'getPacientesVinculador']);
Route::get('vinculador.buscar/{string}',[PacienteController::class, 'buscarPacientesVinculador']);

//Api de la aplicación

Route::post('turnero.loginUser', [UserController::class, 'loginUsername']);
Route::post('turnero.loginEmail', [UserController::class, 'loginEmail']);
Route::post('turnero.loginGoogle', [UserController::class, 'loginGoogle']);
Route::post('turnero.register', [UserController::class, 'register']);
Route::post('turnero.restablecer', [ResetPasswordController::class, 'restablecer']);
Route::post('turnero.restablecerSendMail', [ResetPasswordController::class, 'enviarMail']);
Route::post('turnero.registerGoogle', [UserController::class, 'registerGoogle']);
Route::get('profile/{id}', [UserController::class, 'profile']);
Route::get('paciente.turno/{id}', [UserController::class, 'getTurnoPaciente']);
Route::put('paciente/{pacienteid}/setGrow/{growid}', [UserController::class, 'setPacienteGrow']);

Route::get('turnero.prestadores', [TurnosController::class, 'getPrestadores']);
Route::get('turnero.turno/{fecha}/{prestadorId}', [TurnosController::class, 'getTurno']);
Route::get('turnero.turnos/{fecha}/{prestadorId}', [TurnosController::class, 'getTurnos']);
Route::get('turnero.precios', [TurnosController::class, 'getPrecios']);
Route::get('turnero.cupon/{cupon}', [TurnosController::class, 'aplicarCupon']);
Route::get('turnero.datosTransf/', [TurnosController::class, 'getDatosTransf']);
Route::post('turnero.confirmar', [TurnosController::class, 'confirmarTurno']);
Route::get('turnero.cancelar/{pacienteId}', [TurnosController::class, 'cancelarTurno']);
Route::get('paciente.turno/{id}', [TurnosController::class, 'getTurnoPaciente']);
Route::post('turnero.comprobante', [TurnosController::class, 'uploadComprobante']);

Route::get('turnero.excedeMargen/{prestador}', [CalendarioController::class, 'excedeMargen']);
Route::get('turnero.calendario/{mes}/{anio}/{prestador}', [CalendarioController::class, 'getCalendario']);

Route::get('provincias', [pacienteController::class, 'getProvincias']);
Route::get('grow/{route}', [GrowController::class, 'getGrowByRoute']);
Route::get('grow.id/{id}', [GrowController::class, 'getGrowById']);
Route::get('grow.email/{email}', [GrowController::class, 'getGrowByEmail']);
Route::get('grow.pacientes/{id}', [GrowController::class, 'getGrowPacientes']);
Route::post('/add-grow', [GrowController::class, 'createGrow'])->name('addGrow');


Route::get('contactos', [pacienteController::class, 'getContactos']);
Route::get('ocupaciones', [pacienteController::class, 'getOcupaciones']);
Route::get('dolencias', [pacienteController::class, 'getDolencias']);

Route::post('formulario', [FormController::class, 'guardarFormulario']);
Route::post('formulario/{id}', [FormController::class, 'actualizarFormulario']);
Route::get('formulario/{dni}', [FormController::class, 'getFormulario']);

Route::get('/pagos/{id}', [PagoController::class, 'show']);
Route::put('/pagos/editar/{id}', [PagoController::class, 'editarPago']);
Route::get('/pagos/buscar-por-email/{email}', [PagoController::class, 'buscarPorEmail']);
Route::get('/pagos/ultimo-regalado/{user_id}', [PagoController::class, 'ultimoRegalado']);
Route::get('/pagos/buscar-por-codigo/{codigo}', [PagoController::class, 'buscarPorCodigo']);
Route::post('/pagos/crear', [PagoController::class, 'nuevoPago']);
Route::post('/pagos/utilizado', [PagoController::class, 'utilizado']);
