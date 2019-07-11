<?php
class PersistenciaUsuario{
    public function agregar($obj, $conex){
        $cedula = $obj->getCedula();
        $usuario = $obj->getUsuario();
        $password= $obj->getPassword();
        $pNombre = $obj->getPNombre();
        $pApellido = $obj->getPApellido();
        $fNacimiento = $obj->getFecNac();
        $email = $obj->getEmail();
        $rol = $obj->getRol();
        $password=sha1($password);

        $sql = "INSERT INTO USUARIO (CEDULA,USUARIO,PASSWORD,PNOMBRE,PAPELLIDO,FNACIMIENTO,EMAIL,ACTIVACION,ROL) VALUES
        (:CEDULA, :USUARIO, :PASSWORD, :PNOMBRE, :PAPELLIDO, :FNACIMIENTO,:EMAIL, :ACTIVACION, :ROL)";
        $result = $conex->prepare($sql);
        $result->execute(array(":CEDULA" => $cedula,
            ":USUARIO" => $usuario,
            ":PASSWORD" => $password,
            ":PNOMBRE" => $pNombre,
            ":PAPELLIDO" => $pApellido,
            ":FNACIMIENTO" => $fNacimiento,
            ":EMAIL" => $email,
            ":ROL" => $rol,
            ":ACTIVACION" => 0));
        if($result){
          return(true);
      }else{
          return(false);
      }
  }


  public function verificarLoginPassword($obj, $conex){
    $usuario= trim($obj->getUsuario());
    $password= sha1(trim($obj->getPassword()));
    $sql = "SELECT * FROM USUARIO WHERE USUARIO=:usuario AND PASSWORD=:password AND (ROL='ADMINISTRADOR' OR ROL='MODERADOR')";
    $consulta = $conex->prepare($sql);
    $consulta->execute(array(":usuario" => $usuario, ":password" => $password));
    $result = $consulta->fetchAll();
    return $result;
}

public function consTodos($conex){
    $sql = "select * from USUARIO";
    $result = $conex->prepare($sql);
    $result->execute();
    $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
    return $resultados;
}

public function consUno($obj, $conex){
    $id= trim($obj->getId());
    $sql = "SELECT * FROM USUARIO WHERE ID=:ID";

    $result = $conex->prepare($sql);
    $result->execute(array(":ID" => $id));
    $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario

    return $resultados;
}

public function consEmail($obj, $conex){
   $id= trim($obj->getEmail());
   $sql = "select * from us

   uario where email=:email";
   $result = $conex->prepare($sql);
   $result->execute(array(":email" => $email));
   $resultados=$result->fetchAll();
    	//Obtiene el registro de la tabla Usuario

   return $resultados;
}

public function adminalta($obj, $conex){
    $password= trim($obj->getpassword());
    $password=sha1($password);
    $cedula= trim($obj->getCedula());
    $usuario= trim($obj->getUsuario());
    $pnombre= trim($obj->getPNombre());
    $snombre= trim($obj->getSNombre());
    $papellido= trim($obj->getPApellido());
    $sapellido= trim($obj->getSApellido());
    $fnacimiento= trim($obj->getFecNac());
    $email= trim($obj->getEmail());
    $calle= trim($obj->getCalle());
    $numero= trim($obj->getNumero());
    $esquina= trim($obj->getEsquina());
    $cpostal= trim($obj->getCPostal());
    $localidad= trim($obj->getLocalidad());
    $departamento= trim($obj->getDepartamento());
    $tipo= trim($obj->getTipo());
    $rol= trim($obj->getRol());
    $sql = "INSERT USUARIO SET CEDULA=:CEDULA,USUARIO=:USUARIO,PASSWORD=:PASSWORD,PNOMBRE=:PNOMBRE,SNOMBRE=:SNOMBRE,PAPELLIDO=:PAPELLIDO,
    SAPELLIDO=:SAPELLIDO,FNACIMIENTO=:FNACIMIENTO,EMAIL=:EMAIL,CALLE=:CALLE,NUMERO=:NUMERO,
    ESQUINA=:ESQUINA,CPOSTAL=:CPOSTAL,LOCALIDAD=:LOCALIDAD,DEPARTAMENTO=:DEPARTAMENTO,TIPO=:TIPO,ROL=:ROL";
    $result = $conex->prepare($sql);
    $result->execute(array(":CEDULA" => $cedula,
        ":USUARIO" => $usuario,
        ":PASSWORD" => $password,
        ":PNOMBRE" => $pnombre,
        ":SNOMBRE" => $snombre,
        ":PAPELLIDO" => $papellido,
        ":SAPELLIDO" => $sapellido,
        ":FNACIMIENTO" => $fnacimiento,
        ":EMAIL" => $email,
        ":CALLE" => $calle,
        ":NUMERO" => $numero,
        ":ESQUINA" => $esquina,
        ":CPOSTAL" => $cpostal,
        ":LOCALIDAD" => $localidad,
        ":DEPARTAMENTO" => $departamento,
        ":TIPO" => $tipo,
        ":ROL" => $rol));
    return $result;
}

public function modificar($obj, $conex){
    $id= trim($obj->getId());
    $pnombre= trim($obj->getPNombre());
    $snombre= trim($obj->getSNombre());
    $papellido= trim($obj->getPApellido());
    $sapellido= trim($obj->getSApellido());
    $fnacimiento= trim($obj->getFecNac());
    $email= trim($obj->getEmail());
    $calle= trim($obj->getCalle());
    $numero= trim($obj->getNumero());
    $esquina= trim($obj->getEsquina());
    $cpostal= trim($obj->getCPostal());
    $localidad= trim($obj->getLocalidad());
    $departamento= trim($obj->getDepartamento());
    $sql = "UPDATE USUARIO SET PNOMBRE=:PNOMBRE,SNOMBRE=:SNOMBRE,PAPELLIDO=:PAPELLIDO,SAPELLIDO=:SAPELLIDO,FNACIMIENTO=:FNACIMIENTO,EMAIL=:EMAIL,CALLE=:CALLE,NUMERO=:NUMERO,ESQUINA=:ESQUINA,CPOSTAL=:CPOSTAL,LOCALIDAD=:LOCALIDAD,DEPARTAMENTO=:DEPARTAMENTO WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":PNOMBRE" => $pnombre,
        ":SNOMBRE" => $snombre,
        ":PAPELLIDO" => $papellido,
        ":SAPELLIDO" => $sapellido,
        ":FNACIMIENTO" => $fnacimiento,
        ":EMAIL" => $email,
        ":CALLE" => $calle,
        ":NUMERO" => $numero,
        ":ESQUINA" => $esquina,
        ":CPOSTAL" => $cpostal,
        ":LOCALIDAD" => $localidad,
        ":DEPARTAMENTO" => $departamento,
        ":ID"=>$id));
    return $result;
}

