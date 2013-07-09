<?php

/**
 * class PDF_SPIP extends PDF : 
 */
 
 
class PDF_SPIP extends PDF
{



// haut, gauche,  bas, droite
function SetAllMargins($TopMargin, $LeftMargin, $BottomMargin, $RightMargin)
{
	// gauche, haut, droite
	$this->SetMargins(6,10,6);
	
	// bas
	$this->SetAutoPageBreak(auto, $BottomMargin*3/2);
}

/* /// Entête de page du document /// */
function Header()
{
	global $titre ;
    
    if (file_exists($logo_site))
    {
        $this->Image($logo_site,0,2,210);
    }
	$this->Image(find_in_path('images/flash_header_pdf.jpg'),0,2,210);
	$this->SetFont('helvetica','B',11);
	$this->SetTextColor(108,69,134);
	$this->Cell(0,8,$titre,0,0,'R');
	$this->Ln(50);

}

/* /// Pied de page du document /// */
function Footer()
{
	global $conf_nom_site , $conf_url_site  ;
	
	$this->SetY(-$this->bMargin/2);		
	
	//Police helvetica 8	
	$this->SetFont('helvetica','',8);
	$this->SetTextColor(0,0,0);

	// Copyright
	$this->SetFillColor(204,204,204);
	$this->Cell(0,6,"Copyright ECTA".$conf_nom_site ,0,0,'L',1,$conf_url_site );
	
	//Numéro de page
	$this->SetX($this->w-$this->rMargin*2-5);
	$this ->Cell(0,6,'Page '.$this->PageNo().'/{nb}', 0, 1, 'C');
}

/*function GenerateTitlePage()
{
	global $site, $rubrique, $yahoo, $surtitre, $titre, $soustitre;
	global $logo_site,  $logo_fichier, $logo_lien;
  global $auteur, $descriptif;
	global $copyright;
	global $conf_url_site;
	global $DateParution,$DateMiseEnLigne;
	
	
	// En-tête
	if (file_exists($logo_site))
	{
		$this->Image($logo_site,$this->rMargin+3,$this->tMargin+2,20,20);
	}
	
	$this->SetFont('times','',12);
	$this->SetXY($this->rMargin+25,$this->tMargin+6);
	
	
	$this->SetXY($this->rMargin+25,$this->tMargin+14);
	$this->PutLink($conf_url_site,$conf_url_site);
	
	
	Surtitre (type du document)
	$this->unhtmlentities($surtitre);
	$this->SetXY(20,92);
	$this->SetFont('courier','B',14);
	$this->MultiCell(170,6,$surtitre,0,'C',0);
	
	
	Titre centré
	$this->SetXY(20,100);
	$this->SetFont('helvetica','B',32);
	$this->unhtmlentities($titre);
	$this->MultiCell(170,20,$titre,0,'C',0);
	
	
	// Rubriques
	$this->Ln(2);
	$this->SetFont('helvetica','',8);
	$this->MultiCell(0,5,$titre,0,'C',0);
	
	// Logo

	if ($logo_fichier!="") {
	$x = $this->GetX();
	$y = $this->GetY();
		$this->SetLink($link);
//		$this->Image($logo_fichier,50,170,'','','','','0');
//		$this->Image($logo_fichier,50-($w/2),170,50,50,'','','0');
		$this->Image($logo_fichier,50-($w/2),170,'','','',$logo_lien,'0');
		$this->SetXY($xi, $yi);
    	}


	//Dates
	$this->SetFont('helvetica','',10);
	
	if ($DateMiseEnLigne) 
	{
		$this->SetXY(85,134);
		$DateMiseEnLigne = $this->unhtmlentities($DateMiseEnLigne);
		$this->MultiCell(0,0,"$DateMiseEnLigne",0,'L',0);
	}
	
	if ($DateParution) 
	{
		$this->SetXY(110,190);
		$DateParution = $this->unhtmlentities($DateParution);
		$this->MultiCell(0,6,"$DateParution",0,'L',0);
	}
	

	// Descriptif 	
	if ($descriptif)
	{
		
		$this->SetFont('helvetica','B',10) ;
		$this->SetXY($this->rMargin+5,220);
		$this->SetFont('helvetica', 'BU', 10);
		$this->Write(5, 'Description :');
		$this->Ln();
		$this->SetFont('times', '', 8);
		$this->WriteHTML($descriptif,5) ;
	}
	
	if ($copyright)
	{
		$this->SetXY(45,250);
		$this->SetFont('times', 'B', 10);
		$this->MultiCell(120,8,$copyright,'TB','C',0);
	}
}*/

function GenerateText()
{
 	global $chapo, $chapoTitle, $texte1, $texte2, $texte3, $texte4, $ps, $notes, $title1, $title2, $title3, $title4 ;
		
	$this->SetFont('helvetica');
	$this->SetTextColor(0,0,0);
	
	// Titre Chapeau
	if ($chapoTitle)
	{
		$this->SetFont('helvetica','B',18);
		$this->SetTextColor(255,255,255);
		$this->SetFillColor(88,115,31);
		$this->Cell(0,8,$chapoTitle,0,0,'L',1); 

		//$this->WriteHTML($chapoTitle,5);
	}
	// Chapeau
	if ($chapo)
	{
		$this->SetFont('helvetica','',10);
		$this->SetTextColor(0,0,0);
		$this->WriteHTML($chapo,5);
		$this->SetFillColor(88,115,31);
		$this->Ln(5);
	}
	
	//title1
	if ($title1) 
	{
		$this->SetFont('helvetica','B',18);
		$this->SetTextColor(255,255,255);
		$this->SetFillColor(88,115,31);
		$this->Cell(0,8,$title1,0,0,'L',1); 
		$this->Ln(4);
	}
	//Texte1
	$this->SetFont('helvetica','',10);
	$this->SetTextColor(0,0,0);
	$this->WriteHTML($texte1,5);
	$this->Ln(12);
	//title2
	if ($title2) 
	{
		$this->SetFont('helvetica','B',18);
		$this->SetTextColor(255,255,255);
		$this->SetFillColor(88,115,31);
		$this->Cell(0,8,$title2,0,0,'L',1); 
		$this->Ln(4);
	}
	//Texte2
	$this->SetFont('helvetica','',10);
	$this->SetTextColor(0,0,0);
	$this->WriteHTML($texte2,5);
	$this->Ln(12);
	//title3
	if ($title3) 
	{
		$this->SetFont('helvetica','B',18);
		$this->SetTextColor(255,255,255);
		$this->SetFillColor(88,115,31);
		$this->Cell(0,8,$title3,0,0,'L',1); 
		$this->Ln(4);
	}
	//Texte3
	$this->SetFont('helvetica','',10);
	$this->SetTextColor(0,0,0);
	$this->WriteHTML($texte3,5);
	$this->Ln(12);
	//title4
	if ($title4) 
	{
		$this->SetFont('helvetica','B',18);
		$this->SetTextColor(255,255,255);
		$this->SetFillColor(88,115,31);
		$this->Cell(0,8,$title4,0,0,'L',1); 
		$this->Ln(4);
	}
	//Texte4
	$this->SetFont('helvetica','',10);
	$this->SetTextColor(0,0,0);
	$this->WriteHTML($texte4,5);
	$this->Ln(12);
	
	//ps
	if ($ps) 
	{
		$this->SetFont('','I',8);
		$this->WriteHTML("Post-scriptum : ",4);
		$this->WriteHTML($ps,4);
		$this->Ln(8);
	}
	//notes
	if ($notes) {
		$this->SetFont('','',8);
		$this->WriteHTML($notes,3);
		$this->Ln();
	}
}

function BuildDocument()
{
	$this->AddPage();
	//$this->GenerateTitlePage();
	$this->GenerateText();	
	
	// On repasse en police à la bonne taille pour le nombre de pages.
	$this->SetFont('helvetica','I',8);
	$this->AliasNbPages();
}

function SetCopyright($copyright)
{
    $this->copyright=$copyright;
}
}

?>
