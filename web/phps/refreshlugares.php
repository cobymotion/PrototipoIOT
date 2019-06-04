<?php
/**
 * Servicio web que recibe la peticiòn para la consulta de los datos
 * la pagina genera un JSON con los datos para ser consumidos
 */

require("connect.php");
require("Conexion.php");
require("Lugares.php");

$conn = new Conexion($conData);

$c = new Lugares($conn->getConnection());

$res = $c->getEstadoLugares();

if($res['estado']=='OK')
    echo json_encode($res['datos']);
else
    echo json_encode($res['estado']);