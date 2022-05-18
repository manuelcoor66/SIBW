<?php 
	function connect() {
		$mysqli = new mysqli("mysql", "manuelcoor66", "manuelcoor66", "Practica3");
		if ($mysqli->connect_errno) {
			echo ("Fallo al conectar: " . $mysqli->connect_error);
		}
		return $mysqli;
	}	
	   
	function getPala($idPala) {
		$mysqli = connect();

		$res = $mysqli->query("SELECT nombre, precio, descripcion, tipo_jugador, caracteristicas, enlace, foto1, foto2, foto3, nombre_comentario, fecha_comentario, texto_comentario FROM Productos WHERE id=" . $idPala);

		$pala = array('nombre' => 'nombre por defecto', 'precio' => 'precio por defecto', 'descripcion' => 'descripcion por defecto', 'tipo_jugador' => 'tipo_jugador por defecto', 'caracteristicas' => 'caracteristicas por defecto', 'enlace' => 'enlace por defecto', 'foto1' => 'foto1 por defecto', 'foto2' => 'foto2 por defecto', 'foto3' => 'foto3 por defecto', 'nombre_comentario' => 'nombre_comentario por defecto', 'fecha_comentario' => 'fecha_comentario por defecto', 'texto_comentario' => 'texto_comentario por defecto');

		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();

			$pala = array('nombre' => $row['nombre'], 'precio' => $row['precio'], 'descripcion' => $row['descripcion'], 'tipo_jugador' => $row['tipo_jugador'], 'caracteristicas' => $row['caracteristicas'], 'enlace' => $row['enlace'], 'foto1' => $row['foto1'], 'foto2' => $row['foto2'], 'foto3' => $row['foto3'], 'nombre_comentario' => $row['nombre_comentario'], 'fecha_comentario' => $row['fecha_comentario'], 'texto_comentario' => $row['texto_comentario'], 'idPala' => $idPala);
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
?>
