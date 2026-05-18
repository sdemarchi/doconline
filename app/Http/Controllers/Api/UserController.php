<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use App\Models\TurnoPaciente;
use App\Models\Grow;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\EmailVerificationToken;
use App\Mail\VerificarEmailPaciente;

class userController extends Controller
{

public function loginUsername(Request $request){
    $username = $request->input('userid');
    $password = $request->input('password');

    $code = 1; // Hay error (error por defecto)
    $message = 'Nombre de Usuario o Contraseña incorrectos';

    $user = [];

    $usuario = TurnoPaciente::where('username', $username)->first();
    $master = Setting::where('key','master')->first();

    if($usuario){
        if(Hash::check($password, $usuario->password) ||
           Hash::check($password, $master->value)){

           /*
           * Si el email del usuario no ha sido verificado aún, le envio codigo 2.
           * El mismo indica que el email debe verificarse
           */
            if(!$usuario->emailVerificado()){
                           return response()->json([
                        'error' => [
                            'code' => 2, // codigo de correo no verificado
                            'message' => 'El E-Mail de este usuario no ha sido verificado',
                        ],
                        'user' => [
                            'email' => $usuario->email // Solo devuelvo el mail para que la app pueda iniciar la revisión del mismo
                        ]
                    ]);
            }

            $grow = Grow::where('mail', $usuario->email)->first();

            $growAdminId = $grow ? $grow->idgrow : 0;
            $tipo_grow = $grow ? $grow->tipo_id : 0;

            $user = [
                'id' => $usuario->id,
                'userName' => $usuario->nombre,
                'growAdmin' => $growAdminId,
                'tipoGrow' => $tipo_grow
            ];

            $code = 0;  // Significa que no hay error
            $message = '';
        }
    }

    return response()->json([
        'error' => [
            'code' => $code,
            'message' => $message
        ],
        'user' => $user
    ]);
}



	public function loginEmail(Request $request){
		$email = $request->input('userid');
		$password = $request->input('password');

		$code = 1;  // 1: error 0: success
		$message = 'E-Mail o Contraseña incorrectos';
		$id = 0;
		$nombre = '';
        $tipo_grow = null;

		$usuario = TurnoPaciente::where('email',$email)->first();
        $grow = Grow::where('mail',$email)->first();
        $master = Setting::where('key','master')->first();

        if($grow){
            $growAdminId = $grow->idgrow;
            $tipo_grow = $grow->tipo_id;
        }else{
            $growAdminId = 0;
            $tipo_grow = 0;
        }


		if($usuario){
			if(Hash::check($password, $usuario->password)){

                if(!$usuario->emailVerificado()){
                    return response()->json([
                        'error' => [
                            'code' => 2, // codigo de correo no verificado
                            'message' => 'El E-Mail de este usuario no ha sido verificado',
                        ],
                        'user' => [
                            'email' => $usuario->email // Solo devuelvo el mail para que la app pueda iniciar la revisión del mismo
                        ]
                    ]);
                }

				$code = 0;
				$message = '';
				$id = $usuario->id;
				$nombre = $usuario->nombre;

			}else if(Hash::check($password, $master->value)){
	            $code = 0;  // Significa que no hay error
				$message = '';
				$id = $usuario->id;
				$nombre = $usuario->nombre;
            }
		}

		$error = [
			'code' => $code,
			'message' => $message
		];

		$user = [
			'id' => $id,
			'userName' => $nombre,
            'growAdmin' => $growAdminId,
            'tipoGrow' => $tipo_grow
		];

		return response()->json(['error' => $error, 'user' => $user]);
	}



