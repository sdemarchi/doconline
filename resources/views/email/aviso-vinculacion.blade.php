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
                    Aviso de vinculación
                </td>
            </tr>
            <tr>
                <td align="left" bgcolor="#ffffff" style="padding: 40px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 16px; border-bottom: 0px;">
                    Estimado/a <strong>{{ $paciente->nom_ape }},</strong> <br/><br/>
                    Tu vinculación fue realizada exitosamente. Recordá que, desde la fecha de vinculación, deben transcurrir dos meses y medio para poder iniciar un reclamo, como el recurso de amparo. Luego de presentar el amparo, se debe esperar entre 5 y 50 días hábiles para que un juez ordene la aprobación en REPROCANN.<br/>
                    A continuación, te compartimos los datos de tu trámite y la fecha en que se realizó:<br/><br/>

                    <table border="0" cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse; font-size: 15px;">
                        <tr>
                            <td><strong>Trámite:</strong></td>
                            <td>{{ $datosTramite['tramite'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tipo:</strong></td>
                            <td>{{ $datosTramite['tipo'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Paciente:</strong></td>
                            <td>{{ $datosTramite['paciente'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Profesional:</strong></td>
                            <td>{{ $datosTramite['profesional'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de modificación:</strong></td>
                            <td>{{ $datosTramite['fecha'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Estado:</strong></td>
                            <td>{{ $datosTramite['estado'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Vigencia:</strong></td>
                            <td>{{ $datosTramite['vigencia'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Inicio:</strong></td>
                            <td>{{ $datosTramite['inicio'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Fin:</strong></td>
                            <td>{{ $datosTramite['fin'] }}</td>
                        </tr>
                    </table>

                    <br/><br/>

                    En los siguientes enlaces podrá descargar su Declaración Jurada y Consentimiento Informado.<br/><br/>

                    <a href="https://v2.doconlineargentina.com/downloads/1/{{ $paciente->token }}" target="_blank">Declaración Jurada</a><br/>
                    <a href="https://v2.doconlineargentina.com/downloads/2/{{ $paciente->token }}" target="_blank">Consentimiento</a><br/>

                    <br/><br/><br/><br/>
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
                            <td align="center" width="100%" style="color: #6d6c6c; font-family: Arial, sans-serif; font-size: 12px;">
                                Copyright &copy; {{ date("Y") }} - <a href="https://doconlineargentina.com" style="color: #131313;">Clínica Doc Online</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </body>
</html>
