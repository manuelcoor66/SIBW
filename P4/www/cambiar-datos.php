<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $email = $_POST['Email'];
    $usuario = $_POST['Usuario'];
    $contrasena = $_POST['Contraseña'];
    $usuarios = cantidadUsuarios($usuario);
    

    
    if (empty($nombre)==true && empty($apellidos)==true && empty($email)==true && empty($usuario)==true && empty($contrasena)==true) {
      $errors[] = "Usuario no bien inicializado, hay algún dato vacío";
    }
    
    if (empty($nombre)==true) {
      $nombre = $_SESSION['nombre'];
    }

    if (empty($apellidos)==true) {
      $apellidos = $_SESSION['apellidos'];
    }

    if (empty($email)==true) {
      $email = $_SESSION['email'];
    }

    if (empty($usuario)==true) {
      $usuario = $_SESSION['usuario'];
    }
    
    if (empty($contrasena)==true) {
      $contrasena = $_SESSION['contraseña'];
    }

    if (empty($errors) == true) {
      if($usuarios['cantidad']==1) {
        actualizarUsuario($nombre, $apellidos, $email, $usuario, $contrasena);
        
        session_destroy(); 

        header("Location: index.php");
      
        exit();
      }
    }

    header("Location: index.php");
  }

  echo $twig->render('cambiar-datos.html', []);
?>