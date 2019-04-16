<?php

//
// exemple de facture avec mysqli
// gere le multi-page
// Ver 1.0 THONGSOUME Jean-Paul
//


	require('fpdf.php');
	
	// le mettre au debut car plante si on declare $mysqli avant !
	$pdf = new FPDF( 'P', 'mm', 'A4' );

	// on declare $mysqli apres !
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	// cnx a la base
	mysqli_select_db($mysqli, DATABASE) or die('Erreur de connection à la BDD : ' .mysqli_connect_error());
	// FORCE UTF-8
//	mysqli_query($mysqli, "SET NAMES UTF8");


	$var_id_facture = $_GET['id_param'];

	// on sup les 2 cm en bas
	$pdf->SetAutoPagebreak(False);
	$pdf->SetMargins(0,0,0);

	// nb de page pour le multi-page : 18 lignes
	$sql = 'select count(*) FROM ligne_facture where id_facture=' .$var_id_facture;
	$result = mysqli_query($mysqli, $sql)  or die ('Erreur SQL : ' .$sql .mysqli_connect_error() );
	$row_client = mysqli_fetch_row($result);
	mysqli_free_result($result);
	$nb_page = $row_client[0];
	$sql = 'select abs(FLOOR(-' . $nb_page . '/18))';
	$result = mysqli_query($mysqli, $sql)  or die ('Erreur SQL : ' .$sql .mysqli_connect_error() );
	$row_client = mysqli_fetch_row($result);
	mysqli_free_result($result);
	$nb_page = $row_client[0];

	$num_page = 1; $limit_inf = 0; $limit_sup = 18;
	While ($num_page <= $nb_page)
	{
		$pdf->AddPage();
		
		// logo : 80 de largeur et 55 de hauteur
		$pdf->Image('logo_societe.png', 10, 10, 80, 55);

		// n° page en haute à droite
		$pdf->SetXY( 120, 5 ); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 160, 8, $num_page . '/' . $nb_page, 0, 0, 'C');
		
		// n° facture, date echeance et reglement et obs
		$select = 'select date,numero,mnt_ttc,mnt_ht,mnt_tva,obs,reglement,date_echeance FROM facture where id_facture=' .$var_id_facture;
		$result = mysqli_query($mysqli, $select)  or die ('Erreur SQL : ' .$select .mysqli_connect_error() );
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		
		$champ_date = date_create($row[0]); $annee = date_format($champ_date, 'Y');
		$num_fact = "FACTURE N° " . $annee .'-' . str_pad($row[1], 4, '0', STR_PAD_LEFT);
		$pdf->SetLineWidth(0.1); $pdf->SetFillColor(192); $pdf->Rect(120, 15, 85, 8, "DF");
		$pdf->SetXY( 120, 15 ); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 85, 8, $num_fact, 0, 0, 'C');
		
		// nom du fichier final
		$nom_file = "fact_" . $annee .'-' . str_pad($row[1], 4, '0', STR_PAD_LEFT) . ".pdf";
		
		// date facture
		$champ_date = date_create($row[0]); $date_fact = date_format($champ_date, 'd/m/Y');
		$pdf->SetFont('Arial','',11); $pdf->SetXY( 122, 30 );
		$pdf->Cell( 60, 8, "MA VILLE, le " . $date_fact, 0, 0, '');
		
		// si derniere page alors afficher total
		if ($num_page == $nb_page)
		{
			// les totaux, on n'affiche que le HT. le cadre après les lignes, demarre a 213
			$pdf->SetLineWidth(0.1); $pdf->SetFillColor(192); $pdf->Rect(5, 213, 90, 8, "DF");
			// HT, la TVA et TTC sont calculés après
			$nombre_format_francais = "Total HT : " . number_format($row[3], 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','',10); $pdf->SetXY( 95, 213 ); $pdf->Cell( 63, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 227 ); $pdf->Cell( 24, 6, number_format($row[3], 2, ',', ' '), 0, 0, 'R');

			// trait vertical cadre totaux, 8 de hauteur -> 213 + 8 = 221
			$pdf->Rect(5, 213, 200, 8, "D"); $pdf->Line(95, 213, 95, 221); $pdf->Line(158, 213, 158, 221);

			// reglement
			$pdf->SetXY( 5, 225 ); $pdf->Cell( 38, 5, "Mode de Règlement :", 0, 0, 'R'); $pdf->Cell( 55, 5, $row[6], 0, 0, 'L');
			// echeance
			$champ_date = date_create($row[7]); $date_ech = date_format($champ_date, 'd/m/Y');
			$pdf->SetXY( 5, 230 ); $pdf->Cell( 38, 5, "Date Echéance :", 0, 0, 'R'); $pdf->Cell( 38, 5, $date_ech, 0, 0, 'L');
		}
		
		// observations
		$pdf->SetFont( "Arial", "BU", 10 ); $pdf->SetXY( 5, 75 ) ; $pdf->Cell($pdf->GetStringWidth("Observations"), 0, "Observations", 0, "L");
		$pdf->SetFont( "Arial", "", 10 ); $pdf->SetXY( 5, 78 ) ; $pdf->MultiCell(190, 4, $row[5], 0, "L");

		// adr fact du client
		$select = "select nom,adr1,adr2,adr3,cp,ville,num_tva from client c join facture f on c.id_client=f.id_client where id_facture=" . $var_id_facture;
		$result = mysqli_query($mysqli, $select)  or die ('Erreur SQL : ' .$select .mysqli_connect_error() );
		$row_client = mysqli_fetch_row($result);
		mysqli_free_result($result);
		$pdf->SetFont('Arial','B',11); $x = 110 ; $y = 50;
		$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $row_client[0], 0, 0, ''); $y += 4;
		if ($row_client[1]) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $row_client[1], 0, 0, ''); $y += 4;}
		if ($row_client[2]) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $row_client[2], 0, 0, ''); $y += 4;}
		if ($row_client[3]) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $row_client[3], 0, 0, ''); $y += 4;}
		if ($row_client[4] || $row_client[5]) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $row_client[4] . ' ' .$row_client[5] , 0, 0, ''); $y += 4;}
		if ($row_client[6]) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, 'N° TVA Intra : ' . $row_client[6], 0, 0, '');}
		
		// ***********************
		// le cadre des articles
		// ***********************
		// cadre avec 18 lignes max ! et 118 de hauteur --> 95 + 118 = 213 pour les traits verticaux
		$pdf->SetLineWidth(0.1); $pdf->Rect(5, 95, 200, 118, "D");
		// cadre titre des colonnes
		$pdf->Line(5, 105, 205, 105);
		// les traits verticaux colonnes
		$pdf->Line(145, 95, 145, 213); $pdf->Line(158, 95, 158, 213); $pdf->Line(176, 95, 176, 213); $pdf->Line(187, 95, 187, 213);
		// titre colonne
		$pdf->SetXY( 1, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 140, 8, "Libellé", 0, 0, 'C');
		$pdf->SetXY( 145, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 13, 8, "Qté", 0, 0, 'C');
		$pdf->SetXY( 156, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 22, 8, "PU HT", 0, 0, 'C');
		$pdf->SetXY( 177, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 10, 8, "TVA", 0, 0, 'C');
		$pdf->SetXY( 185, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 22, 8, "TOTAL HT", 0, 0, 'C');
		
		// les articles
		$pdf->SetFont('Arial','',8);
		$y = 97;
		// 1ere page = LIMIT 0,18 ;  2eme page = LIMIT 18,36 etc...
		$sql = 'select libelle,qte,pu,taux_tva FROM ligne_facture where id_facture=' .$var_id_facture . ' order by libelle';
		$sql .= ' LIMIT ' . $limit_inf . ',' . $limit_sup;
		$res = mysqli_query($mysqli, $sql)  or die ('Erreur SQL : ' .$sql .mysqli_connect_error() );
		while ($data =  mysqli_fetch_assoc($res))
		{
			// libelle
			$pdf->SetXY( 7, $y+9 ); $pdf->Cell( 140, 5, $data['libelle'], 0, 0, 'L');
			// qte
			$pdf->SetXY( 145, $y+9 ); $pdf->Cell( 13, 5, strrev(wordwrap(strrev($data['qte']), 3, ' ', true)), 0, 0, 'R');
			// PU
			$nombre_format_francais = number_format($data['pu'], 2, ',', ' ');
			$pdf->SetXY( 158, $y+9 ); $pdf->Cell( 18, 5, $nombre_format_francais, 0, 0, 'R');
			// Taux
			$nombre_format_francais = number_format($data['taux_tva'], 2, ',', ' ');
			$pdf->SetXY( 177, $y+9 ); $pdf->Cell( 10, 5, $nombre_format_francais, 0, 0, 'R');
			// total
			$nombre_format_francais = number_format($data['pu']*$data['qte'], 2, ',', ' ');
			$pdf->SetXY( 187, $y+9 ); $pdf->Cell( 18, 5, $nombre_format_francais, 0, 0, 'R');
			
			$pdf->Line(5, $y+14, 205, $y+14);
			
			$y += 6;
		}
		mysqli_free_result($res);

		// si derniere page alors afficher cadre des TVA
		if ($num_page == $nb_page)
		{
			// le detail des totaux, demarre a 221 après le cadre des totaux
			$pdf->SetLineWidth(0.1); $pdf->Rect(130, 221, 75, 24, "D");
			// les traits verticaux
			$pdf->Line(147, 221, 147, 245); $pdf->Line(164, 221, 164, 245); $pdf->Line(181, 221, 181, 245);
			// les traits horizontaux pas de 6 et demarre a 221
			$pdf->Line(130, 227, 205, 227); $pdf->Line(130, 233, 205, 233); $pdf->Line(130, 239, 205, 239);
			// les titres
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 221 ); $pdf->Cell( 24, 6, "TOTAL", 0, 0, 'C');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY( 105, 221 ); $pdf->Cell( 25, 6, "Taux TVA", 0, 0, 'R');
			$pdf->SetXY( 105, 227 ); $pdf->Cell( 25, 6, "Total HT", 0, 0, 'R');
			$pdf->SetXY( 105, 233 ); $pdf->Cell( 25, 6, "Total TVA", 0, 0, 'R');
			$pdf->SetXY( 105, 239 ); $pdf->Cell( 25, 6, "Total TTC", 0, 0, 'R');

			// les taux de tva et HT et TTC
			$col_ht = 0; $col_tva = 0; $col_ttc = 0;
			$taux = 0; $tot_tva = 0; $tot_ttc = 0;
			$x = 130;
			$sql = 'select taux_tva,sum( round(pu * qte,2) ) tot_ht FROM ligne_facture where id_facture=' .$var_id_facture . ' group by taux_tva order by taux_tva';
			$res = mysqli_query($mysqli, $sql)  or die ('Erreur SQL : ' .$sql .mysqli_connect_error() );
			while ($data =  mysqli_fetch_assoc($res))
			{
				$pdf->SetXY( $x, 221 ); $pdf->Cell( 17, 6, $data['taux_tva'] . ' %', 0, 0, 'C');
				$taux = $data['taux_tva'];

				$nombre_format_francais = number_format($data['tot_ht'], 2, ',', ' ');
				$pdf->SetXY( $x, 227 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				$col_ht = $data['tot_ht'];
				
				$col_tva = $col_ht - ($col_ht * (1-($taux/100)));
				$nombre_format_francais = number_format($col_tva, 2, ',', ' ');
				$pdf->SetXY( $x, 233 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				
				$col_ttc = $col_ht + $col_tva;
				$nombre_format_francais = number_format($col_ttc, 2, ',', ' ');
				$pdf->SetXY( $x, 239 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				
				$tot_tva += $col_tva ; $tot_ttc += $col_ttc;
				
				$x += 17;
			}
			mysqli_free_result($res);

			$nombre_format_francais = "Net à payer TTC : " . number_format($tot_ttc, 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','B',12); $pdf->SetXY( 5, 213 ); $pdf->Cell( 90, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 239 ); $pdf->Cell( 24, 6, number_format($tot_ttc, 2, ',', ' '), 0, 0, 'R');
			// TVA
			$nombre_format_francais = "Total TVA : " . number_format($tot_tva, 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','',10); $pdf->SetXY( 158, 213 ); $pdf->Cell( 47, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 233 ); $pdf->Cell( 24, 6, number_format($tot_tva, 2, ',', ' '), 0, 0, 'R');
		}

		// **************************
		// pied de page
		// **************************
		$pdf->SetLineWidth(0.1); $pdf->Rect(5, 260, 200, 6, "D");
		$pdf->SetXY( 1, 260 ); $pdf->SetFont('Arial','',7);
		$pdf->Cell( $pdf->GetPageWidth(), 7, "Clause de réserve de propriété (loi 80.335 du 12 mai 1980) : Les marchandises vendues demeurent notre propriété jusqu'au paiement intégral de celles-ci.", 0, 0, 'C');
		
		$y1 = 270;
		//Positionnement en bas et tout centrer
		$pdf->SetXY( 1, $y1 ); $pdf->SetFont('Arial','B',10);
		$pdf->Cell( $pdf->GetPageWidth(), 5, "REF BANCAIRE : FR76 xxx - BIC : xxxx", 0, 0, 'C');
		
		$pdf->SetFont('Arial','',10);
		
		$pdf->SetXY( 1, $y1 + 4 ); 
		$pdf->Cell( $pdf->GetPageWidth(), 5, "NOM SOCIETE", 0, 0, 'C');
		
		$pdf->SetXY( 1, $y1 + 8 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, "ADRESSE 1 + CP + VILLE", 0, 0, 'C');

		$pdf->SetXY( 1, $y1 + 12 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, "Tel + Mail + SIRET", 0, 0, 'C');

		$pdf->SetXY( 1, $y1 + 16 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, "Adresse web", 0, 0, 'C');
		
		// par page de 18 lignes
		$num_page++; $limit_inf += 18; $limit_sup += 18; 
	}
	
	$pdf->Output("I", $nom_file);
?>
