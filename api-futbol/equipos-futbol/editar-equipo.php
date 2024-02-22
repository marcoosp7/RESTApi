<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web con B.DD.</title>
	<style>
		table	{	border: 1px solid black;	padding: 2px 5px;	min-width: 500 px;	}
		tr, td 	{	border: 1px solid black;	padding: 2px 5px;	}
		th	 	{	border: 1px solid black;	padding: 2px 5px;	font-weight: bold;	}
	</style>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$url = "http://172.17.254.254/equipos-futbol-api/equipo.php?id=" . $_GET['id'];

	// abro la conexión GET... sí, es como abrir un archivo
	$con = fopen($url, "r");
	$res = "";
	// mientras haya datos...
	while (!feof($con)) {
		// leo caracter a caracter (hay otras formas posibles)
		$car = fgetc($con);
		$res.= $car;
	}
	// cierro la conexión... SIEMPRE!
	fclose($con);
	// como es un JSON, lo decodifico
	$res = json_decode($res, true);
?>
</head>
<body>
	<br/>
	<div style="width:50%; margin: 0 auto;">
		<form method="post">
			<input type="hidden" name="id" value="<?=$res['id'] ?>">
			<table>
				<tr>
					<td>Nombre</td>
					<td><input name="nombre" value="<?=$res['nombre'] ?>" required="required"></td>
				</tr>
				<tr>
					<td>Ciudad</td>
					<td><input name="ciudad" value="<?=$res['ciudad'] ?>" required="required"></td>
				</tr>
				<tr>
					<td>Núm. socios</td>
					<td><input name="num_socios" value="<?=$res['num_socios'] ?>" required="required"></td>
				</tr>
				<tr>
					<td>Estadio</td>
					<td><input name="estadio" value="<?=$res['estadio'] ?>" required="required"></td>
				</tr>
				<tr>
					<td>Fecha de creación</td>
					<td><input name="fecha_creacion" value="<?=$res['fecha_creacion'] ?>" required="required"></td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit">Modificar</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<br/><br/><br/><br/>
</body>
<?php
}else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$url = "http://172.17.254.254/equipos-futbol-api/modif.php?";
	$url.= "id=".$_POST['id']."&";
	$url.= "nombre=".urlencode($_POST['nombre'])."&";
	$url.= "ciudad=".urlencode($_POST['ciudad'])."&";
	$url.= "num_socios=".urlencode($_POST['num_socios'])."&";
	$url.= "estadio=".urlencode($_POST['estadio'])."&";
	$url.= "fecha_creacion=".urlencode($_POST['fecha_creacion']);

	// preparo la petición con los datos por $_GET
	$ch = curl_init($url);
	// esto hace que sea PUT
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	// le digo que espero respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// lanzar la petición
	$json_response = curl_exec($ch);
	// decodifico el resultado obtenido
	$data = json_decode($json_response, true);
    // cierro el canal de comunicación
    curl_close($ch);
?>
	<script type="text/javascript">
		setTimeout(() => {
			location.href = "listar-equipos.php";
		}, 2500);
	</script>
</head>
<body>
		<h1>Datos modificados</h1>
		Se redireccionará al listado en 2,5 segundos.
</body>
<?php
}
?>
</html>
