<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script type="text/javascript" src="../static/js/canvasjs.min.js"></script>
<script>
	window.onload = function () {
		var chartbuy = new CanvasJS.Chart("chartseller", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Calificacion como Comprador"
			}, 
			axisX: {
				title: "Calificacion"
			},
			axisY: {
				title: "Compras",
				titleFontColor: "#4F81BC",
				lineColor: "#4F81BC",
				labelFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			toolTip: {
				shared: true
			},
			legend: {
				cursor: "pointer",
				itemclick: toggleDataSeries
			},
			data: [{
				type: "column",
				name: "Compras",
				showInLegend: true,      
				yValueFormatString: "#,##0.# votos",
				dataPoints: [
				{ label: "Estrella 1",  y: 2 },
				{ label: "Estrella 2", y: 1 },
				{ label: "Estrella 3", y: 4 },
				{ label: "Estrella 4",  y: 8 },
				{ label: "Estrella 5",  y: 200 }
				]
			}]
		});
		chartbuy.render();
		var chartselling = new CanvasJS.Chart("chartselling", {
			theme: "light2",
			animationEnabled: true,
			title:{
				text: "Grafica de compras mensuales - 2017"   
			},
			axisX: {
				interval: 1,
				intervalType: "month",
				valueFormatString: "MMM"
			},
			axisY:{
				title: "Gastos (en $U)",
				valueFormatString: "$#0"
			},
			data: [{        
				type: "line",
				markerSize: 12,
				xValueFormatString: "MMM, YYYY",
				yValueFormatString: "$###.#",
				dataPoints: [        
				{ x: new Date(2016, 00, 1), y: 61, indexLabel: "gain", markerType: "triangle",  markerColor: "#6B8E23" },
				{ x: new Date(2016, 01, 1), y: 71, indexLabel: "gain", markerType: "triangle",  markerColor: "#6B8E23" },
				{ x: new Date(2016, 02, 1) , y: 55, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 03, 1) , y: 50, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 04, 1) , y: 65, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 05, 1) , y: 85, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 06, 1) , y: 68, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 07, 1) , y: 28, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 08, 1) , y: 34, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 09, 1) , y: 24, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 10, 1) , y: 44, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 11, 1) , y: 34, indexLabel: "loss", markerType: "cross", markerColor: "tomato" }
				]}]
			});
		chartselling.render();
		function toggleDataSeries(e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			e.chart.render();
		}
	}
</script>

