<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Middleware\TurneroLogin;
use Laravel\Socialite\Facades\Socialite;

use App\Models\TurnoPaciente;

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

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/google-login', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    $email = $user->email;
    $paciente = TurnoPaciente::where('email',$email)->first();
    if($paciente){
        $paciente->es_gmail = 1;
        $paciente->save();

        session(['pacienteId' => $paciente->id]);
        session(['pacienteDni' => $paciente->dni]);
        session(['pacienteFechaNac' => $paciente->fecha_nac]);

        if($paciente->nombre && $paciente->dni && $paciente->fecha_nac) { //Ya ingresó sus datos
            return redirect()->route('turnero.panel');
        } else {
            return redirect()->route('turnero.datos');
        }
    } else {
        $name = $user->name;
        $id = TurnoPaciente::create([
            'nombre' => $name,
            'email' => $email,
            'es_gmail' => 1
        ])->id;
        session(['pacienteId' => $id]);
        session(['pacienteDni' => null]);
        session(['pacienteFechaNac' => null]);

        return redirect()->route('turnero.datos');
    }
    // $user->token
});

Route::get('/', function () {
    return view('form-paciente-home');
})->name('home');
Route::get('/grow', function () {
    return view('form-grow');
})->name('grow');
Route::get('/datos-guardados', function () {
    return view('formulario-guardado');
})->name('paciente.success');
Route::get('/grow-registrado', function () {
    return view('grow-registrado');
})->name('grow.success');


//Rutas de descargas (Sin Auth)
Route::get('paciente/declaracion/{id}', [PrintController::class, 'declaracionPaciente'])->name('paciente.declaracion');
Route::get('paciente/consentimiento/{id}', [PrintController::class, 'consentimientoPaciente'])->name('paciente.consentimiento');
Route::get('paciente/pronto-despacho/{id}', [PrintController::class, 'prontoDespacho'])->name('paciente.pronto-despacho');
Route::get('receta/impresion/{id}', [PrintController::class, 'receta'])->name('receta.impresion');

