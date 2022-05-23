<?php 
	function connect() {
		$mysqli = new mysqli("mysql", "manuelcoor66", "manuelcoor66", "P4");
		if ($mysqli->connect_errno) {
			echo ("Fallo al conectar: " . $mysqli->connect_error);
		}
		return $mysqli;
	}	
	   
	function getPala($idPala) {
		$mysqli = connect();

		$res = $mysqli->query("SELECT nombre, precio, descripcion, tipo_jugador, caracteristicas, enlace, foto1, foto2, foto3, 
							nombre_comentario, fecha_comentario, texto_comentario FROM Productos WHERE id=" . $idPala);

		$pala = array('nombre' => 'nombre por defecto', 'precio' => 'precio por defecto', 'descripcion' => 
					  'descripcion por defecto', 'tipo_jugador' => 'tipo_jugador por defecto', 'caracteristicas' => 
					  'caracteristicas por defecto', 'enlace' => 'enlace por defecto', 'foto1' => 'foto1 por defecto', 'foto2'
					  => 'foto2 por defecto', 'foto3' => 'foto3 por defecto', 'nombre_comentario' => 
					  'nombre_comentario por defecto', 'fecha_comentario' => 'fecha_comentario por defecto', 
					  'texto_comentario' => 'texto_comentario por defecto', 'idPala' => 'idPala por defecto');

		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$pala = array('nombre' => $row['nombre'], 'precio' => $row['precio'], 'descripcion' => $row['descripcion'], 
						  'tipo_jugador' => $row['tipo_jugador'], 'caracteristicas' => $row['caracteristicas'], 'enlace' 
						  => $row['enlace'], 'foto1' => $row['foto1'], 'foto2' => $row['foto2'], 'foto3' => $row['foto3'], 
						  'nombre_comentario' => $row['nombre_comentario'], 'fecha_comentario' => $row['fecha_comentario'], 
						  'texto_comentario' => $row['texto_comentario'], 'idPala' => $idPala);
		}

		return $pala;
	}
  
	function getPalabras() {
		$mysqli = connect();
		
		$res = $mysqli->query("SELECT palabra FROM Palabras_Prohibidas");
               $palabras=array();
               
		if ($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$palabras[] = $row['palabra'];
			}
		}

		return $palabras;
	}
	
	function getUsuario($user) {
		$mysqli = connect();
		
		$res = $mysqli->query("SELECT Nombre_usuario, Contraseña, Tipo_usuario FROM Usuarios WHERE Nombre_usuario='$user'");

		$usuario = array('nombre' => 'nombre_ por defecto', 'contraseña' => 'contraseña por defecto', 'tipo' => 'tipo por defecto');
		
		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$usuario = array('nombre' => $row['Nombre_usuario'], 'contrasena' => $row['Contraseña'], 'tipo' => $row['Tipo_usuario']);
		}

		$_SESSION['prueba'] = $usuario['contrasena'];
		$_SESSION['tipo'] = $usuario['tipo'];

		return $usuario;
	}
	
	
	function comprobarUsuario($pass) {
		if (password_verify($pass, $_SESSION['prueba']))
		  return true;

		return false;
	}
	
	
// Lo que aparece en el "hash" se ha obtenido de:
// password_hash('passwordSuperSeguro', PASSWORD_DEFAULT)  ---->  $2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O
// password_hash('otroPassword', PASSWORD_DEFAULT)  ---->  $2y$10$XfxLjcJB.54YreU8SOr1y.vEeRMnuu6izd0xAZwSeuQQZGyJ1TT.y 
	$usuarios = [ ['nick' => 'Manuel', 'pass' => '$2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O', 'super' => true],
                ['nick' => 'Contreritas', 'pass' => '$2y$10$XfxLjcJB.54YreU8SOr1y.vEeRMnuu6izd0xAZwSeuQQZGyJ1TT.y', 'super' => false]
              ];
  
  
  // Devuelve true si existe un usuario con esa contraseña
  function checkLogin($nick, $pass) {
    global $usuarios;
    
    for ($i = 0 ; $i < sizeof($usuarios) ; $i++) {
      if ($usuarios[$i]['nick'] === $nick) {
       
        if (password_verify($pass, $usuarios[$i]['pass'] )) {
          return true;
        }
      }
    }
    
    return false;
  }
  
  // Devuelve la información de un usuario a partir de su nick 
  function getUser($nick) {
    global $usuarios;
    
    for ($i = 0 ; $i < sizeof($usuarios) ; $i++) {
      if ($usuarios[$i]['nick'] === $nick) {
        return $usuarios[$i];
      }
    }
    
    return 0;
  }
?>