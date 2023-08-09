<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Doc Online</title>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #46b7bf; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#13A8C6" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" style="color: #aaaaaa; font-family: Arial, sans-serif; font-size: 12px;">
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#4d4d4d" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 26px; font-weight: bold;">
                    Revisá tus datos
                </td>
            </tr>
            <tr>
                <td align="left" bgcolor="#ffffff" style="padding: 40px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 16px; border-bottom: 0px;">
                    <strong>{{ $paciente->nom_ape }},</strong> revisá que los datos que ingresaste en el formulario sean correctos. Ante cualquier corrección, contactanos.<br/><br/>
                    <h4>Datos del Formulario:</h4>
                    <table style="font-size:14px">
                        <tbody>
                            <tr>
                                <td style="padding:3px 10px; text-align:right"><strong>Correo Electrónico:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->email }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Apellido y Nombre:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->nom_ape }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>DNI:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->dni }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Fecha de Nacimiento:</strong></td>
                                <td style="padding:3px 10px">{{ date_format(date_create($paciente->fe_nacim),"d/m/Y") }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Cod. Vinculación:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->cod_vincu }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Edad:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->edad }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Domicilio:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->domicilio }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Localidad:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->localidad }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Provincia:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->provincia->Provincia }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Código Postal:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->cp }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Ocupación o Trabajo:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->ocupacion }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Celular:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->celular }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Obra Social:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->osocial }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Comentarios:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->comentario }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Arritmias:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->arritmia) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Padecimiento mental:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->salud_mental) Sí. {{ $paciente->salud_ment_esp}}@else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Alergias:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->alergia) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Embarazo o Lactancia:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->embarazada) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Maneja Maquinaria de Precisión:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->maneja_maq) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Dolencias:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->patologia }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Cómo nos contactó:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->modo_contacto){{ $paciente->modo_contacto->modo_contacto }}@endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Contacto Otro:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->contacto_otro }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Embarazo o Lactancia:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->embarazada) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Cultivará para otra persona:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->es_menor) Sí @else No @endif</td>
                            </tr>
                        </tbody>
                    </table>
                    @if($paciente->es_menor)
                    <h4>Datos del Padre/Madre/Tutor o Encargado</h4>        
                    <table>
                        <tbody>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Apellido y Nombre:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_apeynom }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Tipo y N° Documento:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_tipo_nro_doc }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Fecha de Nacimiento:</strong></td>
                                <td style="padding:3px 10px">{{ date_format(date_create($paciente->tut_fe_nacim),"d/m/Y") }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Domicilio:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_domicilio }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Localidad:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_localidad }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Localidad:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_provincia->Provincia }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Código Postal:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_cp }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Código Postal:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_cp }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Teléfono Particular:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_tel_part }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Celular:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_tel_cel }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Correo Electrónico:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_mail }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Obra Social:</strong></td>
                                <td style="padding:3px 10px">{{ $paciente->tut_osocial }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Registro de Familiares:</strong></td>
                                <td style="padding:3px 10px">@if($paciente->tut_reg_fam) Sí @else No @endif</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <h4>Patologías</h4>
                    <table>
                        <tbody>
                            @foreach($patologias as $pat)
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Patología:</strong></td>
                                <td style="padding:3px 10px">{{ $pat->patologia->dolencia }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Año Aparición:</strong></td>
                                <td style="padding:3px 10px">{{ $pat->anio_aprox }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Medicación:</strong></td>
                                <td style="padding:3px 10px">{{ $pat->medicacion }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Vinculado al Trabajo:</strong></td>
                                <td style="padding:3px 10px">@if($pat->prob_trabajo) Sí @else No @endif</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Dolor 1 a 10:</strong></td>
                                <td style="padding:3px 10px">{{ $pat->dolor_intensidad }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Partes del cuerpo donde duele:</strong></td>
                                <td style="padding:3px 10px">{{ $pat->partes_cuerpo }}</td>
                            </tr>
                            <tr>    
                                <td style="padding:3px 10px; text-align:right"><strong>Atenúa dolor:</strong></td>
                                <td style="padding:3px 10px">@if($pat->tut_reg_fam) Sí @else No @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            
            
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>Doc Online</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 12px;">
                                Copyright &copy; {{ date("Y") }} - <a href="https://doconlineargentina.com" style="color: #d6d6d6;">Doc Online</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>