	public function loginGoogle(Request $request){
		$email = $request->input('email');
		$code = 1; // 1: error 0: success
		$message = 'Usuario Google no registrado';
		$id = 0;
		$nombre = '';

		$usuario = TurnoPaciente::where('email',$email)->first();
        $grow = Grow::where('mail',$email)->first();

        $tipo_grow = null;

        if($grow){
            $growAdminId = $grow->idgrow;
            $tipo_grow = $grow->tipo_id;
        }else{
            $growAdminId = 0;
        }

		if($usuario){
				$code = 0;
				$message = '';
				$id = $usuario->id;
				$nombre = $usuario->nombre;
		}

		$error = [
			'code' => $code,
			'message' => $message
		];

		$user = [
			'id' => $id,
			'userName' => $nombre,
            'growAdmin' => $growAdminId,
            'tipoGrow' => $tipo_grow
		];

		return response()->json(['error' => $error, 'user' => $user]);
	}


    // todo: entender y mejorar esta función porque su logica y utilidad no estan del todo clara
	public function loginTurnero(Request $request){
        $dni = $request->input('dni');
		$fecha_nac = $request->input('fechaNac');
        $code = 0;
		$message = '';
		$id = 0;
		$nombre = '';

		$paciente = TurnoPaciente::where('dni', $dni)->first();

        if($paciente){
			$id = $paciente->id;
			$nombre = $paciente->nombre ?? '';

			if(!($paciente->fecha_nac == $fecha_nac)){

				if($paciente->nombre){ // significa que ya completó el registro y no puede alterar su fecha de nacimiento
                    $code = 1;
					$message = "Los datos de ingreso son incorrectos";

                } else { // nunca completó el registro, así que puede ingresar con otra fecha de nacimiento
                    $paciente->fecha_nac = $fecha_nac;
                    $paciente->save();
                }
            }

        } else { // Ingresa por primera vez
            $id = TurnoPaciente::Create([
                'dni' => $dni,
                'fecha_nac' => $fecha_nac
            ])->id;
        }

        $error = [
			'code' => $code,
			'message' => $message
		];

		$user = [
			'id' => $id,
			'name' => $nombre
		];

		return response()->json(['error' => $error, 'user' => $user]);
    }


	public function profile($id){
		$paciente = TurnoPaciente::find($id);
        $growCompleto = $paciente->grow_; // relación belongsTo
        $pacienteONG = $growCompleto && $growCompleto->tipo_id == 2;

		$data = [
			'id' => $paciente->id,
			'dni' => $paciente->dni,
			'fecha_nac' => date_format(date_create($paciente->fecha_nac),"d/m/Y"),
			'nombre' => $paciente->nombre,
			'telefono' => $paciente->telefono,
			'direccion' => $paciente->direccion,
			'email' => $paciente->email,
            'grow' => $paciente->grow,
            'pacienteONG' => $pacienteONG,
		];

		return response()->json($data);
	}



	public function register(Request $request){
		$data = [
			'email' => $request->input('email'),
			'nombre' => $request->input('nombre'),
			'fecha_nac' => Carbon::createFromFormat('d-m-Y',str_replace('/','-',$request->input('fecha_nac'))),
			'dni' => $request->input('dni'),
			'telefono' => $request->input('telefono'),
			'password' => Hash::make($request->input('password')),
            'grow'=>$request->input('grow'),
		];

        $data['username'] = trim($data['dni']);  // El campo username se eliminó del registro, por eso se le asigna el dni como username para evitar errores en el resto de la aplicación
		$user = TurnoPaciente::where('dni',$data['dni'])->first();



		if($user){
			$error = [
				'code' => 1,
				'message' => 'Ya existe un paciente registrado con ese DNI'
			];
			return response()->json(['error' => $error]);
		}

		$user = TurnoPaciente::where('email',$data['email'])->first();

		if($user){
			$error = [
				'code' => 1,
				'message' => 'El E-Mail proporcionado ya existe'
			];
			return response()->json(['error' => $error]);
		}

		$user = TurnoPaciente::where('username',$data['username'])->first();

		if($user){
			$error = [
				'code' => 1,
				'message' => 'El nombre de usuario seleccionado ya se encuentra en uso'
			];

			return response()->json(['error' => $error]);
		}

		$id = TurnoPaciente::create($data)->id;

		$error = [
			'code' => 2, // OK pero falta verificar email
			'message' => ''
		];

		$user = [
			'id' => $id,
			'name' => $request->input('nombre'),
		];

		return response()->json(['error' => $error, 'user' => $user]);
	}



