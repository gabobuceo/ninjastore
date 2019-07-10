<?php 
if (!isset($_SESSION['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	var onloadCallback = function() {
		alert("grecaptcha is ready!");
	};
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  LOGIN  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-up">
				<h1>Crear una cuenta</h1>
				<p class="creating">Create ahora mismo una cuenta y vive una experiencia inolvidable</p>
				<h2>Información necesaria</h2>
				<form action="../logica/procesarAltaUsuario.php" method="POST">
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Nombre:</h4>
						</div>
						<div class="sign-up2">
							<input type="text" name="pNombre" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Apellido:</h4>
						</div>
						<div class="sign-up2">
							<input type="text" name="pApellido" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Cédula:</h4>
						</div>
						<div class="sign-up2">
							<input type="text" name="cedula" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Usuario:</h4>
						</div>
						<div class="sign-up2">
							<input type="text" name="usuario" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Contraseña:</h4>
						</div>
						<div class="sign-up2">
							<input type="password" name="password" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Confirmación:</h4>
						</div>
						<div class="sign-up2">
							<input type="password" name="password2" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Email:</h4>
						</div>
						<div class="sign-up2">
							<input type="text" name="email" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Fecha de Nacimiento:</h4>
						</div>
						<div class="sign-up2">
							<input type="date" name="fNacimiento" placeholder=" " required=" "/>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Capcha:</h4>
						</div>
						<div class="sign-up2">
							<div class="captchaweapper">
								<div class="g-recaptcha" data-sitekey="6LdtADUUAAAAAEWxW3NrYhsHPteqlpiezGNGwWS-"></div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sub_home_right">
							<p>Al precionar "Registrarse" usted esta aceptando nuestras <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Politicas de seguridad</a></p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sub_home">
						<div class="sub_home_left">
							<input type="submit" value="Registrarse"> 
							</div>
						<div class="sub_home_right">
							<p>Regresar a <a href="index.php">Inicio</a></p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
<!-- ::::::::::::::  COMIENZO POLITICAS  :::::::::::::: -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Términos y Condiciones de uso del Sitio</h4>
			</div>
			<div class="modal-body">
				<p>Versión vigente 04/06/2017</p>
				<p>Este contrato describe los términos y condiciones generales (en adelante, los "Términos y Condiciones Generales") aplicables al uso de los servicios ofrecidos por ninjastore.uy, una empresa constituida bajo las leyes uruguayas, (en adelante, los "Servicios") del sitio <a href="http://www.ninjastore.uy" target="_blank">www.ninjastore.uy</a>&nbsp;("NinjaStore" o el "sitio"). Cualquiera que desee acceder y/o usar el Sitio o los Servicios podrá hacerlo sujetándose a los Términos y Condiciones Generales de Ninja Store, junto con todas las demás políticas y principios que rigen en Ninja Store y que son incorporados al presente por referencia.</p>
				<p><strong>CUALQUIER PERSONA QUE NO ACEPTE ESTOS TÉRMINOS Y CONDICIONES GENERALES Y/O CUALQUIERA DE LAS DEMÁS POLÍTICAS, ANEXOS Y PRINCIPIOS QUE RIGEN EN NINJA STORE, LOS CUALES TIENEN UN CARÁCTER OBLIGATORIO Y VINCULANTE, DEBERÁ ABSTENERSE DE UTILIZAR EL SITIO Y/O LOS SERVICIOS.</strong></p>
				<h2>01 - Capacidad</h2>
				<p>Los Servicios sólo están disponibles para personas que tengan capacidad legal para contratar (en adelante, el “Usuario”, o en plural, los “Usuarios”). No podrán utilizar los Servicios las personas que no tengan esa capacidad, los menores de edad o Usuarios de Ninja Store que hayan sido suspendidos temporalmente o inhabilitados definitivamente. Para registrar un Usuario como Usuario VIP, se deberá contratar la capacidad suficiente como para obtener los beneficios como así también de obligar a la misma en los términos de este Acuerdo.</p>
				<h2>02 - Registración</h2>
				<p>Los Servicios sólo están disponibles para personas que tengan capacidad legal para contratar (en adelante, el “Usuario”, o en plural, los “Usuarios”). No podrán utilizar los Servicios las personas que no tengan esa capacidad, los menores de edad o Usuarios de Ninja Store que hayan sido suspendidos temporalmente o inhabilitados definitivamente. Para registrar un Usuario como como Usuario VIP, se deberá contratar la capacidad suficiente como para obtener los beneficios como así también de obligar a la misma en los términos de este Acuerdo.</p>
				<p>La registración como Usuario de Ninja Store implicará también la registración como Usuario de Mercado Pago.</p>
				<p>A su exclusiva discreción, Ninja Store podrá requerir una registración adicional a los Usuarios que operen como concesionarias o inmobiliarias, como requisito para que dichos Usuarios accedan a paquetes especiales de publicaciones. En estos casos, una vez efectuada la registración adicional, las ofertas de venta de automóviles o inmuebles que realicen las concesionarias o inmobiliarias, respectivamente, sólo se publicarán en Ninja Store a través de alguno de dichos paquetes o bajo las modalidades que Ninja Store habilite para este tipo de Usuarios.</p>
				<p>Ninja Store se reserva el derecho de solicitar algún comprobante y/o dato adicional a efectos de corroborar los Datos Personales, así como de suspender temporal o definitivamente a aquellos Usuarios cuyos datos no hayan podido ser confirmados. En estos casos de inhabilitación, se dará de baja todos los artículos publicados, así como las ofertas realizadas, sin que ello genere algún derecho a resarcimiento.</p>
				<p>El Usuario accederá a su cuenta personal (en adelante, la "Cuenta") mediante el ingreso de su Usuario y clave de seguridad personal elegida (en adelante, la "Clave de Seguridad"). El Usuario se obliga a mantener la confidencialidad de su Clave de Seguridad.</p>
				<p>La Cuenta es personal, única e intransferible, y está prohibido que un mismo Usuario registre o posea más de una Cuenta. En caso que Ninja Store detecte distintas Cuentas que contengan datos coincidentes o relacionados, podrá cancelar, suspender o inhabilitarlas.</p>
				<p>El Usuario será responsable por todas las operaciones efectuadas en su Cuenta, pues el acceso a la misma está restringido al ingreso y uso de su Clave de Seguridad, de conocimiento exclusivo del Usuario. El Usuario se compromete a notificar a Ninja Store en forma inmediata y por medio idóneo y fehaciente, cualquier uso no autorizado de su Cuenta, así como el ingreso por terceros no autorizados a la misma. Se aclara que está prohibida la venta, cesión o transferencia de la Cuenta (incluyendo la reputación y calificaciones) bajo ningún título, salvo expresa autorización de Ninja Store.</p>
				<p>Ninja Store se reserva el derecho de rechazar cualquier solicitud de registración o de cancelar una registración previamente aceptada, sin que esté obligado a comunicar o exponer las razones de su decisión y sin que ello genere algún derecho a indemnización o resarcimiento.</p>
				<h2>03 - Modificaciones del acuerdo</h2>
				<p class="p1"><span class="s1">Ninja Store podrá modificar los Términos y Condiciones Generales en cualquier momento haciendo públicos en el Sitio los términos modificados. Todos los términos modificados entrarán en vigor a los 10 (diez) días de su publicación. Dichas modificaciones serán comunicadas por Ninja Store a los usuarios que en la Configuración de su Cuenta de Ninja Store hayan indicado que desean recibir notificaciones de los cambios en estos Términos y Condiciones. Todo usuario que no esté de acuerdo con las modificaciones efectuadas por Ninja Store podrá solicitar la baja de su Cuenta.</span></p>
				<p class="p1"><span class="s1">El uso del Sitio y/o sus Servicios implica la plena aceptación de estos Términos y Condiciones Generales de Ninja Store, como así también de cualquiera de las demás políticas, anexos y principios que rigen en Ninja Store.</span></p>
				<h2>04 - Listado de Bienes</h2>
				<h3>4.1 Publicación de bienes y/o servicios.</h3>
				<p>En caso que Ninja Store detecte que por algún medio el Usuario se encuentra violentando las obligaciones anteriormente mencionadas, podrá cancelar, suspender o inhabilitar temporal o permanente su Cuenta.</p>
				<h3>4.2 Publicación de bienes y/o servicios.</h3>
				<p>El Usuario deberá ofrecer a la venta los bienes y/o servicios en las categorías y subcategorías apropiadas. Las publicaciones podrán incluir textos descriptivos, gráficos, fotografías y otros contenidos y condiciones pertinentes para la venta del bien o la contratación del servicio, siempre que no violen ninguna disposición de este acuerdo o demás políticas de Ninja Store. El producto ofrecido por el Usuario Vendedor debe ser exactamente descrito en cuanto a sus condiciones y características relevantes. Se entiende y presume que mediante la inclusión del bien o servicio en Ninja Store, el Usuario acepta que tiene la intención y el derecho de vender el bien por él ofrecido, o está facultado para ello por su titular y lo tiene disponible para su entrega inmediata. Se establece que los precios de los productos publicados deberán ser expresados con IVA incluido cuando corresponda la aplicación del mismo, y en moneda del curso legal. Ninja Store podrá remover cualquier publicación cuyo precio no sea expresado de esta forma para evitar confusiones o malos entendidos en cuanto al precio final del producto. Se deja expresamente establecido que ninguna descripción podrá contener datos personales o de contacto, tales como, y sin limitarse a, números telefónicos, dirección de e-mail, dirección postal, direcciones de páginas de Internet que contengan datos como los mencionados anteriormente, salvo lo estipulado específicamente para las categorías: Autos, motos y otros, Inmuebles y Servicios. No podrá publicitarse otros medios de pagos, distintos de los enunciados por Ninja Store en la página de publicación de artículos, ni tampoco podrá sugerir o insinuar a los compradores que no utilicen MercadoPago y/o alterar las condiciones de compra si el Usuario comprador decidiera utilizar MercadoPago. En caso que se infrinja cualquiera de las disposiciones establecidas en esta cláusula, Ninja Store podrá editar el espacio, solicitar al Usuario que lo edite, o dar de baja la publicación donde se encuentre la infracción.</p>
				<h3>4.3 Inclusión de imágenes y fotografías.</h3>
				<p>El usuario puede incluir imágenes y fotografías del producto ofrecido siempre que las mismas se correspondan con el bien o servicio a ofrecer, salvo que se trate de bienes, productos o de servicios que por su naturaleza no permiten esa correspondencia.<br> <br>Ninja Store podrá impedir la publicación de la fotografía, e incluso del bien o servicio, si interpretara, a su exclusivo criterio, que la imagen no cumple con los presentes Términos y Condiciones. Las imágenes y fotografías de artículos publicados bajo la modalidad Oro Premium y Oro deberán cumplir con algunos requisitos adicionales como condición para ser expuestas en la Página Principal del Sitio Web.<a href="http://ayuda.mercadolibre.com.uy/ayuda/Sacar-buenas-fotos-productos_805" target="_blank">Conoce los requisitos</a>.</p>
				<h3>4.4 Artículos Prohibidos.</h3>
				<p>Sólo podrán ser ingresados en las listas de bienes y/o servicios, aquellos cuya venta no se encuentre tácita o expresamente prohibida en los Términos y Condiciones Generales y demás políticas de Ninja Store o por la ley vigente. Para obtener mayor información sobre artículos y/o servicios prohibidos, se pueden consultar nuestras <a href="http://ayuda.mercadolibre.com.uy/ayuda/Articulos-prohibidos_s1028" target="_blank">Políticas de Artículos Prohibidos</a>&nbsp;de MercadoLibre</p>
				<h3>4.5 Protección de Propiedad Intelectual.</h3>
				<p>Ninja Store ha desarrollado un Programa (en adelante, el "PPPI") destinado a asegurar que los artículos publicados no infrinjan los derechos de propiedad intelectual e industrial y cualesquiera otros de terceros. Los participantes del PPPI o quienes sean titulares de derechos podrán identificar y solicitar la remoción de aquellos artículos que a su criterio infrinjan o violen sus derechos. En caso que Ninja Store sospeche que se está cometiendo o se ha cometido una actividad ilícita o infractora de derechos de propiedad intelectual o industrial, Ninja Store se reserva el derecho de adoptar todas las medidas que entienda adecuadas, lo que puede incluir dar acceso limitado a los participantes del PPPI y otros titulares de estos derechos a algunos de sus datos personales tal y como se describe en las Políticas de Privacidad.</p>
				<p>Al solicitar la adhesión al PPPI estarás aceptando los términos y condiciones del programa, y la información que nos proveas tendrá carácter de declaración jurada: <a href="http://ayuda.mercadolibre.com.uy/ayuda/Programa-de-Proteccion-de-Prop_994" target="_blank">Términos y condiciones del programa</a></p>
				<h2>05 - Privacidad de la Información</h2>
				<p>Para utilizar los Servicios ofrecidos por Ninja Store, los Usuarios deberán facilitar determinados datos de carácter personal. Su información personal se procesa y almacena en servidores o medios magnéticos que mantienen altos estándares de seguridad y protección tanto física como tecnológica. Para mayor información sobre la privacidad de los Datos Personales y casos en los que será revelada la información personal, se pueden consultar nuestras <a href="http://ayuda.mercadolibre.com.uy/ayuda/Politicas-de-privacidad_993" target="_blank">Políticas de Privacidad</a>.</p>
				<h2>06 - Obligaciones de los Usuarios</h2>
				<h3>6.1 Obligaciones del Comprador.</h3>
				<p>Para utilizar los Servicios ofrecidos por Ninja Store, los Usuarios deberán facilitar determinados datos de carácter personal. Su información personal se procesa y almacena en servidores o medios magnéticos que mantienen altos estándares de seguridad y protección tanto física como tecnológica. Para mayor información sobre la privacidad de los Datos Personales y casos en los que será revelada la información personal, se pueden consultar nuestras.</p>
				<p>El Comprador está obligado a intentar comunicarse con el vendedor y completar la operación si ha realizado una oferta por un artículo publicado bajo la modalidad de "compra inmediata" o si realizó la oferta más alta, en los casos en que esta modalidad esté permitida, salvo que la operación esté prohibida por la ley o los Términos y Condiciones Generales y demás políticas de Ninja Store, en cuyo caso no estará obligado a concretar la operación.</p>
				<p>Al ofertar por un artículo el Usuario acepta quedar obligado por las condiciones de venta incluidas en la descripción del artículo en la medida en que las mismas no infrinjan las leyes o los Términos y Condiciones Generales y demás políticas de Ninja Store. La oferta de compra es irrevocable salvo en circunstancias excepcionales, tales como que el vendedor cambie sustancialmente la descripción del artículo después de realizada alguna oferta o que no pueda verificar la identidad del vendedor.<br> <br>Las ofertas de compra sólo serán consideradas válidas, una vez que hayan sido procesadas por el sistema informático de Ninja Store.<br> <br>Cuando el Usuario comprador haya realizado una oferta sobre algún artículo por publicado en el Sitio, deberá calificar a la contraparte de acuerdo a lo establecido en la Cláusula 14 de estos Términos y Condiciones Generales.</p>
				<p><strong>Impuestos</strong>. Tal como lo establece la normativa fiscal vigente, el comprador debe exigir factura o ticket al vendedor como comprobante de la operación. El vendedor no estará obligado a emitir factura o ticket sólo en el caso de tratarse de una persona física que efectúa ventas ocasionalmente.</p>
				<h3>6.2. Obligaciones del Vendedor.</h3>
				<p>El Usuario vendedor debe tener capacidad legal para vender el bien objeto de su oferta. Si el Usuario vendedor ha recibido al menos una oferta sobre el precio mínimo que estableció, queda obligado a intentar comunicarse con el comprador y completar la operación con el Usuario que haya realizado la oferta más alta o la que alcance el precio establecido en la modalidad Compra Inmediata. Solamente en casos excepcionales el Usuario vendedor podrá retractarse de la venta, tales como cuando no haya podido acordar con el Usuario comprador sobre la forma de pago, de entrega, exista un claro error tipográfico en el precio de la publicación, o no sea posible verificar la verdadera identidad o demás información del Usuario comprador.</p>
				<p>Ninja Store tendrá el derecho de forzar, conforme los criterios que considere pertinentes, que ciertos Usuarios vendedores solamente puedan cobrar el pago de sus artículos y de las tarifas que se puedan llegar a generarse por la utilización de los Servicios mediante la utilización de los Servicios de Gestión de Pagos online de MercadoPago.</p>
				<p>Dado que Ninja Store es un punto de encuentro entre comprador y vendedor y no participa de las operaciones que se realizan entre ellos, el Vendedor será responsable por todas las obligaciones y cargas impositivas que correspondan por la venta de sus artículos, sin que pudiera imputársele a Ninja Store algún tipo de responsabilidad por incumplimientos en tal sentido.</p>
				<p>Cuando el Usuario vendedor haya recibido una oferta en un artículo por él publicado, deberá calificar a la contraparte de acuerdo a lo establecido en la Cláusula 14 de estos Términos y Condiciones Generales.</p>
				<p><strong>Impuestos</strong>. Como se mencionara anteriormente, Ninja Store sólo pone a disposición de los Usuarios un espacio virtual que les permite comunicarse mediante Internet para encontrar una forma de vender o comprar artículos y/o servicios a terceras personas. Ninja Store no tiene participación alguna en el proceso de negociación y perfeccionamiento del contrato definitivo entre las partes. Por eso, Ninja Store no es responsable por el efectivo cumplimiento de las obligaciones fiscales o impositivas establecidas por la ley vigente.</p>
				<p>Encuentra más información en <a href="http://ayuda.mercadolibre.com.uy/ayuda/Vender-un-producto_988" target="_blank">ventas</a>.</p>
				<h2>07 - Prohibiciones</h2>
				<p>Los Usuarios no podrán: (a) manipular los precios de los artículos; (b) interferir en la puja entre distintos Usuarios; (c) mantener cualquier tipo de comunicación por e-mail o por cualquier otro medio (incluyendo las redes sociales) durante la oferta del bien con ninguno de los Usuarios que participan en la misma, salvo en la sección de Preguntas y Respuestas; (d) dar a conocer sus datos personales o de otros usuarios a través de la sección de Preguntas y Respuestas y/o por algún otro medio (incluyendo pero sin limitar a Twitter, Facebook y/ o cualquier otra red social), salvo lo estipulado específicamente para la categoría Autos, motos y otros, Servicios e Inmuebles; (e) aceptar datos personales proporcionados por otros usuarios a través de la sección de Preguntas y Respuestas y/o algún otro medio (incluyendo pero sin limitar Twitter, Facebook y/o cualquier otra red social); (f) publicar o vender artículos prohibidos por los Términos y Condiciones Generales, demás políticas de Ninja Store o leyes vigentes; (g) insultar o agredir a otros Usuarios; (h) utilizar su reputación, calificaciones o comentarios recibidos en el sitio de Ninja Store en cualquier ámbito fuera de Ninja Store; (i) publicar artículos idénticos en más de una publicación.</p>
				<p>Este tipo de actividades será investigado por Ninja Store y el infractor podrá ser sancionado con la suspensión permanente o temporal de la Cuenta, la cancelación de la publicación y/o de cualquier otra forma que estime pertinente, sin que ello genere algún derecho a indemnización o resarcimiento alguno, y sin perjuicio de las acciones legales a que pueda dar lugar por la configuración de delitos, contravenciones o los perjuicios civiles que pueda causar a los Usuarios oferentes.</p>
				<h2>08 - Violaciones del Sistema o Bases de Datos</h2>
				<p>No está permitida ninguna acción o uso de dispositivo, software, u otro medio tendiente a interferir tanto en las actividades y operatoria de Ninja Store como en las ofertas, descripciones, cuentas o bases de datos de Ninja Store. Cualquier intromisión, tentativa o actividad violatoria o contraria a las leyes sobre derecho de propiedad intelectual y/o a las prohibiciones estipuladas en este contrato harán pasible a su responsable de las acciones legales pertinentes, y a las sanciones previstas por este acuerdo, así como lo hará responsable de indemnizar los daños ocasionados.</p>
				<h2>09 - Sanciones. Suspensión de operaciones</h2>
				<p>Sin perjuicio de otras medidas, Ninja Store podrá advertir, suspender en forma temporal o inhabilitar definitivamente la Cuenta de un Usuario o una publicación, aplicar una sanción que impacte negativamente en la reputación de un Usuario, iniciar las acciones que estime pertinentes y/o suspender la prestación de sus Servicios si (a) se quebrantara alguna ley, o cualquiera de las estipulaciones de los Términos y Condiciones Generales y demás políticas de Ninja Store; (b) si incumpliera sus compromisos como Usuario; (c) si se incurriera a criterio de Ninja Store en conductas o actos dolosos o fraudulentos; (d) no pudiera verificarse la identidad del Usuario o cualquier información proporcionada por el mismo fuere errónea; (e) Ninja Store entendiera que las publicaciones u otras acciones pueden ser causa de responsabilidad para el Usuario que las publicó, para Ninja Store o para los demás Usuarios en general.</p>
				<p>En el caso de la suspensión de un Usuario, sea temporal o definitiva, todos las artículos que tuviera publicados serán removidos del sistema y en ningún caso se devolverán o bonificarán los cargos de publicación involucrados. También se removerán del sistema las ofertas de compra de bienes ofrecidos bajo la modalidad de subasta.</p>
				<h2>10 - Responsabilidad</h2>
				<p>Ninja Store sólo pone a disposición de los Usuarios un espacio virtual que les permite ponerse en comunicación mediante Internet para encontrar una forma de vender o comprar servicios o bienes. Ninja Store no es el propietario de los artículos ofrecidos, no tiene posesión de ellos ni los ofrece en venta. Ninja Store no interviene en el perfeccionamiento de las operaciones realizadas entre los Usuarios ni en las condiciones por ellos estipuladas para las mismas, por ello no será responsable respecto de la existencia, calidad, cantidad, estado, integridad o legitimidad de los bienes ofrecidos, adquiridos o enajenados por los Usuarios, así como de la capacidad para contratar de los Usuarios o de la veracidad de los Datos Personales por ellos ingresados. Cada Usuario conoce y acepta ser el exclusivo responsable por los artículos que publica para su venta y por las ofertas y/o compras que realiza.</p>
				<p>Debido a que Ninja Store no tiene ninguna participación durante todo el tiempo en que el artículo se publica para la venta, ni en la posterior negociación y perfeccionamiento del contrato definitivo entre las partes, no será responsable por el efectivo cumplimiento de las obligaciones asumidas por los Usuarios en el perfeccionamiento de la operación. El Usuario conoce y acepta que al realizar operaciones con otros Usuarios o terceros lo hace bajo su propio riesgo. En ningún caso Ninja Store será responsable por lucro cesante, o por cualquier otro daño y/o perjuicio que haya podido sufrir el Usuario, debido a las operaciones realizadas o no realizadas por artículos publicados a través de Ninja Store.</p>
				<p>Ninja Store recomienda actuar con prudencia y sentido común al momento de realizar operaciones con otros Usuarios. El Usuario debe tener presentes, además, los riesgos de contratar con menores o con personas que se valgan de una identidad falsa. Ninja Store NO será responsable por la realización de ofertas y/o operaciones con otros Usuarios basadas en la confianza depositada en el sistema o los Servicios brindados por Ninja Store.</p>
				<p>En caso que uno o más Usuarios o algún tercero inicien cualquier tipo de reclamo o acción legal contra otro u otros Usuarios, todos y cada uno de los Usuarios involucrados en dichos reclamos o acciones judiciales eximen de toda responsabilidad a Ninja Store y a sus directores, gerentes, empleados, agentes, operarios, representantes y apoderados.</p>
				<p>En virtud que el usuario vendedor tiene la facultad para eliminar preguntas o impedir a un usuario hacer preguntas u ofertas en sus publicaciones, se deja aclarado que en ese caso, el usuario será el exclusivo responsable por esa decisión y las consecuencias que pudieran acarrear.</p>
				<h2>11 - Alcance de los servicios de MercadoLibre</h2>
				<p>Este acuerdo no crea ningún contrato de sociedad, de mandato, de franquicia, o relación laboral entre Ninja Store y el Usuario. El Usuario reconoce y acepta que Ninja Store no es parte en ninguna operación, ni tiene control alguno sobre la calidad, seguridad o legalidad de los artículos anunciados, la veracidad o exactitud de los anuncios, la capacidad de los Usuarios para vender o comprar artículos. Ninja Store no puede asegurar que un Usuario completará una operación ni podrá verificar la identidad o Datos Personales ingresados por los Usuarios. Ninja Store no garantiza la veracidad de la publicidad de terceros que aparezca en el sitio y no será responsable por la correspondencia o contratos que el Usuario celebre con dichos terceros o con otros Usuarios.</p>
				<h2>12 - Fallas en el sistema</h2>
				<p>Ninja Store no se responsabiliza por cualquier daño, perjuicio o pérdida generada al Usuario por fallas en el sistema, en el servidor o en Internet. Ninja Store tampoco será responsable por cualquier virus que pudiera infectar el equipo del Usuario como consecuencia del acceso, uso o examen de su sitio web o a raíz de cualquier transferencia de datos, archivos, imágenes, textos, o audio contenidos en el mismo. Los Usuarios NO podrán imputarle responsabilidad alguna ni exigir pago por lucro cesante, en virtud de perjuicios resultantes de dificultades técnicas o fallas en los sistemas o en Internet. Ninja Store no garantiza el acceso y uso continuado o ininterrumpido de su sitio. El sistema puede eventualmente no estar disponible debido a dificultades técnicas o fallas de Internet, o por cualquier otra circunstancia ajena a Ninja Store; en tales casos se procurará restablecerlo con la mayor celeridad posible sin que por ello pueda imputársele algún tipo de responsabilidad. Ninja Store no será responsable por ningún error u omisión contenidos en su sitio web.</p>
				<h2>13 - Tarifas. Facturación</h2>
				<p>La inscripción en MercadoLibre es gratuita. El Usuario deberá pagar a MercadoLibre solo un costo por la venta cuando la operación se concreta o cuando el Usuario no califique la operación en el plazo correspondiente. Para el caso de las publicaciones de la categoría Autos, motos y otros y Servicios e inmuebles, el Usuario deberá pagar únicamente a MercadoLibre un costo por publicar. En ambos casos los cargos varían conforme la exposición del anuncio en el Sitio Web.</p>
				<p>MercadoLibre se reserva el derecho de modificar, cambiar, agregar, o eliminar las tarifas vigentes, en cualquier momento, lo cual será notificado a los Usuarios, en la forma establecida en la Cláusula 3. Sin embargo, Ninja Store podrá modificar temporalmente la Política de Tarifas y las tarifas por sus servicios por razón de promociones, siendo efectivas estas modificaciones cuando se haga pública la promoción o se realice el anuncio.</p>
				<p>MercadoLibre se reserva el derecho de tomar las medidas judiciales y extrajudiciales que estime pertinentes para obtener el pago del monto debido.</p>
				<p>En caso de haberse facturado cargos que no hubiesen correspondido, el Usuario deberá comunicarse con nuestro equipo de Atención al Cliente para resolver dicha cuestión.</p>
				<p>Cualquier duda consulte nuestras <a href="http://ayuda.mercadolibre.com.uy/ayuda/Tarifas-y-facturacion_1044" target="_blank">Políticas de facturación</a>.</p>
				<h2>14 - Sistema de reputación</h2>
				<p>Debido a que la verificación de la identidad de los Usuarios en Internet es difícil, Ninja Store no puede confirmar la identidad pretendida de cada Usuario. Por ello los Usuarios cuentan con un sistema de reputación de Usuarios que es actualizado periódicamente en base a datos vinculados con su actividad en el sitio y a los comentarios ingresados por los propios Usuarios según las operaciones que hayan realizado. Tanto los Usuarios compradores como los Usuarios vendedores se encuentran obligados a ingresar una calificación informando acerca de la concreción o no de la operación; pudiendo también, ingresar un comentario sobre como resultó la experiencia de compra en particular.</p>
				<p>En virtud que las calificaciones y comentarios que son realizados por los Usuarios, éstos serán incluidos bajo exclusiva responsabilidad de los Usuarios que los emitan. Ninja Store no tiene obligación de verificar la veracidad o exactitud de los mismos y NO se responsabiliza por los dichos allí vertidos por cualquier Usuario, por las ofertas de compras o ventas que los Usuarios realicen teniéndolos en cuenta o por la confianza depositada en las calificaciones de la contraparte o por cualquier otro comentario expresado dentro del sitio o a través de cualquier otro medio, incluido el correo electrónico. Ninja Store se reserva el derecho de editar y/o eliminar aquellos comentarios que sean considerados inadecuados u ofensivos. Ninja Store mantiene el derecho de excluir a aquellos Usuarios que sean objeto de calificaciones y/o comentarios negativos. Para obtener mayor información sobre el sistema de calificaciones, se pueden consultar nuestro <a href="http://ayuda.mercadolibre.com.uy/ayuda/sistema-de-reputacion_1045" target="_blank">Sistema de Reputación</a>&nbsp;de MercadoLibre.</p>
				<h2>15 - Propiedad intelectual. Enlaces</h2>
				<p>Los contenidos de las pantallas relativas a los servicios de Ninja Store como así también los programas, bases de datos, redes, archivos que permiten al Usuario acceder y usar su Cuenta, son de propiedad de Ninja Store y están protegidas por las leyes y los tratados internacionales de derecho de autor, marcas, patentes, modelos y diseños industriales. El uso indebido y la reproducción total o parcial de dichos contenidos quedan prohibidos, salvo autorización expresa y por escrito de Ninja Store.</p>
				<p>El Sitio puede contener enlaces a otros sitios web lo cual no indica que sean propiedad u operados por Ninja Store. En virtud que Ninja Store no tiene control sobre tales sitios, NO será responsable por los contenidos, materiales, acciones y/o servicios prestados por los mismos, ni por daños o pérdidas ocasionadas por la utilización de los mismos, sean causadas directa o indirectamente. La presencia de enlaces a otros sitios web no implica una sociedad, relación, aprobación, respaldo de Ninja Store a dichos sitios y sus contenidos.</p>
				<h2>16 - Indemnización</h2>
				<p>El usuario acepta indemnizar y eximir de responsabilidad a Ninja Store (incluyendo pero no limitando a sus sociedades relacionadas, sus respectivos directores, gerentes, funcionarios, filiales, empresas controladas y/o controlantes, directivos, administradores, representantes, agentes y empleados), por cualquier reclamo o demanda (incluidos los honorarios razonables de abogados) formulados por cualquier Usuario y/o tercero por cualquier infracción a los Términos y Condiciones Generales y demás Anexos y Políticas que se entienden incorporadas al presente o por la violación de cualesquiera leyes o derechos de terceros.</p>
				<p>A tal fin, el usuario faculta a Ninja Store a: i) intervenir y representarlo en dichos reclamos o demandas, pudiendo arribar a acuerdos sin limitación, incluyendo los honorarios de abogados en su nombre y representación; ii) retener y debitar de su cuenta de MercadoPago los fondos existentes y/o futuros; y/o iii) generar cargos específicos en su facturación una cantidad razonable.</p>
				<h2>17 - Anexos</h2>
				<p>Forman parte integral e inseparable de los Términos y Condiciones Generales, los siguientes documentos y/o secciones de Ninja Store incorporados por referencia, donde se detallan políticas y/o Términos y Condiciones de diferentes servicios ofrecidos en el sitio. Los mismos se podrán consultar dentro del sitio mediante el enlace abajo provisto o accediendo directamente a las páginas correspondientes:</p>
				<ul>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Programa-de-Protecci-n-de-Prop_1771">Programa de Protección de Propiedad Intelectual</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Articulos-prohibidos_s1028">Artículos Prohibidos</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Publicaciones-que-violen-la-propiedad-intelectual_s1077">Artículos que violan derechos de propiedad intelectual</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Politicas-de-Publicacion_s1011">Políticas de Publicación</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Politicas-de-privacidad_993">Política de Privacidad</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/politica-de-eleccion-de-apodo_1089">Política de elección del Apodo</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Tarifas-y-facturacion_1044">Tarifas y Facturación</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/sistema-de-reputacion_1045">Sistema de reputación</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Programa-de-MercadoLideres_995">Programa de MercadoLíderes</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/tiendas-oficiales_1087">Tiendas oficiales</a></li>
					<li><a href="https://www.mercadopago.com.uy/ayuda/requisitos-programa-de-proteccion-al-comprador-uy_2852">Programa de Protección al Comprador</a></li>
					<li><span style="text-decoration: underline;"><a href="http://ayuda.mercadolibre.com.uy/ayuda/Inhabilitacion-o-Suspension-de-usuarios_s1101">Inhabilitación o suspensión de usuarios</a></span></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/Terminos-y-Condiciones-de-Cont_996">Términos y Condiciones de Contratación de Ninja Store Publicidad</a></li>
					<li><a href="https://www.mercadopago.com.uy/ayuda/terminos-y-condiciones_299">Términos y Condiciones de Mercado Pago.</a></li>
					<li><a href="http://ayuda.mercadolibre.com.uy/ayuda/sistema-de-opiniones-de-servicios_1085">Sistema de opiniones de servicios</a><br><br></li>
				</ul>
				<h2>18 - Jurisdicción y Ley Aplicable</h2>
				<p>Este acuerdo estará regido en todos sus puntos por las leyes vigentes en Uruguay. Cualquier controversia derivada del presente acuerdo, su existencia, validez, interpretación, alcance o cumplimiento, será sometida a la competencia de los tribunales ordinarios de la Ciudad de Montevideo.</p>
				<h2>19 - Domicilio</h2>
				<p>Se fija como domicilio de DeRemate.com de Uruguay S.R.L. la calle La Paz 1790, Montevideo, Uruguay.</p>
				<p>Si tienes alguna duda sobre los Términos y Condiciones Generales o demás políticas y principios que rigen Ninja Store consulta nuestra página de <a href="http://ayuda.mercadolibre.com.uy/ayuda/" target="_blank">Ayuda</a>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>

	</div>
</div>
<!-- ::::::::::::::  FIN POLITICAS  :::::::::::::: -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>