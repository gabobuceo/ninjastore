<?php
/*
private $id;
private $usuario;
private $accion;
private $descripcion;
private $baja;

$id= trim($obj->getId());
$usuario= trim($obj->getUsuario());
$accion= trim($obj->getAccion());
$descripcion= trim($obj->getDescripcion());
$baja= trim($obj->getBaja());
*/
class PersistenciaHistorial{
    public function agregar($obj, $conex){
        $usuario= trim($obj->getUsuario());
        $accion= trim($obj->getAccion());
        $descripcion= trim($obj->getDescripcion());
        $sql = "INSERT INTO HISTORIAL (USUARIO,ACCION,DESCRIPCION) VALUES (:USUARIO,:ACCION,:DESCRIPCION)";
        $result = $conex->prepare($sql);
        $result->execute(array(":USUARIO" => $usuario,
                                ":ACCION" => $accion,
                                ":DESCRIPCION" => $descripcion));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function eliminar($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "UPDATE HISTORIAL SET BAJA=1 WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function consTodos($obj, $conex){
        $sql = "SELECT * FROM HISTORIAL";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM HISTORIAL WHERE BAJA=0 AND ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
}
?>