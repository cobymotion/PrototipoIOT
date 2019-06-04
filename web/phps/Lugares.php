<?php
/***
 * Class Lugares
 * Clase con las dos tareas que realizara el prototipo
 * Luis Cobiàn 2 de Junio 2019
 */

class Lugares
{
    private $conn;

    /**
     * Lugares constructor.
     * @param $conn datos de la conexion
     */
    public function __construct($conn){
        $this->conn = $conn;
    }

    /**
     * Clase para consultar el estado de los estacionamientos
     * @return retorna los datos o en su defecto el error que ocurrio
     */
    public function getEstadoLugares(){
        $R['estado'] = "OK";
        $c = $this->conn;
        try {
            $sql = $c->query("SELECT * FROM Lugares");
            $R['datos'] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExeption $e){
            $R['estado'] = "ERROR: ".$e->getMessage();
        }
        return $R;
    }

    /**
     * Metodo que permite cambiar el estado de los estacionamientos
     * @param $idLugar id que identifica al lugar
     * @param $ocupacion estado que manda el sensor
     * @return regresa un valor de OK o en su defecto regresa el error
     */
    public function setOcupacion($idLugar, $ocupacion){
        $R['estado'] = "OK";
        $c = $this->conn;
        try{
            $sql = $c->prepare("UPDATE Lugares SET ocupado=:Ocupado WHERE idLugares=:Lugar");
            $sql->execute(array('Lugar'=>$idLugar,
                'Ocupado'=>$ocupacion));
            $conn = null;
        }catch(PDOExeption $e){
            $R['estado'] = "ERROR: ".$e->getMessage();
        }
        return $R;
    }


}