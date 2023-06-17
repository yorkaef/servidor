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

      echo "<br> Welcome, $Usuario";
      echo "<br> Tu nombre es: $Nombre";
      echo "<br> Tu DNI es: $dni";
      echo "<br> Tu correo es: $email";
      echo "<br> Tu direccion es: $Direccion";

      echo "<br>You are Successfully Logged In";
      echo "<br><a href='logout.php'>Logout</a>";
    } else {
      echo "<h1>Please Login or SignUp</h1>";
      echo "<a href='login.php'>Login</a> or <a href='signup.php'>SignUp</a>";
    }
    ?>
  </body>
</html>