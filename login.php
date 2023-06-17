<?php
require_once "database.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Verificar las credenciales del usuario
  $query = "SELECT * FROM usuario WHERE email='$email' AND password='$password'";
  $result = $conexion->query($query);

  if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();

    // Iniciar sesión y guardar los datos del usuario en variables de sesión
    session_start();
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['dni'] = $usuario['DNI'];
    $_SESSION['Nombre'] = $usuario['Nombre'];
    $_SESSION['Direccion'] = $usuario['Direccion'];
    $_SESSION['Usuario'] = $usuario['Usuario'];

    // Redireccionar al index.php
    header("Location: index.php");
    exit();
  } else {
    $message = "Credenciales incorrectas. Por favor, intenta nuevamente.";
  }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>