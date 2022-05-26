<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  $permisos=array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors= array();
    $usuario = $_POST['Usuario'];
    $tipo = $_POST['Tipo'];

    if (empty($usuario) || empty($tip)) {
      $errors[] = "Usuario no bien inicializado, hay algún dato vacío";
    }

    $prueba = 'b';
    $cantidad = cantidadUsuarios($usuario);
    if(empty($errors)==true) {
      if($cantidad==0) {
        registrarUsuario($prueba, $prueba, $prueba, $prueba, $prueba);
  
        session_destroy(); 
  
        header("Location: index.php");
      
        exit();
      }
    }

    header("Location: index.php");
    
    exit();
  }

  //$permisos=cantidadUsuarios($_SESSION['usuario']);
    
  //header("Location: index.php");
    
  //exit();

  echo $twig->render('gestion-permisos.html', ['cantidad' => $cantidad]);
?>