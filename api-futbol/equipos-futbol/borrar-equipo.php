<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web con B.DD.</title>
<?php
	$url = "http://localhost/PHP/2ºTRIMESTRE/RESTapi/RESTapi/api-futbol/equipos-futbol-api/borrar.php?";
	$url.= "id=".$_GET['id'];


	// preparo la petición con los datos por $_GET
	$ch = curl_init($url);
	// esto hace que sea PUT
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	// le digo que espero respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// lanzar la petición
	$json_response = curl_exec($ch);
	// decodifico el resultado obtenido
	$data = json_decode($json_response, true);
    // cierro el canal de comunicación
    curl_close($ch);

    include("listar-equipos.php");
?>

</body>



</html>
