<?php
class PersistenciaPregunta{
    public function agregar($obj, $conex){
        $idUsuario = $obj->getIdUsuario();
        $idPublicacion = $obj->getIdPublicacion();
        $mensaje= $obj->getMensaje();
        $sql = "insert into PREGUNTA(IDUSUARIO, IDPUBLICACION, MENSAJE) values 
        (:IDUSUARIO, :IDPUBLICACION, :MENSAJE)";

        $result = $conex->prepare($sql);        
        $result->execute(array(":IDUSUARIO" => $idUsuario, 
            ":IDPUBLICACION" => $idPublicacion,
            ":MENSAJE" => $mensaje));
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function modificar($obj, $conex){
        if($result){
            return(true);
        }else{
            return(false);
        }
    }
    public function consCantPreg($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT COUNT(MENSAJE) FROM PREGUNTA WHERE IDPUBLICACION=:IDPUBLICACION AND IDUSUARIO!=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
            ":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consultaPregPublicacion($obj, $conex){
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT * FROM PREGUNTA WHERE IDPUBLICACION=:IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consultaPregUsuPublicacion($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $SQL = "SELECT * FROM PREGUNTA WHERE IDPUBLICACION=:IDPUBLICACION AND IDUSUARIO=6";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
            ":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consultaPregUsuVentas($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT PREGUNTA.ID,PREGUNTA.ESTADO,PREGUNTA.FECHAM,USUARIO.USUARIO,PUBLICACION.TITULO FROM PREGUNTA, CREA,USUARIO,PUBLICACION WHERE PREGUNTA.IDUSUARIO=USUARIO.ID AND PREGUNTA.IDPUBLICACION=PUBLICACION.ID AND PREGUNTA.IDPUBLICACION=CREA.IDPUBLICACION AND CREA.IDUSUARIO=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consultaPregUsuCompras($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT PREGUNTA.ID,PREGUNTA.ESTADO,PREGUNTA.FECHAM,USUARIO.USUARIO,PUBLICACION.TITULO FROM PREGUNTA,USUARIO,PUBLICACION WHERE PREGUNTA.IDUSUARIO=USUARIO.ID AND PREGUNTA.IDPUBLICACION=PUBLICACION.ID AND IDUSUARIO=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT DATOS_CHAT.*,PUBLICACION.TITULO FROM DATOS_CHAT,PUBLICACION WHERE DATOS_CHAT.IDPUBLICACION=PUBLICACION.ID AND DATOS_CHAT.IDPREGUNTA=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }

    public function consTodosEstado($obj, $conex){
        $estado= trim($obj->getEstado());
        $sql = "SELECT DATOS_CHAT.*,PUBLICACION.TITULO FROM DATOS_CHAT,PUBLICACION WHERE DATOS_CHAT.IDPUBLICACION=PUBLICACION.ID AND ESTADO=:ESTADO";
        $result = $conex->prepare($sql);
        $result->execute(array(":ESTADO" => $estado));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consTodos($conex){
        $sql = "SELECT DATOS_CHAT.*,PUBLICACION.TITULO FROM DATOS_CHAT,PUBLICACION WHERE DATOS_CHAT.IDPUBLICACION=PUBLICACION.ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consTodosPublicacion($conex){
        $sql = "SELECT COUNT(DATOS_CHAT.IDPREGUNTA) as CANTIDAD,DATOS_CHAT.IDPUBLICACION,PUBLICACION.TITULO FROM DATOS_CHAT,PUBLICACION WHERE DATOS_CHAT.IDPUBLICACION=PUBLICACION.ID GROUP BY DATOS_CHAT.IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function baneoMen($obj, $conex) {
        $id = $obj->getId();
        $estado = $obj->getEstado();
        $sql = "UPDATE PREGUNTA SET ESTADO=:ESTADO WHERE ID=:ID";
        $result = $conex->prepare($sql);        
        $result->execute(array(":ID" => $id,
                                ":ESTADO" => $estado));
        if($result) {
            return(true);
        }else{
            return(false);
        }
    }
}
?>