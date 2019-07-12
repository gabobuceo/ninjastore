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
    public function consAsignado($obj, $conex){
        $idDenuncia= trim($obj->getDenuncia());
        $sql = "SELECT * FROM GESTIONA WHERE IDDENUNCIA=:IDDENUNCIA";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDDENUNCIA" => $idDenuncia));
        $resultados=$result->fetchAll();
        return $resultados;
    }
}
?>