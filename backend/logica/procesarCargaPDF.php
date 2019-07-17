<?php
session_start();
/*
Detalles:
No puede existir mas de 18 items por Hoja!
Asi que dividir Cantidad total de items / 18 redondeo para arriba
	--> ceil( count($datos_factura) / 18 ) Redondea la fraccion al siguiente numero entero (para arriba siempre)
*/
require_once('../logica/funciones.php');
require_once('../clases/Factura.class.php');
$config = include('../config/config.php');
$staticsrv=$config->staticsrv;
$_SESSION["facid"]=$_GET["id"];	
$datos_factura = require_once('../logica/procesarCargarFactura.php');
unset($_SESSION["facid"]);
require('../logica/fpdf/fpdf.php');
/*var_dump($datos_factura);
$datos_factura[0]['FECHAC'];*/
$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetAutoPagebreak(False);
$pdf->SetMargins(0,0,0);
$pdf->AddPage();
$pdf->Image($staticsrv.'/img/aaa.png', 10, 10, 80, 30);
$pdf->SetXY( 120, 5 );
$pdf->SetFont( "Arial", "B", 12 ); 
$pdf->Cell( 140, 8, "Pagina 1" . ' / ' . ceil( count($datos_factura) / 18 ) , 0, 0, 'C');
$num_fact = "FACTURA " . date("Y", strtotime($datos_factura[0]['FECHAC'])) .'-' . $datos_factura[0]['ID'];
$pdf->SetLineWidth(0.1); 
$pdf->SetFillColor(192); 
$pdf->Rect(120, 15, 85, 8, "DF");
$pdf->SetXY( 120, 15 ); 
$pdf->SetFont( "Arial", "B", 12 );
$pdf->Cell( 85, 8, $num_fact, 0, 0, 'C');
$nom_file = "fact_" . "2018" .'-' . "13" . ".pdf";
$pdf->SetFont('Arial','',11); 
$pdf->SetXY( 122, 30 );
$pdf->Cell( 60, 8, "Montevideo, Uruguay, " . date("d/m/Y", strtotime($datos_factura[0]['FECHAC'])), 0, 0, '');
$pdf->SetLineWidth(0.1); 
$pdf->SetFillColor(192); 
$pdf->Rect(5, 213, 200, 8, "DF");
$pdf->SetFont('Arial','',10);
$pdf->SetXY( 95, 213 ); 
//$pdf->Cell( 63, 8, "", 0, 0, 'C');
$pdf->SetFont('Arial','B',8);
$pdf->SetXY( 181, 227 );
$pdf->Cell( 24, 6, "", 0, 0, 'R');
/*$pdf->Rect(5, 213, 200, 8, "D");
/*$pdf->Line(95, 213, 95, 221); 
$pdf->Line(158, 213, 158, 221);*/
$pdf->SetXY( 5, 225 );
$pdf->Cell( 38, 5, "Formas de Pago :", 0, 0, 'R'); 
$pdf->Cell( 55, 5, "Abitab, RedPagos. Por Efectivo y Tarjetas", 0, 0, 'L');
$pdf->SetXY( 5, 230 ); 
$pdf->Cell( 38, 5, "                ", 0, 0, 'R'); 
$pdf->Cell( 55, 5, "consultar con Vendedor", 0, 0, 'L');
$pdf->SetXY( 5, 235 ); 
$pdf->Cell( 38, 5, "Vencimiento :", 0, 0, 'R');
$pdf->Cell( 38, 5, date("d/m/Y", strtotime($datos_factura[0]['FECHAV'])), 0, 0, 'L');
$pdf->SetFont( "Arial", "BU", 10 ); 
$pdf->SetXY( 5, 75 ) ; 
/*         Observaciones
$pdf->Cell($pdf->GetStringWidth("Observaciones"), 0, "Observaciones", 0, "L");
*/
$pdf->SetFont( "Arial", "", 10 ); 
$pdf->SetXY( 5, 78 ) ; 
/*         Descripcion de Observaciones
$pdf->MultiCell(190, 4, 5, 0, "L");
*/
$pdf->SetFont('Arial','B',11); $x = 110 ; $y = 50;
$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, "Nombre: ".$datos_factura[0]['PNOMBRE']." ".$datos_factura[0]['PAPELLIDO'], 0, 0, ''); $y += 4;
$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, utf8_decode("Dirección: ").$datos_factura[0]['CALLE']." ".$datos_factura[0]['NUMERO'], 0, 0, ''); $y += 4;
$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, "Esquina: ".$datos_factura[0]['ESQUINA'], 0, 0, ''); $y += 4;
$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, "Departamento: ".ucfirst(strtolower($datos_factura[0]['DEPARTAMENTO'])), 0, 0, ''); $y += 4;
$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, "Localidad: ".$datos_factura[0]['LOCALIDAD'] . ' CP: ' . $datos_factura[0]['CPOSTAL'], 0, 0, ''); $y += 4;
$pdf->SetXY( $x, $y ); /*$pdf->Cell( 100, 8, 'Numero de IVA interno : ' , 0, 0, '');*/
$pdf->SetLineWidth(0.1); $pdf->Rect(5, 95, 200, 118, "D");
$pdf->Line(5, 105, 205, 105);
$pdf->Line(145, 95, 145, 213); 
$pdf->Line(158, 95, 158, 213); 
$pdf->Line(176, 95, 176, 213); 
$pdf->Line(190, 95, 190, 213);
$pdf->SetXY( 1, 96 ); 
$pdf->SetFont('Arial','B',8); 
$pdf->Cell( 140, 8, "Item", 0, 0, 'C');
$pdf->SetXY( 145, 96 ); 
$pdf->SetFont('Arial','B',8); 
$pdf->Cell( 13, 8, "Cant", 0, 0, 'C');
$pdf->SetXY( 156, 96 ); 
$pdf->SetFont('Arial','B',8); 
$pdf->Cell( 22, 8, "P/Unitario", 0, 0, 'C');
$pdf->SetXY( 177, 96 ); 
$pdf->SetFont('Arial','B',8); 
$pdf->Cell( 12, 8, "Comision", 0, 0, 'C');
$pdf->SetXY( 185, 96 ); 
$pdf->SetFont('Arial','B',8); 
$pdf->Cell( 24, 8, "SubTotal", 0, 0, 'C');
$pdf->SetFont('Arial','',8);
$y = 97;
/*---------------------------------------------------------------*/
$totalsiniva=0;
for ($i=0; $i < count($datos_factura); $i++) { 
	$pdf->SetXY( 7, $y+9 ); $pdf->Cell( 140, 5, $datos_factura[$i]['TITULO'], 0, 0, 'L');
	$pdf->SetXY( 145, $y+9 ); $pdf->Cell( 11, 5, $datos_factura[$i]['CANTIDAD'], 0, 0, 'R');
	$pdf->SetXY( 158, $y+9 ); $pdf->Cell( 16, 5, '$'.$datos_factura[$i]['TOTAL'], 0, 0, 'R');
	$pdf->SetXY( 177, $y+9 ); $pdf->Cell( 11, 5, '$'.$datos_factura[$i]['SUBTOTAL']/$datos_factura[$i]['CANTIDAD'], 0, 0, 'R');
	$pdf->SetXY( 187, $y+9 ); $pdf->Cell( 16, 5, '$'.$datos_factura[$i]['SUBTOTAL'], 0, 0, 'R');
	$pdf->Line(5, $y+14, 205, $y+14);
	$y += 6;
	$totalsiniva=$totalsiniva+$datos_factura[$i]['SUBTOTAL'];
}
/*---------------------------------------------------------------*/
/*    Dibujo de Totales     */
$pdf->SetLineWidth(0.1); $pdf->Rect(181, 221, 24, 24, "D");
//$pdf->Line(147, 221, 147, 245); $pdf->Line(164, 221, 164, 245); $pdf->Line(181, 221, 181, 245);
$pdf->Line(181, 227, 205, 227); $pdf->Line(181, 233, 205, 233); $pdf->Line(181, 239, 205, 239);
//$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 221 ); $pdf->Cell( 24, 6, "\$TOTAL IVA", 0, 0, 'C');
$pdf->SetFont('Arial','',8);
$x = 163;
$pdf->SetXY( $x, 221 ); $pdf->Cell( 17, 6, "Tasa de IVA" . ' %', 0, 0, 'R');
$pdf->SetXY( $x, 227 ); $pdf->Cell( 17, 6, "Total sin IVA", 0, 0, 'R');
$pdf->SetXY( $x, 233 ); $pdf->Cell( 17, 6, "IVA", 0, 0, 'R');
$pdf->SetXY( $x, 239 ); $pdf->Cell( 17, 6, "Total", 0, 0, 'R');
$x += 17;
$pdf->SetXY( $x, 221 ); $pdf->Cell( 17, 6, $config->iva. ' %', 0, 0, 'R');
$pdf->SetXY( $x, 227 ); $pdf->Cell( 17, 6, '$ '.$totalsiniva, 0, 0, 'R');
$pdf->SetXY( $x, 233 ); $pdf->Cell( 17, 6, '$ '.(($config->iva * $totalsiniva) / 100), 0, 0, 'R');
$pdf->SetXY( $x, 239 ); $pdf->Cell( 17, 6, '$ '.round((($config->iva * $totalsiniva) / 100)+$totalsiniva), 0, 0, 'R');

