<?php
$resultado['estado'] = "Error";
$datos = json_decode(file_get_contents("php://input"));

require("connect.php");
require("Conexion.php");
require("Lugares.php");

$conn = new Conexion($conData);

$c = new Lugares($conn->getConnection());

$resultado = $c->setOcupacion($datos->idLugar, $datos->ocupacion);

echo json_encode($resultado);
