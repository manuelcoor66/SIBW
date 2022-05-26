<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $pass = $_POST['contraseña'];
  
    $usuario = getUsuario($nick);

    if (comprobarUsuario($pass)) {     
      $_SESSION['usuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
      $_SESSION['contraseña'] = $pass;
      $_SESSION['nombre'] = $usuario['nombre'];
      $_SESSION['apellidos'] = $usuario['apellidos'];
      $_SESSION['email'] = $usuario['email'];
      $_SESSION['tipo'] = $usuario['tipo'];
      $_SESSION['edicion'] = $usuario['edicion'];
    }
    
    header("Location: index.php");
    
    exit();
  }
  
  echo $twig->render('login.html', []);
?>