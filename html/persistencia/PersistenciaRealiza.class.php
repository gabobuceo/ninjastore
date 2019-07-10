<?php
/*
CREATE TABLE REALIZA (
    IDDENUNCIA      BIGINT(20)      UNSIGNED NOT NULL,
    IDUSUARIO       BIGINT(20)      UNSIGNED NOT NULL,
    BAJA            BOOLEAN         DEFAULT 0,
    PRIMARY KEY     (IDDENUNCIA,IDUSUARIO),
    FOREIGN KEY     (IDUSUARIO) REFERENCES USUARIO(ID),
    FOREIGN KEY     (IDDENUNCIA) REFERENCES DENUNCIA(ID)
);

    private $iddenuncia;
    private $idusuario;
    private $baja;
*/
class PersistenciaRealiza{
    public function agregar($obj, $conex){
        $iddenuncia= trim($obj->getIdDenuncia());
        $idusuario= trim($obj->getIdUsuario());
        $sql = "INSERT INTO REALIZA (IDDENUNCIA,IDUSUARIO) VALUES (:IDDENUNCIA,:IDUSUARIO)";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDDENUNCIA" => $iddenuncia,
                                ":IDUSUARIO" => $idusuario));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    /*
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
    public function consAbiertas($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM DATOS_DENUNCIA WHERE ESTADO='ABIERTA' AND IDUSUARIO=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consCerradas($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM DATOS_DENUNCIA WHERE ESTADO='CERRADA' AND IDUSUARIO=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }*/
}
?>