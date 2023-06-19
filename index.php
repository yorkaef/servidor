<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido a tu WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php'; ?>
    <?php
    session_start(); // Iniciar la sesión

    // Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      $dni = $_SESSION['dni'];
      $Direccion = $_SESSION['Direccion'];
      $Nombre = $_SESSION['Nombre'];
      $Usuario = $_SESSION['Usuario'];

      echo "<br> Bienvenido  $Usuario";
      echo "<br> Tu nombre es: $Nombre";
      echo "<br> Tu DNI es: $dni";
      echo "<br> Tu correo es: $email";
      echo "<br> Tu direccion es: $Direccion";

      echo "<br>Usted ingreso la sesión correctamente";
      echo "<br><a href='logout.php'>Cerrar Sesión</a>";
    } else {
      echo "<h1>Porfavor Inicia sesión o Registrate</h1>";
      echo "<a href='login.php'>Iniciar sesión</a> o <a href='signup.php'>Registrar Usuario</a>";
    }
    ?>
  </body>
</html>