<?php
/**
 *	DELETE => borra los datos de un equipo
 */
require_once("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
	if ($_GET["id"] == "") {
		echo json_encode("{'error':'Falta id'}");
		
	}else{
		$bd = new BaseDatosEquiposFutbol();
		$resBdd = $bd->borrarEquipo($_GET);
		header("HTTP/1.1 200 OK");
		echo json_encode($resBdd);
	}
}else{  // si no es ningún método autorizado
	header("HTTP/1.1 400 Bad Request");
}

?>