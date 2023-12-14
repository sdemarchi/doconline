<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperación de Contraseña</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
      }

      .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h2,
      h1 {
        color: #333;
      }

      p {
        color: #555;
      }

      .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        text-decoration: none;
        background-color: #007bff;
        border-radius: 5px;
      }

      .button:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>DocOnline</h1>
      <h2>Recuperación de Contraseña</h2>
      <p>
        Hola {{$data['nombre']}}, hemos recibido una solicitud para restablecer tu contraseña. Haz clic en
        el botón a continuación para restablecerla:
      </p>

      <a href={{$data['url']}} class="button">Restablecer Contraseña</a>

      <p>
        Si no has solicitado un restablecimiento de contraseña, puedes ignorar
        este correo.
      </p>

      <p>Gracias,<br />DocOnline</p>
    </div>
  </body>
</html>
