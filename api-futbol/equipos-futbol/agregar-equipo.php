<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web con B.DD.</title>
</head>
<body>
	<br/>
	<div style="width:80%; margin: 0 auto;">
		<form method="post" >
            Nombre:
            <input type="text" name="nombre"required="required"><br>
            Ciudad:
            <input type="text" name="ciudad"required="required"><br>
            Núm. socios:
            <input type="number" name="num_socios"required="required"><br>
            Estadio:
            <input type="text" name="estadio" required="required"><br>
            Fecha de creación:
            <input type="date" name="fecha_creacion" required="required"> <br> 
        
            <button type="submit">INSERTAR</button>					
		</form>
	</div>
	<br/><br/><br/><br/>
</body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $url = "http://localhost/PHP/2ºTRIMESTRE/RESTapi/RESTapi/api-futbol/equipos-futbol-api/agregar.php?";
        $url.= "nombre=".urlencode($_POST['nombre'])."&";
        $url.= "ciudad=".urlencode($_POST['ciudad'])."&";
        $url.= "num_socios=".urlencode($_POST['num_socios'])."&";
        $url.= "estadio=".urlencode($_POST['estadio'])."&";
        $url.= "fecha_creacion=".urlencode($_POST['fecha_creacion']);

        // preparo la petición con los datos por $_GET
        $ch = curl_init($url);
        // esto hace que sea POST
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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
        }, 1500);
	</script>
<?php
    }
?>
    

</html>
