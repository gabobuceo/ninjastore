<?php
class PersistenciaFavorito
{
    public function agregar($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "INSERT INTO FAVORITO (IDUSUARIO,IDPUBLICACION) VALUES (:IDUSUARIO,:IDPUBLICACION)";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
                                ":IDUSUARIO" => $idUsuario));
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
    public function consTodos($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT FAVORITO.IDPUBLICACION,PUBLICACION.TITULO,PUBLICACION.IMGDEFAULT,PUBLICACION.PRECIO FROM FAVORITO, PUBLICACION WHERE FAVORITO.IDPUBLICACION=PUBLICACION.ID AND FAVORITO.IDUSUARIO=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consCinco($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT FAVORITO.IDPUBLICACION,PUBLICACION.TITULO,PUBLICACION.IMGDEFAULT,PUBLICACION.PRECIO FROM FAVORITO, PUBLICACION WHERE FAVORITO.IDPUBLICACION=PUBLICACION.ID AND FAVORITO.IDUSUARIO=:IDUSUARIO LIMIT 5";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT * FROM FAVORITO WHERE IDUSUARIO=:IDUSUARIO AND IDPUBLICACION=:IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
                                ":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
}
?>