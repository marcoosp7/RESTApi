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
		a		{ 	font-weight: bolder;	color: blue;	border: 2px dashed blue;	cursor: pointer;}
	</style>
</head>
<body>
<?php

	$url = "http://localhost/PHP/2ºTRIMESTRE/RESTapi/RESTapi/api-futbol/equipos-futbol-api/listar.php";
	// si hay ciudad, llamo a la API con ella
	if (isset($_GET['ciudad']) && $_GET['ciudad']!="") {
		$url .= "?ciudad=" . $_GET['ciudad'];
	}

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
	<br/>
	<div style="width:90%; margin: 0 auto;">
		<table>
			<tr>
				<th>Nombre</th>
				<th>Ciudad</th>
				<th>Núm. socios</th>
				<th>Estadio</th>
				<th>Fecha de creación</th>
				<th>Acciones</th>
			</tr>
			<tr>
				<form>
					<td></td>
					<td><input placeholder="Filtrar por ciudad" name="ciudad" id="ciudad"></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<button type="submit">Filtrar</button>
						<a type="submit" name="agregarBtn" onclick="location.href='agregar-equipo.php'">Agregar</a>
					</td>
				</form>
			</tr>
<?php
	foreach ($res as $equipo) {
		echo "<tr>\n";
		echo "  <td>{$equipo['nombre']}</td>\n";
		echo "  <td>{$equipo['ciudad']}</td>\n";
		echo "  <td>{$equipo['num_socios']}</td>\n";
		echo "  <td>{$equipo['estadio']}</td>\n";
		echo "  <td>{$equipo['fecha_creacion']}</td>\n";
?>
<td><button onclick="location.href='editar-equipo.php?id=<?php echo $equipo['id'] ?>'">Editar</button></td>
<td><button onclick="location.href='borrar-equipo.php?id=<?php echo $equipo['id'] ?>'">Borrar</button></td>
<?php
		echo "</tr>\n";
	}
?>
		</table>
	</div>
	<br/><br/><br/><br/>
</body>
</html>