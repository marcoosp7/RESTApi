<?php
/**
 *	GET         => Muestra todos los equipos de la b.dd.
 *	GET[ciudad] => Muestra todos los equipos de una ciudad
 */
require_once("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["ciudad"]) && $_GET["ciudad"]!="") {
		buscarPorCiudad($_GET["ciudad"]);
	}else{
		buscarTodos();
	}

}else{  // si no es ningún método autorizado
	header("HTTP/1.1 400 Bad Request");
}

function buscarTodos() {
	$bd = new BaseDatosEquiposFutbol();
	$equipos = $bd->cargarTodosEquipos();
	header("HTTP/1.1 200 OK");
	echo json_encode($equipos);
}

function buscarPorCiudad($ciudad) {
	$bd = new BaseDatosEquiposFutbol();
	$equipos = $bd->cargarEquiposCiudad($ciudad);
	header("HTTP/1.1 200 OK");
	echo json_encode($equipos);
}






/* function buscarPorCiudad2($ciudad) {
	header("HTTP/1.1 200 OK");
	echo json_encode((new BaseDatosEquiposFutbol())->cargarEquiposCiudad($ciudad));
}  */

?>