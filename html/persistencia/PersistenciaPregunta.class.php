<?php
class PersistenciaPregunta
{
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
        //Para saber si ocurrió un error
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
    public function consUno($obj, $conex){
        $id= trim($obj->getId());
        $sql = "SELECT * FROM PREGUNTA WHERE ID=:ID";
        $result = $conex->prepare($sql);
        $result->execute(array(":ID" => $id));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consTodos($obj, $conex){
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT * FROM VWMENSAJES WHERE TIPO='PREGUNTA' AND IDPUBLICACION=:IDPUBLICACION ORDER BY FECHAM DESC";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion));
        $resultados=$result->fetchAll();
        return $resultados;
    }
    public function consCantPreg($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT COUNT(MENSAJE) FROM PREGUNTA WHERE IDPUBLICACION=:IDPUBLICACION AND IDUSUARIO!=:IDUSUARIO";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
                               ":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario

        return $resultados;
    }
    public function consultaPregPublicacion($obj, $conex){
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT * FROM PREGUNTA WHERE IDPUBLICACION=:IDPUBLICACION";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion));
        $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
        return $resultados;
    }
    public function consultaPregUsuPublicacion($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $idPublicacion= trim($obj->getIdPublicacion());
        $sql = "SELECT * FROM DATOS_CHAT WHERE IDPUBLICACION=:IDPUBLICACION AND IDCOMPRADOR=:IDCOMPRADOR";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDPUBLICACION" => $idPublicacion,
                               ":IDCOMPRADOR" => $idUsuario));
        $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
        return $resultados;
    }
    public function consultaPregUsuVentas($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT PREGUNTA.ID,PREGUNTA.ESTADO,PREGUNTA.FECHAM,USUARIO.USUARIO,PUBLICACION.TITULO,PREGUNTA.RESPUESTA FROM PREGUNTA, CREA,USUARIO,PUBLICACION WHERE PREGUNTA.IDUSUARIO=USUARIO.ID AND PREGUNTA.IDPUBLICACION=PUBLICACION.ID AND PREGUNTA.IDPUBLICACION=CREA.IDPUBLICACION AND CREA.IDUSUARIO=:IDUSUARIO ORDER BY PREGUNTA.FECHAM DESC";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
        return $resultados;
    }
    public function consultaPregUsuCompras($obj, $conex){
        $idUsuario= trim($obj->getIdUsuario());
        $sql = "SELECT PREGUNTA.ID,PREGUNTA.ESTADO,PREGUNTA.FECHAM,USUARIO.USUARIO,PUBLICACION.TITULO,PREGUNTA.RESPUESTA FROM PREGUNTA,USUARIO,PUBLICACION WHERE PREGUNTA.IDUSUARIO=USUARIO.ID AND PREGUNTA.IDPUBLICACION=PUBLICACION.ID AND IDUSUARIO=:IDUSUARIO ORDER BY PREGUNTA.FECHAM DESC";
        $result = $conex->prepare($sql);
        $result->execute(array(":IDUSUARIO" => $idUsuario));
        $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
        return $resultados;
    }
    public function RespPregunta($obj, $conex){
        $id = $obj->getId();
        $respuesta = $obj->getRespuesta();
        $sql = "UPDATE PREGUNTA SET RESPUESTA=:RESPUESTA,FECHAR=NOW() WHERE ID=:ID";
        $result = $conex->prepare($sql);        
        $result->execute(array(":RESPUESTA" => $respuesta, 
                                ":ID" => $id));
        if($result){
          return(true);
        }else{
          return(false);
        }
    }
    public function consMaxID($conex)
    {
        $sql = "SELECT MAX(ID) FROM PREGUNTA";

        $result = $conex->prepare($sql);
        $result->execute();
        $resultados=$result->fetchAll();
        
        return $resultados;
    }
}
?>

