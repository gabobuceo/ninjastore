<?php
/*
CREATE TABLE DENUNCIA(
    ID              SERIAL          NOT NULL,
    FECHA           TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    TIPO            VARCHAR(15)     NOT NULL,
    IDOBJETO        BIGINT(20)      UNSIGNED NOT NULL,
    COMENTARIO      VARCHAR(150),
    ESTADO          VARCHAR(10)     DEFAULT 'ABIERTA',
    BAJA            BOOLEAN         DEFAULT 0,
    PRIMARY KEY     (ID),
    INDEX           (IDOBJETO),
    CHECK           (TIPO='PUBLICACION' AND TIPO='COMENTARIO' AND TIPO='COMPRA' AND TIPO='CATEGORIAS' AND TIPO='USUARIO'),
    CHECK           (ESTADO='ABIERTA' AND ESTADO='CERRADA' AND ESTADO='EN PROCESO')
);
    private $id;
    private $fecha;
    private $tipo;
    private $idobjeto;
    private $comentario;
    private $estado;
    private $baja;
*/
class PersistenciaDenuncia{
    public function agregar($obj, $conex){
        $tipo= trim($obj->getTipo());
        $idobjeto= trim($obj->getIdobjeto());
        $comentario= trim($obj->getComentario());
        $sql = "INSERT INTO DENUNCIA (TIPO,IDOBJETO,COMENTARIO) VALUES (:TIPO,:IDOBJETO,:COMENTARIO)";
        $result = $conex->prepare($sql);
        $result->execute(array(":TIPO" => $tipo,
                                ":IDOBJETO" => $idobjeto,
                                ":COMENTARIO" => $comentario));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function eliminar($obj, $conex){
        $id= trim($obj->getId());
        $sql = "UPDATE DENUNCIAS SET BAJA=1 WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function consTodos($conex){
        $sql = "SELECT * FROM DENUNCIA WHERE BAJA=0";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM DENUNCIA WHERE BAJA=0 AND ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consAbiertas($conex){
        $sql = "SELECT * FROM DATOS_DENUNCIA WHERE ESTADO='ABIERTA'";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consAsignadas($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM DATOS_DENUNCIA WHERE ESTADO='EN PROCESO'";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consCerradas($conex){
        $sql = "SELECT * FROM DATOS_DENUNCIA WHERE ESTADO='CERRADA'";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consMaxID($conex){
        $sql = "SELECT MAX(ID) FROM DENUNCIA";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
}
?>