public function adminmodificar($obj, $conex){
    $id= trim($obj->getId());
    $cedula= trim($obj->getCedula());
    $usuario= trim($obj->getUsuario());
    $pnombre= trim($obj->getPNombre());
    $snombre= trim($obj->getSNombre());
    $papellido= trim($obj->getPApellido());
    $sapellido= trim($obj->getSApellido());
    $fnacimiento= trim($obj->getFecNac());
    $email= trim($obj->getEmail());
    $calle= trim($obj->getCalle());
    $numero= trim($obj->getNumero());
    $esquina= trim($obj->getEsquina());
    $cpostal= trim($obj->getCPostal());
    $localidad= trim($obj->getLocalidad());
    $departamento= trim($obj->getDepartamento());
    $tipo= trim($obj->getTipo());
    $rol= trim($obj->getRol());
    $sql = "UPDATE USUARIO SET CEDULA=:CEDULA,USUARIO=:USUARIO,PNOMBRE=:PNOMBRE,SNOMBRE=:SNOMBRE,PAPELLIDO=:PAPELLIDO,
    SAPELLIDO=:SAPELLIDO,FNACIMIENTO=:FNACIMIENTO,EMAIL=:EMAIL,CALLE=:CALLE,NUMERO=:NUMERO,
    ESQUINA=:ESQUINA,CPOSTAL=:CPOSTAL,LOCALIDAD=:LOCALIDAD,DEPARTAMENTO=:DEPARTAMENTO,TIPO=:TIPO,ROL=:ROL WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":CEDULA" => $cedula,
        ":USUARIO" => $usuario,
        ":PNOMBRE" => $pnombre,
        ":SNOMBRE" => $snombre,
        ":PAPELLIDO" => $papellido,
        ":SAPELLIDO" => $sapellido,
        ":FNACIMIENTO" => $fnacimiento,
        ":EMAIL" => $email,
        ":CALLE" => $calle,
        ":NUMERO" => $numero,
        ":ESQUINA" => $esquina,
        ":CPOSTAL" => $cpostal,
        ":LOCALIDAD" => $localidad,
        ":DEPARTAMENTO" => $departamento,
        ":TIPO" => $tipo,
        ":ROL" => $rol,
        ":ID"=>$id));
    return $result;
}