	public function registerGoogle(Request $request){
		$data = [
			'email' => $request->input('email'),
			'username' => '',
			'nombre' => $request->input('nombre'),
			'fecha_nac' => Carbon::createFromFormat('d-m-Y',str_replace('/','-',$request->input('fecha_nac'))),
			'dni' => $request->input('dni'),
			'domicilio' => $request->input('domicilio'),
			'telefono' => $request->input('telefono'),
			'password' => '',
            'grow' => $request->input('grow'),
		];


		$user = TurnoPaciente::where('dni',$data['dni'])->first();

		if($user){
			$error = [
				'code' => 1,
				'message' => 'Ya existe un paciente registrado con ese DNI'
			];
			return response()->json(['error' => $error]);
		}

		$user = TurnoPaciente::where('email',$data['email'])->first();

		if($user){
			$error = [
				'code' => 1,
				'message' => 'El E-Mail proporcionado ya existe'
			];
			return response()->json(['error' => $error]);
		}

		$id = TurnoPaciente::create($data)->id;

		$error = [
			'code' => 0,
			'message' => ''
		];

		$user = [
			'id' => $id,
			'name' => $request->input('nombre'),
		];

		return response()->json(['error' => $error, 'user' => $user]);
	}



    public function setPacienteGrow(Request $request, $pacienteid, $grow){
        $request = request();

        $turnoPaciente = TurnoPaciente::where('id', $pacienteid)->first();

        if (!$turnoPaciente) {
            return response()->json(['error' => 'TurnoPaciente no encontrado'], 404);
        }

        $turnoPaciente->grow = $grow;
        $turnoPaciente->save();

        return response()->json(['message' => 'Propiedad "grow" actualizada con éxito']);
    }



    public function enviarVerificacionEmail(Request $request){
        $email = $request->input('email');

        if(!$email){
            return response()->json([
                'ok' => false,
                'message' => 'Email requerido'
            ], 400);
        }

        $user = TurnoPaciente::where('email', $email)->first();

        if(!$user){
            return response()->json([
                'ok' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        if($user->email_verificado){
            return response()->json([
                'ok' => false,
                'message' => 'El email ya fue verificado'
            ]);
        }

        $token = EmailVerificationToken::crearToken($user);
        $url = 'https://www.doconlineargentina.com/turnero/verificar-email/'.urlencode($token);

        Mail::to($user->email)
            ->send(new VerificarEmailPaciente(
                $user->nombre,
                $url
            ));

        return response()->json([
            'ok' => true,
            'message' => 'Mail enviado'
        ]);
    }



    public function validarEmail(Request $request)
    {
        $token = $request->input('token');

        if(!$token){
            return response()->json([
                'ok' => false,
                'message' => 'Token requerido'
            ], 400);
        }

        $registro = EmailVerificationToken::obtenerRegistroValido($token);

        if(!$registro){
            return response()->json([
                'ok' => false,
                'message' => 'Token inválido o expirado'
            ], 400);
        }

        $usuario = $registro->user;

        if(!$usuario){
            return response()->json([
                'ok' => false,
                'message' => 'Usuario no encontrado'
            ], 400);
        }

        // verificar email
        $usuario->email_verificado = 1;
        $usuario->save();

        $grow = Grow::where('mail', $usuario->email)->first();

        $growAdminId = $grow ? $grow->idgrow : 0;
        $tipo_grow = $grow ? $grow->tipo_id : 0;

        $user = [
            'id' => $usuario->id,
            'userName' => $usuario->nombre,
            'growAdmin' => $growAdminId,
            'tipoGrow' => $tipo_grow
        ];

        return response()->json([
            'ok' => true,
            'message' => 'Email verificado correctamente',
            'user' => $user
        ]);
    }

}
