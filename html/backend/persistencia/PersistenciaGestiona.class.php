<?php
class PersistenciaGestiona{
    public function agregar($obj, $conex){
        $idusuario= trim($obj->getIdUsuario());
        $iddenuncia= trim($obj->getDenuncia());
        $descripcion= trim($obj->getDescripcion());
        $html= trim($obj->getHtml());

        $SQL = "INSERT INTO GESTIONA (IDUSUARIO,IDDENUNCIA,DESCRIPCION,HTML) VALUES (:IDUSUARIO,:IDDENUNCIA,:DESCRIPCION,:HTML)";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idusuario,
            ":IDDENUNCIA" => $iddenuncia,
            ":DESCRIPCION" => $descripcion,
            ":HTML" => $html));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function eliminar($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "DELETE FROM FAVORITO WHERE IDUSUARIO=:IDUSUARIO AND IDPUBLICACION=:IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
            ":IDUSUARIO" => $idUsuario));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function modificacion($obj, $conex){
        /*$idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "DELETE FROM FAVORITO WHERE IDUSUARIO=:IDUSUARIO AND IDPUBLICACION=:IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
                                ":IDUSUARIO" => $idUsuario));
        if($result){
            return(true);
        }else{
            return(false);
        }*/
    }
    public function consTodos($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT FAVORITO.IDPUBLICACION,PUBLICACION.TITULO,PUBLICACION.IMGDEFAULT,PUBLICACION.PRECIO FROM FAVORITO, PUBLICACION WHERE FAVORITO.IDPUBLICACION=PUBLICACION.ID AND FAVORITO.IDUSUARIO=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM GESTIONA WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function altaAsigna($obj, $conex){
        $idusuario= trim($obj->getIdUsuario());
        $iddenuncia= trim($obj->getDenuncia());
        $sql = "INSERT INTO GESTIONA (IDUSUARIO,IDDENUNCIA) VALUES (:IDUSUARIO,:IDDENUNCIA)";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idusuario,
            ":IDDENUNCIA" => $iddenuncia));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function consAsignado($obj, $conex){
        $idDenuncia= trim($obj->getDenuncia());
        $sql = "SELECT DATOS_DENUNCIA.IDDENUNCIA, DATOS_DENUNCIA.IDUSUARIO,DATOS_DENUNCIA.FECHADENUNCIA,DATOS_DENUNCIA.TIPO,DATOS_DENUNCIA.IDOBJETO,DATOS_DENUNCIA.COMENTARIO,DATOS_DENUNCIA.ESTADO,GESTIONA.ID AS IDGESTIONA,GESTIONA.IDUSUARIO as IDUSUARIOADMIN,GESTIONA.FECHA,GESTIONA.DESCRIPCION,USUARIO.USUARIO FROM DATOS_DENUNCIA,GESTIONA,USUARIO WHERE DATOS_DENUNCIA.IDDENUNCIA=GESTIONA.IDDENUNCIA AND GESTIONA.IDDENUNCIA=:IDDENUNCIA AND GESTIONA.IDUSUARIO=USUARIO.ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDDENUNCIA" => $idDenuncia));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function altaReasigna($obj, $conex){
        $id= trim($obj->getId());
        $idusuario= trim($obj->getIdUsuario());
        $iddenuncia= trim($obj->getDenuncia());
        $sql = "UPDATE GESTIONA SET IDUSUARIO=:IDUSUARIO, IDDENUNCIA=:IDDENUNCIA WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idusuario,
            ":IDDENUNCIA" => $iddenuncia,
            ":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function resIncidencia($obj, $conex){
        $id= trim($obj->getId());
        $descripcion= trim($obj->getDescripcion());
        $html= trim($obj->getHtml());
        $sql = "UPDATE GESTIONA SET DESCRIPCION=:DESCRIPCION,HTML=:HTML WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":DESCRIPCION" => $descripcion,
            ":HTML" => $html,
            ":ID" => $id));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
}
?>