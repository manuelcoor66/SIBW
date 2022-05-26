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
		
		$res = $mysqli->query("SELECT * FROM Usuarios WHERE Nombre_usuario='$user'");

		$usuario = array('nombre' => 'nombre_usuario por defecto', 'apellidos' => 'nombre_usuario por defecto', 'email' => 'email por defecto', 'usuario' => 'nombre_usuario por defecto', 'contraseña' => 'contraseña por defecto', 'tipo' => 'tipo por defecto');
		
		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$usuario = array('nombre' => $row['Nombre'], 'apellidos' => $row['Apellidos'], 'email' => $row['Email'], 'usuario' => $row['Nombre_usuario'], 'contrasena' => $row['Contraseña'], 'tipo' => $row['Tipo_usuario']);
		}

		$_SESSION['prueba'] = $usuario['contrasena'];

		return $usuario;
	}	
	
	function comprobarUsuario($pass) {
		if (password_verify($pass, $_SESSION['prueba']))
		  return true;

		return false;
	}

	function actualizarUsuario($nombre, $apellidos, $email, $usuario, $contrasena) {
		$mysqli = connect();

		$usuario_original = $_SESSION['usuario'];
		$hash = password_hash($contrasena, PASSWORD_DEFAULT);
		
		$mysqli->query("UPDATE `Usuarios` SET `Nombre`='$nombre',`Apellidos`='$apellidos',`Email`='$email',`Nombre_usuario`='$usuario',`Contraseña`='$hash' WHERE `Nombre_usuario`='$usuario_original'");
	}

	function registrarUsuario($nombre, $apellidos, $email, $usuario, $contrasena) {
		$mysqli = connect();

		$hash = password_hash($contrasena, PASSWORD_DEFAULT);
		
		$res = $mysqli->query("INSERT INTO Usuarios (Nombre, Apellidos, Email, Nombre_usuario, Contraseña, Tipo_usuario) VALUES ('$nombre','$apellidos','$email','$usuario','$hash','1')");
	}

	function cantidadUsuarios($user) {
		$mysqli = connect();
		
		$res = $mysqli->query("SELECT COUNT(*) FROM Usuarios WHERE Nombre_usuario='Manuel'");

		$usuario = array('cantidad' => 'cantidad por defecto');
		
		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$usuario = array('cantidad' => $row['COUNT(*)']);
		}

		return $usuario;
	}

	function totalUsuarios($user) {
		$mysqli = connect();
		
		$res = $mysqli->query("SELECT COUNT(*) FROM Usuarios");

		$usuario = array('cantidad' => 'cantidad por defecto');
		
		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$usuario = array('cantidad' => $row['COUNT(*)']);
		}

		return $usuario;
	}


?>