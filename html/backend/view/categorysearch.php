<?php
session_start();
require('definitions.php');
require_once('../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>

<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#listopen').DataTable();
		$('#listconfirm').DataTable();
		$('#listclosed').DataTable();
	} );
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php
		$_SESSION['menu']=7;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<?php
						if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="misdatos"){
							echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
							unset($_SESSION['mobjetivo']);
							unset($_SESSION['mtipo']);
							unset($_SESSION['mtexto']);
							unset($_SESSION['debugeame']);
						}
						?>
            <!---F O R M U L A R I O       D  E     F I L T R O S   PARA LA BUSQUEDA  -->
            <form class="form-horizontal" action="categorysearch.php?" method="GET">
              <fieldset>
                <h4>Elija filtros para las categorias</h4>
                <div class="form-group">
                  <label class="col-md-5 control-label">Estado</label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <select name="estado" class="form-control col-md-5">
                        <option class="form-control" NULL selected disabled hidden>Elija</option>
                        <option class="form-control" value="1">Activo</option>
                        <option class="form-control" value="2">Inactivo</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <br>
                  <br>
                <div class="form-group">
                  <label class="col-md-5 control-label" ></label>
                  <div class="col-md-5">
                    <button type="submit" class="btn btn-success">
                      <span ></span> Filtrar
                    </button>&nbsp;<button type="submit" class="btn btn-danger" class="glyphicon glyphicon-thumbs-up" href="categorysearch.php?">Quitar filtro</button>
                    <br>
                    
                  </div>
                </div>
              </fieldset>
            </form>
            <!--- F  I  N       F O R M U L A R I O   D  E     F I L T R O S   PARA LA BUSQUEDA   -->
            <?php
            $filtroEstado=false;
            $estado=null;
              if (isset($_GET['estado'])){
									$estado=$_GET['estado'];
									$filtroEstado=true;
              }else{
                  $filtroEstado=false;
              }
							unset($_GET['estado']);
            ?>
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
											$datos_categorias = cargarCategoriasTodas();
											if ($filtroEstado==false) {
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
	                                        <td><a href="../view/categoryBaja.php?idCatMod=<?php echo utf8_encode($datos_categorias[$i]['ID'])?>&padre=1"</a>Desactivar</td>
	                                        </tr>
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
	                      // ------------------------------------------------
											} else {
												// // ------- comienzo BUSQUEDA    C O N    F I L T R O S
												// -------------------------------------------------------
												// FOR PARA CATEGORIAS A C T I V A S
												if ($estado=="1") {
													$datos_categoriasAct = cargarCategoriasActivas();
													for ($i=0; $i < count($datos_categoriasAct); $i++) {
														?>
														 <tr>
															 <td><?php echo utf8_encode($datos_categoriasAct[$i]['TITULO'])?></td>
																 <?php
																 if ((($datos_categoriasAct[$i]['PADRE'])==1)) {
																 ?>	<td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categoriasAct[$i]['ID'])?>&padre=1"</a> Modificar</td>
																		<td><a href="../view/categoryBaja.php?idCatMod=<?php echo utf8_encode($datos_categoriasAct[$i]['ID'])?>&padre=1"</a>Desactivar</td>
																	 	</tr>
																	<?php
																 } else {
																	 ?>
																		<td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categoriasAct[$i]['ID'])?>&padre=0"</a> Modificar</td>
																		<td><a href="../view/categoryBaja.php?idCatMod=<?php echo utf8_encode($datos_categoriasAct[$i]['ID'])?>&padre=0"</a>Desactivar</td>
																		</tr>
																		<?php
																 }
													}
												// FOR PARA CATEGORIAS  I N A C T I V A S
												} else {
													$datos_categoriasInac = cargarCategoriasInactivas();
													for ($i=0; $i < count($datos_categoriasInac); $i++) {
														?>
														 <tr>
															 <td><?php echo utf8_encode($datos_categoriasInac[$i]['TITULO'])?></td>
																 <?php
																 if ((($datos_categoriasInac[$i]['PADRE'])==1)) {
																 ?>	<td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categoriasInac[$i]['ID'])?>&padre=1"</a> Modificar</td>
																		<td><a href="../view/categoryAct.php?idCatMod=<?php echo utf8_encode($datos_categoriasInac[$i]['ID'])?>&padre=1"</a>Activar</td>
																	 	</tr>
																	<?php
																 } else {
																	 ?>
																		<td><a href="../view/categoryMod.php?idCatMod=<?php echo utf8_encode($datos_categoriasInac[$i]['ID'])?>&padre=0"</a> Modificar</td>
																		<td><a href="../view/categoryAct.php?idCatMod=<?php echo utf8_encode($datos_categoriasInac[$i]['ID'])?>&padre=0"</a>Activar</td>
																		</tr>
																		<?php
																 }
													}
												}
											}
										 ?>
							<!-- /* F I N    R E C O R R I D A S      C I E  R R E     D E     T A B L A */ -->
							</table>
						</div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
          </div>
				</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
					</div>
				</div>
			</div>
		 </div>
		</div>
	</div>
</div>
<script>
	$('#listopen').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Nombre de la categoria:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"responsive": "true",
		"select": "true",
		"buttons": [
		'copy', 'excel', 'pdf'
		]
	});
	$('#listconfirm').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Ingrese Nombre/Usuario/CI:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"responsive": "true",
		"select": "true",
		"buttons": [
		'copy', 'excel', 'pdf'
		]
	});
	$('#listclosed').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Ingrese Nombre/Usuario/CI:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"responsive": "true",
		"select": "true",
		"buttons": [
		'copy', 'excel', 'pdf'
		]
	});
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
