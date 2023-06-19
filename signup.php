<?php
require_once "database.php";

// Variables para almacenar los mensajes de error
$dniError = $nombreError = $correoError = $direccionError = $usuarioError = $passwordError = $confirmPasswordError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dni = $_POST['dni'];
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $direccion = $_POST['direccion'];
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];

  // Validar el correo electrónico
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $correoError = "Correo electrónico inválido.";
  }

  // Validar el usuario (correo)
  $correoRegex = "/^[a-zA-Z0-9._%+-]+@gmail\.com$/";
  if (!preg_match($correoRegex, $correo)) {
    $usuarioError = "El usuario debe ser un correo de Gmail válido.";
  }

  // Validar la contraseña
  $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).*$/";
  if (!preg_match($passwordRegex, $password)) {
    $passwordError = "La contraseña debe tener al menos una letra mayúscula, una letra minúscula y un carácter especial o número.";
  }

  // Validar el DNI
  if (strlen($dni) !== 8 || !is_numeric($dni)) {
    $dniError = "El DNI debe tener exactamente 8 dígitos numéricos.";
  }

  // Verificar si las contraseñas coinciden
  $confirmPassword = $_POST['confirm_password'];
  if ($password !== $confirmPassword) {
    $confirmPasswordError = "Las contraseñas no coinciden.";
  }

  // Verificar si el DNI ya existe en la base de datos
  $queryDNI = "SELECT DNI FROM usuario WHERE DNI = '$dni'";
  $resultDNI = $conexion->query($queryDNI);
  if ($resultDNI->num_rows > 0) {
    $dniError = "El DNI ya está registrado.";
  }

  // Verificar si el correo ya existe en la base de datos
  $queryCorreo = "SELECT email FROM usuario WHERE email = '$correo'";
  $resultCorreo = $conexion->query($queryCorreo);
  if ($resultCorreo->num_rows > 0) {
    $correoError = "El correo electrónico ya está registrado.";
  }

  // Verificar si el usuario ya existe en la base de datos
  $queryUsuario = "SELECT Usuario FROM usuario WHERE Usuario = '$usuario'";
  $resultUsuario = $conexion->query($queryUsuario);
  if ($resultUsuario->num_rows > 0) {
    $usuarioError = "El usuario ya está registrado.";
  }

  // Insertar el usuario en la tabla si no hay errores
  if (empty($dniError) && empty($nombreError) && empty($correoError) && empty($direccionError) && empty($usuarioError) && empty($passwordError) && empty($confirmPasswordError)) {
    $query = "INSERT INTO usuario (DNI, Nombre, email, Direccion, Usuario, password) VALUES ('$dni', '$nombre', '$correo', '$direccion', '$usuario', '$password')";

    if ($conexion->query($query) === TRUE) {
      echo "Usuario registrado exitosamente.";
    } else {
      echo "Error al registrar al usuario: " . $conexion->error;
    }
  }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <?php require 'partials/header.php' ?>

    <h1>Registrar Usuario</h1>
    <span>o <a href="login.php">Iniciar sesión</a></span>

    <form action="signup.php" method="POST">
      <input name="dni" type="text" placeholder="Ingrese su DNI"  pattern="^\d{8}$" title="El dni solo debe contener 8 numeros" required>
      <?php if (!empty($dniError)): ?>
        <p><?php echo $dniError; ?></p>
      <?php endif; ?>

      <input name="nombre" type="text" placeholder="Ingrese su nombre completo"  title="Ingrese su nombre y apellidos" required>

      <input name="correo" type="text" placeholder="Ingrese su email" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="El email debe contener una extension @gmail.com" required>
      <?php if (!empty($correoError)): ?>
        <p><?php echo $correoError; ?></p>
      <?php endif; ?>


      <input name="direccion" type="text" placeholder="Ingrese su direccion" title="Ingrese su dirección de vivienda" required>

      <input name="usuario" type="text" placeholder="Ingrese su nombre de usuario" title="Ingrese su nombre de usuario" required>
      <?php if (!empty($usuarioError)): ?>
        <p><?php echo $usuarioError; ?></p>
      <?php endif; ?>

     <input name="password" type="password" placeholder="Ingrese su contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).*$" title="La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un carácter especial o un número" required>
      <?php if (!empty($passwordError)): ?>
        <p><?php echo $passwordError; ?></p>
      <?php endif; ?>

      <input name="confirm_password" type="password" placeholder="Confirma su contraseña" title="Reptia su contraseña"required>
      <?php if (!empty($confirmPasswordError)): ?>
        <p><?php echo $confirmPasswordError; ?></p>
      <?php endif; ?>

      <input type="submit" value="Submit">
    </form>
  </body>
</html>