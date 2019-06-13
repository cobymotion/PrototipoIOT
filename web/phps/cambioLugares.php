<?php
$resultado['estado'] = "Error";
///$datos = json_decode(file_get_contents("php://input"));

if(isset($_GET['lugar']) && isset($_GET['estado'])) {

    require("connect.php");
    require("Conexion.php");
    require("Lugares.php");

    $conn = new Conexion($conData);

    $c = new Lugares($conn->getConnection());
    //$idlugar = (int)$datos->idLugar;
    //$ocupacion = (int)$datos->ocupacion;

    $idlugar = (int)$_GET['lugar'];
    $ocupacion = (int)$_GET['estado'];

    $file = fopen("archivo.txt", "w");

    fwrite($file, "Datos: idLugar: " . $idlugar . " Ocupacion: " . $ocupacion . PHP_EOL);
    //fwrite($file, "Datos: idLugar: " . $datos->idLugar . " Ocupacion: " . $datos->ocupacion . PHP_EOL);

    fclose($file);

    $resultado = $c->setOcupacion($idlugar, $ocupacion);

    echo json_encode($resultado);
}