/*$pdf->SetFont('Arial','B',12); $pdf->SetXY( 5, 213 ); $pdf->Cell( 90, 8, "$$ Total", 0, 0, 'C');
$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 239 ); $pdf->Cell( 24, 6, "$$ Total", 0, 0, 'R');
$pdf->SetFont('Arial','',10); $pdf->SetXY( 158, 213 ); $pdf->Cell( 47, 8, "$$ Impuestos", 0, 0, 'C');
$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 233 ); $pdf->Cell( 24, 6, "$$ Total con iva", 0, 0, 'R');*/

/*Lineas de Mensaje Re Loco*/
$pdf->SetLineWidth(0.1); $pdf->Rect(5, 260, 200, 6, "D");
$pdf->SetXY( 1, 260 ); $pdf->SetFont('Arial','',7);
$pdf->Cell( $pdf->GetPageWidth(), 7, 'Estado de factura: '.$datos_factura[0]['ESTADO'], 0, 0, 'C');
$y1 = 270;
$pdf->SetXY( 1, $y1 ); $pdf->SetFont('Arial','B',10);
//$pdf->Cell( $pdf->GetPageWidth(), 5, "Referencia Bancaria", 0, 0, 'C');
$pdf->SetFont('Arial','',10);
$pdf->SetXY( 1, $y1 + 4 ); 
$pdf->Cell( $pdf->GetPageWidth(), 5, "Ninjastore", 0, 0, 'C');
$pdf->SetXY( 1, $y1 + 8 );
$pdf->Cell( $pdf->GetPageWidth(), 5, "Bulevar General Artigas 3035 cp 11400 Montevideo, Uruguay", 0, 0, 'C');
$pdf->SetXY( 1, $y1 + 12 );
$pdf->Cell( $pdf->GetPageWidth(), 5, "+598 2925 4596 hola@nijastore.uy", 0, 0, 'C');
$pdf->SetXY( 1, $y1 + 16 );
$pdf->Cell( $pdf->GetPageWidth(), 5, "https://ninjastore.uy", 0, 0, 'C'); 
$pdf->Output("I", $nom_file);
?>