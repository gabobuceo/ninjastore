<!-- C O M I E N Z O    T A B  L A   O R I G I N A L +++++ ENLACES AL ACTIVAR, MUESTRA DE ESTADO -->
<h4>BUSCAR CATEGORIA</h4>
<div class="table-responsive">
  <table id="listopen" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Modificar</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
        <?php
          $datos_categorias = require_once('../logica/procesarCargaCategoria.php');
          // ------------   F O R    O R I G I N A L
             for ($i=0; $i < count($datos_categorias); $i++) {
               ?>
                <tr>
                  <td><?php echo utf8_encode($datos_categorias[$i]['TITULO'])?></td>
                    <?php
                    if ((($datos_categorias[$i]['PADRE'])==1)) {
                      ?><td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>&padre=1"</a> Modificar</td>
                      <?php
                        if ($datos_categorias[$i]['BAJA']==1) {
                          ?>
                          <td><a href="../view/categoryAct.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>"</a>Activar</td>
                          </tr>
                          <?php
                        } else {
                          ?>
                            $i++;
                          <?php
                        }
                    } else {
                      ?>
                        <td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>&padre=0"</a> Modificar</td>
                      <?php
                      if ($datos_categorias[$i]['BAJA']==1) {
                        ?>
                          <td><a href="../view/categoryAct.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>"</a>Activar</td>
                          </tr>
                        <?php
                      } else {
                        ?>
                          <td><a href="../view/categoryBaja.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>&padre=0"</a>Desactivar</td>
                          </tr>
                        <?php
                      }
                    }
             }
          // ----------  F I N   F O R   O R I G I N A L
         ?>
  </table>
</div>
<!-- ///////////////////////////////////////////
////   F I N    T A B L A   O R I G I N A L
///////////////////////////////////////////////-->
