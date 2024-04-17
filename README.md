# Grows - Estadistica y seguimiento.


### Cupón de descuento y link de seguimiento

Al registrar un nuevo grow, se le asigna automaticamente un cupón de descuento. El mismo se genera de la siguiente manera:

1. Se toma el nombre del grow, se eliminan los espacios y se cambian todas las letras a mayúsculas.

3. Se verifica que ningún otro grow tenga el mismo cupón de descuento. Si esto no se cumple, se le coloca el número 2 al final del cupón y se vuelve a comprobar. Si el cupón sigue existiendo, se incrementa el número en una unidad y se vuelve a intentar hasta obtener un cupón único.

5. A partir del cupón se autogenera un enlace de seguimiento único para cada grow según la fórmula:

``` javascript
const linkDeSeguimiento = urlweb + '/turnero/login/' + cuponDelGrow.
```

por ejemplo para un grow registrado como Aires Weed Grow, su link de seguimiento sera:

    www.doconlineargentina.com.ar/turnero/login/AIRESWEEDGROW


### ¿En que momento se asigna un grow a un paciente determinado?

El grow se asigna al paciente cuando este se REGISTRA en el turnero a travez del link de seguimiento, de la siguiente manera:

1. Al entrar al Login, se extrae el cupón de la url.

2. Se utiliza el cupón para solicitar el grow a la API y se guarda su id en el Session Storage para ser utilizada mas adelante.

``` javascript
   //Login.jsx

    const growRoute = routeParams.grow;

    const getGrow = () => {
        if(growRoute !== undefined){
            getGrowByRoute(growRoute).then((resp)=>{
                sessionStorage.setItem('growId',resp.idgrow);
            });
        }
    }

```

3. Cuando el usuario accede al formulario de registro se extrae el ID del grow del Session Storage.

4. Se agrega el cupon al JSON con la información del formulario que finalmente será enviado a la API para registrar el usuario.


``` javascript
  //Register.jsx

   const submit = async (e) => {

        const datos = {
            nombre:nombre,
            username:username,
            password:password,
            telefono:telefono,
            email:email,
            domicilio:domicilio,
            dni:dni,
            fecha_nac:fechaNac,
            grow:grow  // Se agrega el Grow
        }
        
        if(validate(datos)){
            // se envian los datos
        }
		
    }
```

El proceso se realiza tanto en el registro de usuario de forma manual (Register.jsx) como por google (GoogleRegister.jsx).


### Asignación de un grow post-registro

Si el usuario no se registró a través del enlace de seguimiento, todavía puede asignarse el grow al momento de sacar un turno.

1. Cuando el usuario introduce el cupón de descuento, se solicita el grow a la api.

2. El cupón es guardado en el Session Storage junto con la informacion del turno y del pago.

3. Al momento de confirmar el turno, se busca el grow en el Session Storage y se asigna al paciente.

``` javascript
  // PagoTransf.jsx

    async function guardarTurno() {
        setDatosCargados(false);

        const pagoSession = JSON.parse(sessionStorage.getItem('pago'));
		
        const pago = {
			// Se crea el JSON a enviar
			};

        PagosService.crear(pago).then((resp)=>{
		
            if(sessionStorage.getItem('growId')){
                const idgrow = sessionStorage.getItem('growId');

                setGrowPaciente(user.userId,idgrow); // Se asigna el grow al paciente.
            }
        })
    }
```

<br>


## Estadisticas del Grow 

El proceso estadistico de los grows se lleva a cabo en Laravel para ser mostrado en el panel de Administracion. 

### Sistema de pagos antes y después de 2024
Hasta el principio de 2024, para saber si un usuario pago o no en determinado momento se creaba por cada año una columna en la tabla paciente que indicaba pagado<añoActual>, por ejemplo en 2023 se creo la columna pagado2023 y en 2024 se creo la columna pagado2024. 

Para evitar tener que crear una nueva columna cada año, se implemento un nuevo sistema de pagos disponible desde principios del año 2024. Cada vez que un paciente saca un turno se registra un nuevo pago en la tabla 'pagos', que contiene informacion sobre si el mismo fue efectuado o no, en que año se realizó, que grow utilizó, etc.

Esto influyo en la forma de hacer estadisticas ya que debio implementarse una funcion que contemple los usuarios hasta 2024 y desde 2024 en adelante.


### Conteo de pacientes de un grow
El mecanismo para contar los pacientes de cada grow es el siguiente:

1. Se listan todos los pacientes REGISTRADOS en el mes seleccionado cuyo valor en la columna 'grow' sea distinto de null (tabla "turn_pacientes").

2. Se verifica si el paciente contiene ficha (tabla "pacientes").

2. Se recorre la lista de obtenida y se busca si el paciente tiene un pago registrado.


3. Se verifica si el paciente cumple con algunas de las siguientes condiciones: <br>
    a. La columna pagado2024 es 'true'. <br>
    b. La columna pagado2023 es 'true'. <br>
    c. El paciente registra un pago cuya columna verificado es 'true'. <br>

4. Se agrega la propiedad "pago" al paciente actual que indica si el mismo pago o no en el mes seleccionado.


``` php
   // GrowEstadisticasLivewire.php

     public function getPacientes(){
        $pacientesConGrow /* = Se solicitan los pacientes del mes al modelo TurnoPaciente */;

        $pacientesConGrow = $pacientesConGrow->map(function ($paciente) {
            $paciente['pago'] = 'No';
            $pagoVerificado = false;

            // Se verifica si el paciente tiene ficha
            $ficha = Paciente::where('dni', $paciente['dni'])->first();

            // Se verifica si el paciente tiene pago
            $pago = Pago::where('id_paciente', $paciente->id)->latest('created_at')->first();

            // Si hay pago se comprueba si esta verificado
            if($pago) $pagoVerificado = $pago->verificado;

            //Si el paciente tiene ficha.
            if ($ficha) { 
                if ($ficha->pagado2023 || $ficha->pagado2024 || $pagoVerificado ) $paciente['pago'] = 'Si';

            //Si el paciente tiene ficha pero no tiene pago.
            } else if($pago){ 
                if ($pagoVerificado ) $paciente['pago'] = 'Si';
            }

            return $paciente;
        });

        return $pacientesConGrow->toArray();
    }

```

<br>
<i>Este archivo README se encuentra actualizado a la fecha 9/4/2024.</i>
