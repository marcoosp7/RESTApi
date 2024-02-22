<?php
/**
 *	GET[id] => Muestra el equipos con una ID específica
 */
require_once("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["id"]) && $_GET["id"]!="") {
		$bd = new BaseDatosEquiposFutbol();
		$equipo = $bd->cargarEquipo($_GET["id"]);
		header("HTTP/1.1 200 OK");
		echo json_encode($equipo);
	}
}else{  // si no es ningún método autorizado
	header("HTTP/1.1 400 Bad Request");
}
?>