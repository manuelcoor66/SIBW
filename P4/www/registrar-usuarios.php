<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once 'bd.php';
  session_start();

  $varsParaTwig = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors= array();
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (empty($nombre) || empty($apellidos) || empty($email) || empty($usuario) || empty($contrasena)) {
      $errors[] = "Usuario no bien inicializado, hay algún dato vacío";
    }

    if (empty($errors)==true) {
      registrarUsuario($nombre, $apellidos, $email, $usuario, $contrasena);
    }

    header("Location: index.php");
    
    exit();
  }

  echo $twig->render('registrar-usuarios.html', []);
?>