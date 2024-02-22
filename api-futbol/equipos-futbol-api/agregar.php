<?php
    // si el metodo es post y no va sin valores, llamo a la funcion para insertar en bdd
    require_once("bd.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_GET == ""){
            // si va vacio (es generico, no controlo cada variable, es para hacerlo más corto)
            echo json_encode("{'error':'Faltan valores'}");
        }else{
            $bd = new BaseDatosEquiposFutbol();
            $resBdd = $bd->insertarEquipo($_GET); // le paso los valores que he obtenido
            header("HTTP/1.1 200 OK");
            echo json_encode($resBdd);
        }
    }