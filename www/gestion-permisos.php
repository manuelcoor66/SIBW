<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  $permisos=array();

  $cantidad = totalUsuarios();
  $salida = $cantidad['cantidad'];
  $usuarios = getUsuarios();
  $tipos = getTipos();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors= array();
    $usuario = $_POST['Usuario'];
    $tipo = $_POST['Tipo'];
    $cantidad = cantidadUsuarios($usuario);
    $cant_super = totalSupersuarios();
    $tipo_probar = getTipoUsuario($usuario);

    if (empty($usuario) || empty($tipo)) {
      $errors[] = "Usuario no bien inicializado, hay algún dato vacío";
    }

    if(empty($errors)==true) {
      if($cantidad['cantidad']==1 && $tipo>=0  && $tipo<=3) {
        if ($cant_super['cantidad'] > 1) {
          actualizarTipo($usuario, $tipo);

          header("Location: index.php");
        
          exit();
        }
        elseif($tipo_probar['tipo'] != 0) {
          actualizarTipo($usuario, $tipo);

          header("Location: index.php");
        
          exit();
        }
      }
    }

    header("Location: index.php");
    
    exit();
  }

  echo $twig->render('gestion-permisos.html', ['cantidad' => $salida, 'usuarios' => $usuarios, 'tipos' => $tipos]);
?>