<!--<link rel='stylesheet' href='../static/css/jquery.dataTables.min.css'>-->
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
		<div class="sidebar-nav">
			<div class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs navbar-brand">Panel de control del Usuario</span>
				</div>
				<div class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav" id="sidenav01">
						<li><a href="sumary.php"><h4><i class="fa fa-book" aria-hidden="true"></i> Resumen</h4></a></li>
						<li><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Perfil</a></li>
						<li><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
						<li class="active"><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
						<li><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
						<li><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
						<li><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
						<li><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Abiertas</h4>
						<div class="table-responsive">
							<table id="listopen" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
										<td>$320,800</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
										<td>$170,750</td>
									</tr>
									<tr>
										<td>Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
									</tr>
									<tr>
										<td>Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
										<td>$433,060</td>
									</tr>
									<tr>
										<td>Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
									</tr>
									<tr>
										<td>Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
									</tr>
									<tr>
										<td>Herrod Chandler</td>
										<td>Sales Assistant</td>
										<td>San Francisco</td>
										<td>59</td>
										<td>2012/08/06</td>
										<td>$137,500</td>
									</tr>
									<tr>
										<td>Rhona Davidson</td>
										<td>Integration Specialist</td>
										<td>Tokyo</td>
										<td>55</td>
										<td>2010/10/14</td>
										<td>$327,900</td>
									</tr>
									<tr>
										<td>Colleen Hurst</td>
										<td>Javascript Developer</td>
										<td>San Francisco</td>
										<td>39</td>
										<td>2009/09/15</td>
										<td>$205,500</td>
									</tr>
									<tr>
										<td>Sonya Frost</td>
										<td>Software Engineer</td>
										<td>Edinburgh</td>
										<td>23</td>
										<td>2008/12/13</td>
										<td>$103,600</td>
									</tr>
									<tr>
										<td>Jena Gaines</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>30</td>
										<td>2008/12/19</td>
										<td>$90,560</td>
									</tr>
									<tr>
										<td>Quinn Flynn</td>
										<td>Support Lead</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2013/03/03</td>
										<td>$342,000</td>
									</tr>
									<tr>
										<td>Charde Marshall</td>
										<td>Regional Director</td>
										<td>San Francisco</td>
										<td>36</td>
										<td>2008/10/16</td>
										<td>$470,600</td>
									</tr>
									<tr>
										<td>Haley Kennedy</td>
										<td>Senior Marketing Designer</td>
										<td>London</td>
										<td>43</td>
										<td>2012/12/18</td>
										<td>$313,500</td>
									</tr>
									<tr>
										<td>Tatyana Fitzpatrick</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>19</td>
										<td>2010/03/17</td>
										<td>$385,750</td>
									</tr>
									<tr>
										<td>Michael Silva</td>
										<td>Marketing Designer</td>
										<td>London</td>
										<td>66</td>
										<td>2012/11/27</td>
										<td>$198,500</td>
									</tr>
									<tr>
										<td>Paul Byrd</td>
										<td>Chief Financial Officer (CFO)</td>
										<td>New York</td>
										<td>64</td>
										<td>2010/06/09</td>
										<td>$725,000</td>
									</tr>
									<tr>
										<td>Gloria Little</td>
										<td>Systems Administrator</td>
										<td>New York</td>
										<td>59</td>
										<td>2009/04/10</td>
										<td>$237,500</td>
									</tr>
									<tr>
										<td>Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>41</td>
										<td>2012/10/13</td>
										<td>$132,000</td>
									</tr>
									<tr>
										<td>Dai Rios</td>
										<td>Personnel Lead</td>
										<td>Edinburgh</td>
										<td>35</td>
										<td>2012/09/26</td>
										<td>$217,500</td>
									</tr>
									<tr>
										<td>Jenette Caldwell</td>
										<td>Development Lead</td>
										<td>New York</td>
										<td>30</td>
										<td>2011/09/03</td>
										<td>$345,000</td>
									</tr>
									<tr>
										<td>Yuri Berry</td>
										<td>Chief Marketing Officer (CMO)</td>
										<td>New York</td>
										<td>40</td>
										<td>2009/06/25</td>
										<td>$675,000</td>
									</tr>
									<tr>
										<td>Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>
										<td>21</td>
										<td>2011/12/12</td>
										<td>$106,450</td>
									</tr>
									<tr>
										<td>Doris Wilder</td>
										<td>Sales Assistant</td>
										<td>Sidney</td>
										<td>23</td>
										<td>2010/09/20</td>
										<td>$85,600</td>
									</tr>
									<tr>
										<td>Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>47</td>
										<td>2009/10/09</td>
										<td>$1,200,000</td>
									</tr>
									<tr>
										<td>Gavin Joyce</td>
										<td>Developer</td>
										<td>Edinburgh</td>
										<td>42</td>
										<td>2010/12/22</td>
										<td>$92,575</td>
									</tr>
									<tr>
										<td>Jennifer Chang</td>
										<td>Regional Director</td>
										<td>Singapore</td>
										<td>28</td>
										<td>2010/11/14</td>
										<td>$357,650</td>
									</tr>
									<tr>
										<td>Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>28</td>
										<td>2011/06/07</td>
										<td>$206,850</td>
									</tr>
									<tr>
										<td>Fiona Green</td>
										<td>Chief Operating Officer (COO)</td>
										<td>San Francisco</td>
										<td>48</td>
										<td>2010/03/11</td>
										<td>$850,000</td>
									</tr>
									<tr>
										<td>Shou Itou</td>
										<td>Regional Marketing</td>
										<td>Tokyo</td>
										<td>20</td>
										<td>2011/08/14</td>
										<td>$163,000</td>
									</tr>
									<tr>
										<td>Michelle House</td>
										<td>Integration Specialist</td>
										<td>Sidney</td>
										<td>37</td>
										<td>2011/06/02</td>
										<td>$95,400</td>
									</tr>
									<tr>
										<td>Suki Burks</td>
										<td>Developer</td>
										<td>London</td>
										<td>53</td>
										<td>2009/10/22</td>
										<td>$114,500</td>
									</tr>
									<tr>
										<td>Prescott Bartlett</td>
										<td>Technical Author</td>
										<td>London</td>
										<td>27</td>
										<td>2011/05/07</td>
										<td>$145,000</td>
									</tr>
									<tr>
										<td>Gavin Cortez</td>
										<td>Team Leader</td>
										<td>San Francisco</td>
										<td>22</td>
										<td>2008/10/26</td>
										<td>$235,500</td>
									</tr>
									<tr>
										<td>Martena Mccray</td>
										<td>Post-Sales support</td>
										<td>Edinburgh</td>
										<td>46</td>
										<td>2011/03/09</td>
										<td>$324,050</td>
									</tr>
									<tr>
										<td>Unity Butler</td>
										<td>Marketing Designer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/12/09</td>
										<td>$85,675</td>
									</tr>
									<tr>
										<td>Howard Hatfield</td>
										<td>Office Manager</td>
										<td>San Francisco</td>
										<td>51</td>
										<td>2008/12/16</td>
										<td>$164,500</td>
									</tr>
									<tr>
										<td>Hope Fuentes</td>
										<td>Secretary</td>
										<td>San Francisco</td>
										<td>41</td>
										<td>2010/02/12</td>
										<td>$109,850</td>
									</tr>
									<tr>
										<td>Vivian Harrell</td>
										<td>Financial Controller</td>
										<td>San Francisco</td>
										<td>62</td>
										<td>2009/02/14</td>
										<td>$452,500</td>
									</tr>
									<tr>
										<td>Timothy Mooney</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>37</td>
										<td>2008/12/11</td>
										<td>$136,200</td>
									</tr>
									<tr>
										<td>Jackson Bradshaw</td>
										<td>Director</td>
										<td>New York</td>
										<td>65</td>
										<td>2008/09/26</td>
										<td>$645,750</td>
									</tr>
									<tr>
										<td>Olivia Liang</td>
										<td>Support Engineer</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2011/02/03</td>
										<td>$234,500</td>
									</tr>
									<tr>
										<td>Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>38</td>
										<td>2011/05/03</td>
										<td>$163,500</td>
									</tr>
									<tr>
										<td>Sakura Yamamoto</td>
										<td>Support Engineer</td>
										<td>Tokyo</td>
										<td>37</td>
										<td>2009/08/19</td>
										<td>$139,575</td>
									</tr>
									<tr>
										<td>Thor Walton</td>
										<td>Developer</td>
										<td>New York</td>
										<td>61</td>
										<td>2013/08/11</td>
										<td>$98,540</td>
									</tr>
									<tr>
										<td>Finn Camacho</td>
										<td>Support Engineer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/07/07</td>
										<td>$87,500</td>
									</tr>
									<tr>
										<td>Serge Baldwin</td>
										<td>Data Coordinator</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2012/04/09</td>
										<td>$138,575</td>
									</tr>
									<tr>
										<td>Zenaida Frank</td>
										<td>Software Engineer</td>
										<td>New York</td>
										<td>63</td>
										<td>2010/01/04</td>
										<td>$125,250</td>
									</tr>
									<tr>
										<td>Zorita Serrano</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>56</td>
										<td>2012/06/01</td>
										<td>$115,000</td>
									</tr>
									<tr>
										<td>Jennifer Acosta</td>
										<td>Junior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>43</td>
										<td>2013/02/01</td>
										<td>$75,650</td>
									</tr>
									<tr>
										<td>Cara Stevens</td>
										<td>Sales Assistant</td>
										<td>New York</td>
										<td>46</td>
										<td>2011/12/06</td>
										<td>$145,600</td>
									</tr>
									<tr>
										<td>Hermione Butler</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>47</td>
										<td>2011/03/21</td>
										<td>$356,250</td>
									</tr>
									<tr>
										<td>Lael Greer</td>
										<td>Systems Administrator</td>
										<td>London</td>
										<td>21</td>
										<td>2009/02/27</td>
										<td>$103,500</td>
									</tr>
									<tr>
										<td>Jonas Alexander</td>
										<td>Developer</td>
										<td>San Francisco</td>
										<td>30</td>
										<td>2010/07/14</td>
										<td>$86,500</td>
									</tr>
									<tr>
										<td>Shad Decker</td>
										<td>Regional Director</td>
										<td>Edinburgh</td>
										<td>51</td>
										<td>2008/11/13</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Michael Bruce</td>
										<td>Javascript Developer</td>
										<td>Singapore</td>
										<td>29</td>
										<td>2011/06/27</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Donna Snider</td>
										<td>Customer Support</td>
										<td>New York</td>
										<td>27</td>
										<td>2011/01/25</td>
										<td>$112,000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Sin Confirmar</h4>
						<div class="table-responsive">
							<table id="listconfirm" class="table table-striped responsive table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
										<td>$320,800</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
										<td>$170,750</td>
									</tr>
									<tr>
										<td>Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
									</tr>
									<tr>
										<td>Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
										<td>$433,060</td>
									</tr>
									<tr>
										<td>Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
									</tr>
									<tr>
										<td>Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
									</tr>
									<tr>
										<td>Herrod Chandler</td>
										<td>Sales Assistant</td>
										<td>San Francisco</td>
										<td>59</td>
										<td>2012/08/06</td>
										<td>$137,500</td>
									</tr>
									<tr>
										<td>Rhona Davidson</td>
										<td>Integration Specialist</td>
										<td>Tokyo</td>
										<td>55</td>
										<td>2010/10/14</td>
										<td>$327,900</td>
									</tr>
									<tr>
										<td>Colleen Hurst</td>
										<td>Javascript Developer</td>
										<td>San Francisco</td>
										<td>39</td>
										<td>2009/09/15</td>
										<td>$205,500</td>
									</tr>
									<tr>
										<td>Sonya Frost</td>
										<td>Software Engineer</td>
										<td>Edinburgh</td>
										<td>23</td>
										<td>2008/12/13</td>
										<td>$103,600</td>
									</tr>
									<tr>
										<td>Jena Gaines</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>30</td>
										<td>2008/12/19</td>
										<td>$90,560</td>
									</tr>
									<tr>
										<td>Quinn Flynn</td>
										<td>Support Lead</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2013/03/03</td>
										<td>$342,000</td>
									</tr>
									<tr>
										<td>Charde Marshall</td>
										<td>Regional Director</td>
										<td>San Francisco</td>
										<td>36</td>
										<td>2008/10/16</td>
										<td>$470,600</td>
									</tr>
									<tr>
										<td>Haley Kennedy</td>
										<td>Senior Marketing Designer</td>
										<td>London</td>
										<td>43</td>
										<td>2012/12/18</td>
										<td>$313,500</td>
									</tr>
									<tr>
										<td>Tatyana Fitzpatrick</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>19</td>
										<td>2010/03/17</td>
										<td>$385,750</td>
									</tr>
									<tr>
										<td>Michael Silva</td>
										<td>Marketing Designer</td>
										<td>London</td>
										<td>66</td>
										<td>2012/11/27</td>
										<td>$198,500</td>
									</tr>
									<tr>
										<td>Paul Byrd</td>
										<td>Chief Financial Officer (CFO)</td>
										<td>New York</td>
										<td>64</td>
										<td>2010/06/09</td>
										<td>$725,000</td>
									</tr>
									<tr>
										<td>Gloria Little</td>
										<td>Systems Administrator</td>
										<td>New York</td>
										<td>59</td>
										<td>2009/04/10</td>
										<td>$237,500</td>
									</tr>
									<tr>
										<td>Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>41</td>
										<td>2012/10/13</td>
										<td>$132,000</td>
									</tr>
									<tr>
										<td>Dai Rios</td>
										<td>Personnel Lead</td>
										<td>Edinburgh</td>
										<td>35</td>
										<td>2012/09/26</td>
										<td>$217,500</td>
									</tr>
									<tr>
										<td>Jenette Caldwell</td>
										<td>Development Lead</td>
										<td>New York</td>
										<td>30</td>
										<td>2011/09/03</td>
										<td>$345,000</td>
									</tr>
									<tr>
										<td>Yuri Berry</td>
										<td>Chief Marketing Officer (CMO)</td>
										<td>New York</td>
										<td>40</td>
										<td>2009/06/25</td>
										<td>$675,000</td>
									</tr>
									<tr>
										<td>Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>
										<td>21</td>
										<td>2011/12/12</td>
										<td>$106,450</td>
									</tr>
									<tr>
										<td>Doris Wilder</td>
										<td>Sales Assistant</td>
										<td>Sidney</td>
										<td>23</td>
										<td>2010/09/20</td>
										<td>$85,600</td>
									</tr>
									<tr>
										<td>Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>47</td>
										<td>2009/10/09</td>
										<td>$1,200,000</td>
									</tr>
									<tr>
										<td>Gavin Joyce</td>
										<td>Developer</td>
										<td>Edinburgh</td>
										<td>42</td>
										<td>2010/12/22</td>
										<td>$92,575</td>
									</tr>
									<tr>
										<td>Jennifer Chang</td>
										<td>Regional Director</td>
										<td>Singapore</td>
										<td>28</td>
										<td>2010/11/14</td>
										<td>$357,650</td>
									</tr>
									<tr>
										<td>Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>28</td>
										<td>2011/06/07</td>
										<td>$206,850</td>
									</tr>
									<tr>
										<td>Fiona Green</td>
										<td>Chief Operating Officer (COO)</td>
										<td>San Francisco</td>
										<td>48</td>
										<td>2010/03/11</td>
										<td>$850,000</td>
									</tr>
									<tr>
										<td>Shou Itou</td>
										<td>Regional Marketing</td>
										<td>Tokyo</td>
										<td>20</td>
										<td>2011/08/14</td>
										<td>$163,000</td>
									</tr>
									<tr>
										<td>Michelle House</td>
										<td>Integration Specialist</td>
										<td>Sidney</td>
										<td>37</td>
										<td>2011/06/02</td>
										<td>$95,400</td>
									</tr>
									<tr>
										<td>Suki Burks</td>
										<td>Developer</td>
										<td>London</td>
										<td>53</td>
										<td>2009/10/22</td>
										<td>$114,500</td>
									</tr>
									<tr>
										<td>Prescott Bartlett</td>
										<td>Technical Author</td>
										<td>London</td>
										<td>27</td>
										<td>2011/05/07</td>
										<td>$145,000</td>
									</tr>
									<tr>
										<td>Gavin Cortez</td>
										<td>Team Leader</td>
										<td>San Francisco</td>
										<td>22</td>
										<td>2008/10/26</td>
										<td>$235,500</td>
									</tr>
									<tr>
										<td>Martena Mccray</td>
										<td>Post-Sales support</td>
										<td>Edinburgh</td>
										<td>46</td>
										<td>2011/03/09</td>
										<td>$324,050</td>
									</tr>
									<tr>
										<td>Unity Butler</td>
										<td>Marketing Designer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/12/09</td>
										<td>$85,675</td>
									</tr>
									<tr>
										<td>Howard Hatfield</td>
										<td>Office Manager</td>
										<td>San Francisco</td>
										<td>51</td>
										<td>2008/12/16</td>
										<td>$164,500</td>
									</tr>
									<tr>
										<td>Hope Fuentes</td>
										<td>Secretary</td>
										<td>San Francisco</td>
										<td>41</td>
										<td>2010/02/12</td>
										<td>$109,850</td>
									</tr>
									<tr>
										<td>Vivian Harrell</td>
										<td>Financial Controller</td>
										<td>San Francisco</td>
										<td>62</td>
										<td>2009/02/14</td>
										<td>$452,500</td>
									</tr>
									<tr>
										<td>Timothy Mooney</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>37</td>
										<td>2008/12/11</td>
										<td>$136,200</td>
									</tr>
									<tr>
										<td>Jackson Bradshaw</td>
										<td>Director</td>
										<td>New York</td>
										<td>65</td>
										<td>2008/09/26</td>
										<td>$645,750</td>
									</tr>
									<tr>
										<td>Olivia Liang</td>
										<td>Support Engineer</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2011/02/03</td>
										<td>$234,500</td>
									</tr>
									<tr>
										<td>Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>38</td>
										<td>2011/05/03</td>
										<td>$163,500</td>
									</tr>
									<tr>
										<td>Sakura Yamamoto</td>
										<td>Support Engineer</td>
										<td>Tokyo</td>
										<td>37</td>
										<td>2009/08/19</td>
										<td>$139,575</td>
									</tr>
									<tr>
										<td>Thor Walton</td>
										<td>Developer</td>
										<td>New York</td>
										<td>61</td>
										<td>2013/08/11</td>
										<td>$98,540</td>
									</tr>
									<tr>
										<td>Finn Camacho</td>
										<td>Support Engineer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/07/07</td>
										<td>$87,500</td>
									</tr>
									<tr>
										<td>Serge Baldwin</td>
										<td>Data Coordinator</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2012/04/09</td>
										<td>$138,575</td>
									</tr>
									<tr>
										<td>Zenaida Frank</td>
										<td>Software Engineer</td>
										<td>New York</td>
										<td>63</td>
										<td>2010/01/04</td>
										<td>$125,250</td>
									</tr>
									<tr>
										<td>Zorita Serrano</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>56</td>
										<td>2012/06/01</td>
										<td>$115,000</td>
									</tr>
									<tr>
										<td>Jennifer Acosta</td>
										<td>Junior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>43</td>
										<td>2013/02/01</td>
										<td>$75,650</td>
									</tr>
									<tr>
										<td>Cara Stevens</td>
										<td>Sales Assistant</td>
										<td>New York</td>
										<td>46</td>
										<td>2011/12/06</td>
										<td>$145,600</td>
									</tr>
									<tr>
										<td>Hermione Butler</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>47</td>
										<td>2011/03/21</td>
										<td>$356,250</td>
									</tr>
									<tr>
										<td>Lael Greer</td>
										<td>Systems Administrator</td>
										<td>London</td>
										<td>21</td>
										<td>2009/02/27</td>
										<td>$103,500</td>
									</tr>
									<tr>
										<td>Jonas Alexander</td>
										<td>Developer</td>
										<td>San Francisco</td>
										<td>30</td>
										<td>2010/07/14</td>
										<td>$86,500</td>
									</tr>
									<tr>
										<td>Shad Decker</td>
										<td>Regional Director</td>
										<td>Edinburgh</td>
										<td>51</td>
										<td>2008/11/13</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Michael Bruce</td>
										<td>Javascript Developer</td>
										<td>Singapore</td>
										<td>29</td>
										<td>2011/06/27</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Donna Snider</td>
										<td>Customer Support</td>
										<td>New York</td>
										<td>27</td>
										<td>2011/01/25</td>
										<td>$112,000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Cerradas</h4>
						<div class="table-responsive">
							<table id="listclosed" class="table table-striped responsive table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
										<td>$320,800</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
										<td>$170,750</td>
									</tr>
									<tr>
										<td>Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
									</tr>
									<tr>
										<td>Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
										<td>$433,060</td>
									</tr>
									<tr>
										<td>Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
									</tr>
									<tr>
										<td>Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
									</tr>
									<tr>
										<td>Herrod Chandler</td>
										<td>Sales Assistant</td>
										<td>San Francisco</td>
										<td>59</td>
										<td>2012/08/06</td>
										<td>$137,500</td>
									</tr>
									<tr>
										<td>Rhona Davidson</td>
										<td>Integration Specialist</td>
										<td>Tokyo</td>
										<td>55</td>
										<td>2010/10/14</td>
										<td>$327,900</td>
									</tr>
									<tr>
										<td>Colleen Hurst</td>
										<td>Javascript Developer</td>
										<td>San Francisco</td>
										<td>39</td>
										<td>2009/09/15</td>
										<td>$205,500</td>
									</tr>
									<tr>
										<td>Sonya Frost</td>
										<td>Software Engineer</td>
										<td>Edinburgh</td>
										<td>23</td>
										<td>2008/12/13</td>
										<td>$103,600</td>
									</tr>
									<tr>
										<td>Jena Gaines</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>30</td>
										<td>2008/12/19</td>
										<td>$90,560</td>
									</tr>
									<tr>
										<td>Quinn Flynn</td>
										<td>Support Lead</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2013/03/03</td>
										<td>$342,000</td>
									</tr>
									<tr>
										<td>Charde Marshall</td>
										<td>Regional Director</td>
										<td>San Francisco</td>
										<td>36</td>
										<td>2008/10/16</td>
										<td>$470,600</td>
									</tr>
									<tr>
										<td>Haley Kennedy</td>
										<td>Senior Marketing Designer</td>
										<td>London</td>
										<td>43</td>
										<td>2012/12/18</td>
										<td>$313,500</td>
									</tr>
									<tr>
										<td>Tatyana Fitzpatrick</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>19</td>
										<td>2010/03/17</td>
										<td>$385,750</td>
									</tr>
									<tr>
										<td>Michael Silva</td>
										<td>Marketing Designer</td>
										<td>London</td>
										<td>66</td>
										<td>2012/11/27</td>
										<td>$198,500</td>
									</tr>
									<tr>
										<td>Paul Byrd</td>
										<td>Chief Financial Officer (CFO)</td>
										<td>New York</td>
										<td>64</td>
										<td>2010/06/09</td>
										<td>$725,000</td>
									</tr>
									<tr>
										<td>Gloria Little</td>
										<td>Systems Administrator</td>
										<td>New York</td>
										<td>59</td>
										<td>2009/04/10</td>
										<td>$237,500</td>
									</tr>
									<tr>
										<td>Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>41</td>
										<td>2012/10/13</td>
										<td>$132,000</td>
									</tr>
									<tr>
										<td>Dai Rios</td>
										<td>Personnel Lead</td>
										<td>Edinburgh</td>
										<td>35</td>
										<td>2012/09/26</td>
										<td>$217,500</td>
									</tr>
									<tr>
										<td>Jenette Caldwell</td>
										<td>Development Lead</td>
										<td>New York</td>
										<td>30</td>
										<td>2011/09/03</td>
										<td>$345,000</td>
									</tr>
									<tr>
										<td>Yuri Berry</td>
										<td>Chief Marketing Officer (CMO)</td>
										<td>New York</td>
										<td>40</td>
										<td>2009/06/25</td>
										<td>$675,000</td>
									</tr>
									<tr>
										<td>Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>
										<td>21</td>
										<td>2011/12/12</td>
										<td>$106,450</td>
									</tr>
									<tr>
										<td>Doris Wilder</td>
										<td>Sales Assistant</td>
										<td>Sidney</td>
										<td>23</td>
										<td>2010/09/20</td>
										<td>$85,600</td>
									</tr>
									<tr>
										<td>Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>47</td>
										<td>2009/10/09</td>
										<td>$1,200,000</td>
									</tr>
									<tr>
										<td>Gavin Joyce</td>
										<td>Developer</td>
										<td>Edinburgh</td>
										<td>42</td>
										<td>2010/12/22</td>
										<td>$92,575</td>
									</tr>
									<tr>
										<td>Jennifer Chang</td>
										<td>Regional Director</td>
										<td>Singapore</td>
										<td>28</td>
										<td>2010/11/14</td>
										<td>$357,650</td>
									</tr>
									<tr>
										<td>Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>28</td>
										<td>2011/06/07</td>
										<td>$206,850</td>
									</tr>
									<tr>
										<td>Fiona Green</td>
										<td>Chief Operating Officer (COO)</td>
										<td>San Francisco</td>
										<td>48</td>
										<td>2010/03/11</td>
										<td>$850,000</td>
									</tr>
									<tr>
										<td>Shou Itou</td>
										<td>Regional Marketing</td>
										<td>Tokyo</td>
										<td>20</td>
										<td>2011/08/14</td>
										<td>$163,000</td>
									</tr>
									<tr>
										<td>Michelle House</td>
										<td>Integration Specialist</td>
										<td>Sidney</td>
										<td>37</td>
										<td>2011/06/02</td>
										<td>$95,400</td>
									</tr>
									<tr>
										<td>Suki Burks</td>
										<td>Developer</td>
										<td>London</td>
										<td>53</td>
										<td>2009/10/22</td>
										<td>$114,500</td>
									</tr>
									<tr>
										<td>Prescott Bartlett</td>
										<td>Technical Author</td>
										<td>London</td>
										<td>27</td>
										<td>2011/05/07</td>
										<td>$145,000</td>
									</tr>
									<tr>
										<td>Gavin Cortez</td>
										<td>Team Leader</td>
										<td>San Francisco</td>
										<td>22</td>
										<td>2008/10/26</td>
										<td>$235,500</td>
									</tr>
									<tr>
										<td>Martena Mccray</td>
										<td>Post-Sales support</td>
										<td>Edinburgh</td>
										<td>46</td>
										<td>2011/03/09</td>
										<td>$324,050</td>
									</tr>
									<tr>
										<td>Unity Butler</td>
										<td>Marketing Designer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/12/09</td>
										<td>$85,675</td>
									</tr>
									<tr>
										<td>Howard Hatfield</td>
										<td>Office Manager</td>
										<td>San Francisco</td>
										<td>51</td>
										<td>2008/12/16</td>
										<td>$164,500</td>
									</tr>
									<tr>
										<td>Hope Fuentes</td>
										<td>Secretary</td>
										<td>San Francisco</td>
										<td>41</td>
										<td>2010/02/12</td>
										<td>$109,850</td>
									</tr>
									<tr>
										<td>Vivian Harrell</td>
										<td>Financial Controller</td>
										<td>San Francisco</td>
										<td>62</td>
										<td>2009/02/14</td>
										<td>$452,500</td>
									</tr>
									<tr>
										<td>Timothy Mooney</td>
										<td>Office Manager</td>
										<td>London</td>
										<td>37</td>
										<td>2008/12/11</td>
										<td>$136,200</td>
									</tr>
									<tr>
										<td>Jackson Bradshaw</td>
										<td>Director</td>
										<td>New York</td>
										<td>65</td>
										<td>2008/09/26</td>
										<td>$645,750</td>
									</tr>
									<tr>
										<td>Olivia Liang</td>
										<td>Support Engineer</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2011/02/03</td>
										<td>$234,500</td>
									</tr>
									<tr>
										<td>Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>38</td>
										<td>2011/05/03</td>
										<td>$163,500</td>
									</tr>
									<tr>
										<td>Sakura Yamamoto</td>
										<td>Support Engineer</td>
										<td>Tokyo</td>
										<td>37</td>
										<td>2009/08/19</td>
										<td>$139,575</td>
									</tr>
									<tr>
										<td>Thor Walton</td>
										<td>Developer</td>
										<td>New York</td>
										<td>61</td>
										<td>2013/08/11</td>
										<td>$98,540</td>
									</tr>
									<tr>
										<td>Finn Camacho</td>
										<td>Support Engineer</td>
										<td>San Francisco</td>
										<td>47</td>
										<td>2009/07/07</td>
										<td>$87,500</td>
									</tr>
									<tr>
										<td>Serge Baldwin</td>
										<td>Data Coordinator</td>
										<td>Singapore</td>
										<td>64</td>
										<td>2012/04/09</td>
										<td>$138,575</td>
									</tr>
									<tr>
										<td>Zenaida Frank</td>
										<td>Software Engineer</td>
										<td>New York</td>
										<td>63</td>
										<td>2010/01/04</td>
										<td>$125,250</td>
									</tr>
									<tr>
										<td>Zorita Serrano</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
										<td>56</td>
										<td>2012/06/01</td>
										<td>$115,000</td>
									</tr>
									<tr>
										<td>Jennifer Acosta</td>
										<td>Junior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>43</td>
										<td>2013/02/01</td>
										<td>$75,650</td>
									</tr>
									<tr>
										<td>Cara Stevens</td>
										<td>Sales Assistant</td>
										<td>New York</td>
										<td>46</td>
										<td>2011/12/06</td>
										<td>$145,600</td>
									</tr>
									<tr>
										<td>Hermione Butler</td>
										<td>Regional Director</td>
										<td>London</td>
										<td>47</td>
										<td>2011/03/21</td>
										<td>$356,250</td>
									</tr>
									<tr>
										<td>Lael Greer</td>
										<td>Systems Administrator</td>
										<td>London</td>
										<td>21</td>
										<td>2009/02/27</td>
										<td>$103,500</td>
									</tr>
									<tr>
										<td>Jonas Alexander</td>
										<td>Developer</td>
										<td>San Francisco</td>
										<td>30</td>
										<td>2010/07/14</td>
										<td>$86,500</td>
									</tr>
									<tr>
										<td>Shad Decker</td>
										<td>Regional Director</td>
										<td>Edinburgh</td>
										<td>51</td>
										<td>2008/11/13</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Michael Bruce</td>
										<td>Javascript Developer</td>
										<td>Singapore</td>
										<td>29</td>
										<td>2011/06/27</td>
										<td>$183,000</td>
									</tr>
									<tr>
										<td>Donna Snider</td>
										<td>Customer Support</td>
										<td>New York</td>
										<td>27</td>
										<td>2011/01/25</td>
										<td>$112,000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Mensajes</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Cantidad</strong></td>
										<td class="text-center"><strong>Total</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Sin Confirmar</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado, Sin Calificar</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado y Calificado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Calificacion</h4>
						<div id="chartseller" style="height: 370px;"></div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Grafica de Ventas</h4>
						<div id="chartselling" style="height: 370px;"></div>
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
			"sSearch":         "Buscar:",
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
			"sSearch":         "Buscar:",
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
			"sSearch":         "Buscar:",
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