public function eliminar($obj, $conex){
    $id= trim($obj->getId());
    $baja= trim($obj->getBaja());
    $sql = "UPDATE USUARIO SET BAJA=:BAJA WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":ID"=>$id,
                           ":BAJA"=>$baja));
    return $result;
}
public function revivir($obj, $conex){
    $id= trim($obj->getId());
    $sql = "UPDATE USUARIO SET BAJA=0 WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":id"=>$id));
    return $result;
}
public function consCalificacion($obj, $conex){
    $id= trim($obj->getId());
    $sql = "CALL PROCALIFICACION(:ID)";
    $result = $conex->prepare($sql);
    $result->execute(array(":ID" => $id));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function actUsuario($obj, $conex){
    $id= trim($obj->getId());
    $estado= "ACTIVADO";
    $activacion= 0;
    $sql = "UPDATE USUARIO SET ESTADO=:ESTADO, ACTIVACION=:ACTIVACION WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":ESTADO" => $estado,
        ":ACTIVACION" => $activacion,
        ":ID" => $id));
    if($result){
        return(true);
    }else{
        return(false);
    }
}
public function BusActUsuario($obj, $conex){
    $usuario= trim($obj->getUsuario());
    $activacionkey= trim($obj->getActivacion());
    $sql = "SELECT ID FROM USUARIO WHERE ESTADO='CONFIRMAR EMAIL' AND BAJA=0 AND ACTIVACION=:activacionkey AND USUARIO=:usuario";
    $result = $conex->prepare($sql);
    $result->execute(array(":activacionkey" => $activacionkey,
        ":usuario" => $usuario));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function BusRecUsuario($obj, $conex){
    $usuario= trim($obj->getUsuario());
    $activacionkey= trim($obj->getActivacion());
    $sql = "SELECT ID FROM USUARIO WHERE ESTADO='RECUPERAR' AND BAJA=0 AND ACTIVACION=:activacionkey AND USUARIO=:usuario";
    $result = $conex->prepare($sql);
    $result->execute(array(":activacionkey" => $activacionkey,
        ":usuario" => $activacionkey));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function BusEmUsuario($obj, $conex){
    if ( $obj->getId() ) {
        $id= trim($obj->getId());
    }else{
        $id="";
    }
    if ( $obj->getUsuario() ) {
        $usuario= trim($obj->getUsuario()) ;
    }else{
        $usuario="";
    }
    $sql = "SELECT PNOMBRE,PAPELLIDO,EMAIL,ID,USUARIO FROM USUARIO WHERE ID=:ID OR USUARIO=:USUARIO";
    $result = $conex->prepare($sql);
    $result->execute(array(":ID" => $id,
       ":USUARIO" => $usuario));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function CamEstado($obj, $conex){
    $id= trim($obj->getId());
    $estado= trim($obj->getEstado());

    $sql = "UPDATE USUARIO SET ESTADO=:ESTADO WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":ESTADO" => $estado,
        ":ID" => $id));
    if($result){
      return(true);
  }else{
      return(false);
  }
}
public function CamTipo($obj, $conex){
    $id= trim($obj->getId());
    $tipo= trim($obj->getTipo());

    $sql = "UPDATE USUARIO SET TIPO=:TIPO WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":TIPO" => $tipo,
        ":ID" => $id));
    if($result){
      return(true);
  }else{
      return(false);
  }
}
public function CamRol($obj, $conex){
    $id= trim($obj->getId());
    $rol= trim($obj->getRol());

    $sql = "UPDATE USUARIO SET ROL=:ROL WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":ROL" => $rol,
        ":ID" => $id));
    if($result){
      return(true);
  }else{
      return(false);
  }
}
public function ConPassUsuario($obj, $conex){
    $id= trim($obj->getId());
    $password= trim($obj->getPassword());
    $password=sha1($password);

    $sql = "SELECT ID FROM USUARIO WHERE PASSWORD=:PASSWORD AND ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":PASSWORD" => $password,
        ":ID" => $id));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function CamPassUsuario($obj, $conex){
    $id= trim($obj->getId());
    $password= trim($obj->getPassword());
    $password=sha1($password);

    $sql = "UPDATE USUARIO SET PASSWORD=:PASSWORD WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":PASSWORD" => $password,
        ":ID" => $id));
    if($result){
      return(true);
  }else{
      return(false);
  }
}
public function consDatosVendedor($obj, $conex){
    $usuario= trim($obj->getId());
    $sql = "SELECT * FROM DATOS_PERSONA WHERE ID=:id";
    $result = $conex->prepare($sql);
    $result->execute(array(":id" => $usuario));
    $resultados=$result->fetchAll();
    return $resultados;
}

public function CamGeoUsuario($obj, $conex){
    $id= trim($obj->getId());
    $geox= trim($obj->getGeoX());
    $geoy= trim($obj->getGeoY());

    $sql = "UPDATE USUARIO SET GEOX=:GEOX,GEOY=:GEOY WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":GEOX" => $geox,
        ":GEOY" => $geoy,
        ":ID" => $id));
    if($result){
        return(true);
    }else{
        return(false);
    }
}

public function consPerfil($obj, $conex){
    $id= trim($obj->getId());
    $sql = "SELECT * FROM USUARIO WHERE ID=:ID";
    $result = $conex->prepare($sql);
    $result->execute(array(":ID" => $id));
    $resultados=$result->fetchAll();
    return $resultados;
}
public function BusUsuariosFrontend($conex){
    $sql = "SELECT * FROM USUARIO WHERE ROL='CLIENTE'";
    $result = $conex->prepare($sql);
    $result->execute();
    $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
    return $resultados;
}
public function BusUsuariosBackend($conex){
    $sql = "SELECT * FROM USUARIO WHERE ROL!='CLIENTE'";
    $result = $conex->prepare($sql);
    $result->execute();
    $resultados=$result->fetchAll();
        //Obtiene el registro de la tabla Usuario
    return $resultados;
}

}
?>
