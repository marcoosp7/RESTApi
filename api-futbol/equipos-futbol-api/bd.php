<?php
class BaseDatosEquiposFutbol {
	private $conexion;

	public function __construct() {
		try {
			// Establecer la conexión a la base de datos
			$this->conexion = new PDO("mysql:host=localhost;dbname=equipos", "root", ""); // es localhost
			// Configurar PDO para que lance excepciones en caso de errores
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Error al conectarse a la base de datos: " . $e->getMessage());
		}
	}

	public function cargarTodosEquipos() {
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT * FROM EquiposFutbol");
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function cargarEquiposCiudad($ciudad) {
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT * FROM EquiposFutbol WHERE ciudad=?");
			// Añadir datos
			$consulta->bindParam(1, $ciudad);
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function cargarEquipo($id) {
		// saco el array del equipo para modificarlo abajo
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT * FROM EquiposFutbol WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $id);
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function modificarEquipo($datos) {
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("UPDATE EquiposFutbol SET nombre=?, ciudad=?, estadio=?, num_socios=?, fecha_creacion=? WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $datos["nombre"]);
			$consulta->bindParam(2, $datos["ciudad"]);
			$consulta->bindParam(3, $datos["estadio"]);
			$consulta->bindParam(4, $datos["num_socios"]);
			$consulta->bindParam(5, $datos["fecha_creacion"]);
			$consulta->bindParam(6, $datos["id"]);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}


	public function borrarEquipo($datos){
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("DELETE FROM EquiposFutbol WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $datos['id']);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function insertarEquipo($datos) {
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("INSERT INTO EquiposFutbol ".
				"(nombre, ciudad,num_socios, estadio, fecha_creacion) VALUES (?,?,?,?,?)");
			// Añadir datos
			$consulta->bindParam(1, $datos["nombre"]);
			$consulta->bindParam(2, $datos["ciudad"]);
			$consulta->bindParam(3, $datos["num_socios"]);
			$consulta->bindParam(4, $datos["estadio"]);
			$consulta->bindParam(5, $datos["fecha_creacion"]);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}




}
?>