//Rutas con Auth
Route::group(['middleware' => ['auth']], function () {

    Route::view('/grows/estadisticas', 'backend.grows.grow-estadisticas-layout')->name('grows.estadisticas');
    Route::view('/dashboard', 'backend.dashboard')->name('dashboard');
    Route::view('/configuracion', 'backend.configuracion')->name('configuracion');
    Route::view('/cupones', 'backend.cupones.cupones')->name('cupones');

    Route::view('/usuarios', 'backend.usuarios.usuarios')->name('usuarios');
    Route::view('/usuarios/create', 'backend.usuarios.usuario-create')->name('usuarios.create');
    Route::get('/usuarios/{id}/edit',function($id){
        return view('backend.usuarios.usuario-edit', compact('id'));
    })->name('usuarios.edit');
    Route::view('/usuarios/ingreso', 'backend.usuarios.usuario-ingreso')->name('usuarios.ingreso');
    Route::view('/usuarios/egreso', 'backend.usuarios.usuario-egreso')->name('usuarios.egreso');
    Route::view('/usuarios/control-horario', 'backend.usuarios.horas-trabajadas')->name('usuarios.control-horario');
    Route::view('/usuarios/mi-registro-horario', 'backend.usuarios.mi-registro-horario')->name('usuarios.mi-registro');
    Route::get('/usuarios/ingreso/{id}/edit',function($id){
        return view('backend.usuarios.usuario-ingreso-edit', compact('id'));
    })->name('usuarios.ingreso.edit');
    Route::get('/usuarios/egreso/{id}/edit',function($id){
        return view('backend.usuarios.usuario-egreso-edit', compact('id'));
    })->name('usuarios.egreso.edit');

    Route::view('/pacientes/estadisticas', 'backend.pacientes.pacientes-estadisticas')->name('pacientes.estadisticas');
    Route::view('/pacientes', 'backend.pacientes.pacientes')->name('pacientes');
    Route::view('/pacientes/create', 'backend.pacientes.form-paciente')->name('pacientes.create');
    Route::get('/pacientes/{id}/edit',function($id){
        return view('backend.pacientes.form-paciente-edit', compact('id'));
    })->name('pacientes.edit');
    Route::get('/pacientes/{id}/editFirma',function($id){
        return view('backend.pacientes.form-firmas-edit', compact('id'));
    })->name('pacientes.editFirma');

    Route::view('/grows', 'backend.grows.grows')->name('grows');
    Route::view('/grows/create', 'backend.grows.form-grow')->name('grows.create');
    Route::get('/grows/{id}/edit',function($id){
        return view('backend.grows.form-grow-edit', compact('id'));
    })->name('grows.edit');

    /*Route::get('/datos-medico/{id}/edit',function($id){
        return view('backend.datos-medico', compact('id'));
    })->name('datos-medico.edit');*/

    Route::view('/recetas', 'backend.pacientes.recetas')->name('recetas');
    Route::view('/recetas/create', 'backend.pacientes.receta-create')->name('recetas.create');
    Route::get('/recetas/{id}/edit',function($id){
        return view('backend.pacientes.receta-edit', compact('id'));
    })->name('recetas.edit');

    Route::view('/beneficios', 'backend.beneficios')->name('beneficios');
    Route::view('/dolencias', 'backend.dolencias')->name('dolencias');
    Route::view('/datos-medico', 'backend.datos-medico')->name('datos-medico');
    Route::view('/diagnosticos', 'backend.diagnosticos')->name('diagnosticos');
    Route::view('/justificaciones', 'backend.justificaciones')->name('justificaciones');
    Route::view('/modos-contacto', 'backend.modos-contacto')->name('modos-contacto');
    Route::view('/productos', 'backend.productos')->name('productos');
    Route::view('/tratamientos', 'backend.tratamientos')->name('tratamientos');
    Route::view('/ocupaciones', 'backend.ocupaciones')->name('ocupaciones');
    Route::view('/vinculador', 'backend.vinculador.vinculador')->name('vinculador');

    Route::view('/panel', 'backend.panel.panel')->name('panel');

    Route::view('/turnos', 'backend.turnero.turnos')->name('turnos');
    Route::view('/turnos/configuracion', 'backend.turnero.turno-conf')->name('turnos.configuracion');
    Route::view('/turnos/cbu', 'backend.turnero.lista-cuentas')->name('turnos.cbu');
    Route::view('/calendario', 'backend.turnero.calendario')->name('calendario');
    Route::view('/turnos/pacientes', 'backend.turnero.pacientes')->name('turnos.pacientes');
    Route::get('/pacientes.turnero/{id}/ficha',function($id){
        return view('backend.turnero.ficha-paciente', compact('id'));
    })->name('pacientes.turnero.edit');

    Route::view('/turnos/create', 'backend.turnero.turno-create')->name('turnos.create');

    Route::get('/turnos/{pacienteId}/create',function($pacienteId){
        return view('backend.turnero.turno-create', compact('pacienteId'));
    })->name('turnos.create.pacienteId');

    Route::get('/turnos/{id}/edit',function($id){
        return view('backend.turnero.turno-edit', compact('id'));
    })->name('turnos.edit');

    Route::view('/pagos', 'backend.pagos.pagos-list')->name('pagos');
    Route::get('/pago/{id}',function($id){
        return view('backend.pagos.pago-detalles', compact('id'));
    })->name('pago');
});

//Rutas del turnero
Route::view('/turnero', 'turnero.login')->name('turnero');

Route::view('/terminos', 'terminos')->name('terminos');

Route::group(['middleware' => [TurneroLogin::class]], function () {
    Route::view('/turnero/mipanel', 'turnero.panel')->name('turnero.panel');
    Route::view('/turnero/datos', 'turnero.datos')->name('turnero.datos');
    Route::view('/turnero/turnos', 'turnero.turnos')->name('turnero.turnos');
    Route::view('/turnero/misturnos', 'turnero.mis-turnos')->name('turnero.misturnos');
    Route::view('/turnero/confirmar', 'turnero.confirmar')->name('turnero.confirmar');
    Route::view('/turnero/pagos', 'turnero.pagos')->name('turnero.pagos');

    Route::get('/turnero/pagar/{medio}',function($medio){
        $result = 0;
        return view('turnero.pagar', compact('medio','result'));
    })->name('turnero.pagar');

    Route::get('/turnero/mp-success',function(){
        $medio = 3;
        $result = 1;
        return view('turnero.pagar', compact('medio','result'));
    })->name('turnero.mp-success');

    Route::get('/turnero/mp-failure',function(){
        $medio = 3;
        $result = 2;
        return view('turnero.pagar', compact('medio','result'));
    })->name('turnero.mp-failure');

    Route::get('/turnero/mp-pending',function(){
        $medio = 3;
        $result = 3;
        return view('turnero.pagar', compact('medio','result'));
    })->name('turnero.mp-pending');


    Route::view('/turnero/confirmado', 'turnero.confirmado')->name('turnero.confirmado');
});

require __DIR__.'/auth.php';
