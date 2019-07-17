<?php
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
        $sql = "SELECT * FROM DATOS_DENUNCIA";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        //$sql = "SELECT * FROM DENUNCIA WHERE BAJA=0 AND ID=:ID";
        $sql = "SELECT * FROM (SELECT DATOS_DENUNCIA.*,GESTIONA.ID AS IDGESTION,GESTIONA.FECHA AS FECHAGESTION,GESTIONA.DESCRIPCION,GESTIONA.HTML FROM DATOS_DENUNCIA LEFT JOIN GESTIONA ON DATOS_DENUNCIA.IDDENUNCIA = GESTIONA.IDDENUNCIA) TT WHERE IDDENUNCIA=:ID";
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
        $sql = "SELECT DATOS_DENUNCIA.IDDENUNCIA, DATOS_DENUNCIA.IDUSUARIO,DATOS_DENUNCIA.FECHADENUNCIA,DATOS_DENUNCIA.TIPO,DATOS_DENUNCIA.IDOBJETO,DATOS_DENUNCIA.COMENTARIO,DATOS_DENUNCIA.ESTADO,GESTIONA.ID AS IDGESTIONA,GESTIONA.IDUSUARIO as IDUSUARIOADMIN,GESTIONA.FECHA,GESTIONA.DESCRIPCION,USUARIO.USUARIO FROM DATOS_DENUNCIA,GESTIONA,USUARIO WHERE DATOS_DENUNCIA.IDDENUNCIA=GESTIONA.IDDENUNCIA AND DATOS_DENUNCIA.ESTADO='EN PROCESO' AND GESTIONA.IDUSUARIO=:ID AND GESTIONA.IDUSUARIO=USUARIO.ID";
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
    public function altaAsigna($obj, $conex){
        $id= trim($obj->getId());
        $sql = "UPDATE DENUNCIA SET ESTADO='EN PROCESO' WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function resIncidencia($obj, $conex){
        $id= trim($obj->getId());
        $sql = "UPDATE DENUNCIA SET ESTADO='CERRADA' WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
}
?>