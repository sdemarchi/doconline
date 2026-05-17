<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Doc Online</title>
    <meta name="viewport" content="width=device-width" />

    <style type="text/css">

        @media only screen and (max-width: 550px),
        screen and (max-device-width: 550px) {

            body[yahoo] .buttonwrapper {
                background-color: transparent !important;
            }

            body[yahoo] .button {
                padding: 0 !important;
            }

            body[yahoo] .button a {
                padding: 15px 25px !important;
            }
        }

        @media only screen and (min-device-width: 601px) {
            .content {
                width: 600px !important;
            }
        }

    </style>
</head>

<body bgcolor="#13A8C6" style="margin:0; padding:0;" yahoo="fix">

    <table align="center"
           border="0"
           cellpadding="0"
           cellspacing="0"
           style="border-collapse: collapse; width:100%; max-width:600px;"
           class="content">

        <!-- Header -->
        <tr>
            <td align="center"
                bgcolor="#e3e3e3"
                style="
                    padding: 18px 20px;
                    color:#434343;
                    font-family:Arial, sans-serif;
                    font-size:20px;
                    font-weight:bold;
                ">
                Iniciar Sesión
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td align="left"
                bgcolor="#ffffff"
                style="
                    padding:40px 30px;
                    color:#3c3c3c;
                    font-family:Arial, sans-serif;
                    font-size:16px;
                    line-height:26px;
                ">

                <p style="margin-top:0;">
                    Hola <strong>{{$nombre}}</strong>.
                </p>

                <p>
                    Para iniciar sesión en tu cuenta de <strong>Doc Online</strong>,
                    hacé click en el siguiente botón:
                </p>

                <table border="0"
                       cellspacing="0"
                       cellpadding="0"
                       style="margin:35px auto;">

                    <tr>
                        <td align="center"
                            bgcolor="#13A8C6"
                            style="
                                border-radius:6px;
                            ">

                            <a href="{{$url}}"
                                target="_blank"
                                style="
                                        background:#1da1f2;
                                        border-radius:6px;
                                        color:#ffffff;
                                        display:block;
                                        font-family:Arial, sans-serif;
                                        font-size:16px;
                                        font-weight:bold;
                                        text-decoration:none;
                                        text-align:center;
                                        padding:10px 30px;
                                        width:100%;
                                        max-width:320px;
                                        box-sizing:border-box;
                                ">
                                Iniciar Sesión
                            </a>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>

        <!-- Instagram -->
        <tr>
            <td align="center"
                bgcolor="#ffffff"
                style="padding: 0 20px 30px 20px;">

                <p style="
                    font-family:Arial, sans-serif;
                    font-size:12px;
                    color:#666;
                    margin-bottom:15px;
                ">
                    Seguinos en Instagram
                </p>

                <a href="https://instagram.com/doconlineargentina"
                   target="_blank"
                   style="
                        display:inline-block;
                        background-color:#dce9ef;
                        padding:10px 18px;
                        border-radius:30px;
                        font-family:Arial, sans-serif;
                        font-size:14px;
                        color:#000000;
                        text-decoration:none;
                   ">

                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
                         width="18"
                         style="vertical-align:middle; margin-right:8px;"
                         alt="Instagram">

                    <span style="vertical-align:middle;">
                        DocOnline
                    </span>

                </a>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding:25px 10px 20px 10px;">

                <table border="0"
                       cellpadding="0"
                       cellspacing="0"
                       width="100%">

                    <tr>
                        <td align="center"
                            width="100%"
                            style="
                                color:#6d6c6c;
                                font-family:Arial, sans-serif;
                                font-size:12px;
                            ">

                            Copyright &copy; {{ date("Y") }}
                            -
                            <a href="https://doconlineargentina.com"
                               style="color:#131313;">
                                Clínica Doc Online
                            </a>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>

    </table>

</body>
</html>
