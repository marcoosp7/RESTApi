<?php
/**
 *	PUT => Modifica los datos de un equipo
 */
require_once("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
	if ($_GET["nombre"] == "") {
		echo json_encode("{'error':'Falta nombre'}");
		
	}else if ($_GET["ciudad"] == "") {
		echo json_encode("{'error':'Falta ciudad'}");
		
	}else if ($_GET["estadio"] == "") {
		echo json_encode("{'error':'Falta estadio'}");
		
	}else if ($_GET["num_socios"] == "") {
		echo json_encode("{'error':'Falta num_socios'}");
		
	}else if ($_GET["fecha_creacion"] == "") {
		echo json_encode("{'error':'Falta fecha de creación'}");
		
	}else{
		$bd = new BaseDatosEquiposFutbol();
		$resBdd = $bd->modificarEquipo($_GET);
		header("HTTP/1.1 200 OK");
		echo json_encode($resBdd);
	}
}else{  // si no es ningún método autorizado
	header("HTTP/1.1 400 Bad Request");
}

?>