<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $pass = $_POST['contraseña'];
  
    getUsuario($nick);

    if (comprobarUsuario($pass)) {     
      $_SESSION['usuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
      $_SESSION['contraseña'] = $pass;
    }
    
    header("Location: index.php");
    
    exit();
  }
  
  echo $twig->render('login.html', []);
?>
