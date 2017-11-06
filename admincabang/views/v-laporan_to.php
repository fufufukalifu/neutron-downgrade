<?php



// extend TCPF with custom functions
class MYPDF extends TCPDF {

	public $no_cbt_max = 'kosong';
	// Load table data from file
	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data;
	}

	public function DrawHeader($header, $w) {
        // Colors, line width and bold font
        // Header
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');        
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
        // Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
    }

	// Colored table
	public function ColoredTable($header,$all_report,$dat_paket,$w) {
		   $this->DrawHeader($header, $w);
		$fill = 0;
		// var_dump($data[1]["nilai_1"]);
		foreach($all_report as $row) {
			
			//Get current number of pages.
			$num_pages = $this->getNumPages();
      $this->startTransaction();
			$this->Cell($w[0], 6, $row['no'], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ($row['no_cbt']), 'LR', 0, 'LR', $fill);
			$this->Cell($w[2], 6, ($row['nama']), 'LR', 0, 'LR', $fill);
			//looping jumlah paket
			$i=0;
			$index_cell=3;
			foreach ($dat_paket as $key_paket) {
				$i++;
				$index_nilai='nilai_'.$i;
				$tamp_nilai=isset($row[$index_nilai]);
				if ( $tamp_nilai == false) {
					$nilai="";
				} else {
					$nilai=round($row[$index_nilai],2);
				}
				$this->Cell($w[$index_cell], 6, ($nilai), 'LR', 0, 'LR', $fill);
				$index_cell++;
				
			}

			$this->Cell($w[$index_cell], 6, ($row['avg']), 'LR', 0, 'LR', $fill);
			$this->Ln();
			//If old number of pages is less than the new number of pages,
      //we hit an automatic page break, and need to rollback.
			//repeat header
			$avg_max=0;
			$sum_avg=0;
			if($num_pages < $this->getNumPages())
			{
        //Undo adding the row.
				$this->rollbackTransaction(true);
      	//Adds a bottom line onto the current page. 
      	//Note: May cause page break itself.
				// $this->Cell(array_sum($w), 0, '', 'T');
      	//Add a new page.
				$this->AddPage();
      	//Draw the header.
				$this->DrawHeader($header, $w);
      	//Re-do the row.
				$this->Cell($w[0], 6, $row['no'], 'LR', 0, 'L', $fill);
				$this->Cell($w[1], 6, ($row['no_cbt']), 'LR', 0, 'LR', $fill);
				$this->Cell($w[2], 6, ($row['nama']), 'LR', 0, 'LR', $fill);
				$i=0;
				$index_cell=3;
				$sum_nilai=0;
				foreach ($dat_paket as $key_paket) {
					$i++;
					$index_nilai='nilai_'.$i;
					$tamp_nilai=isset($row[$index_nilai]);
					if ( $tamp_nilai == false) {
						$nilai="";
					} else {
						$nilai=round($row[$index_nilai],2);
					}
					$this->Cell($w[$index_cell], 6, ($nilai), 'LR', 0, 'LR', $fill);
					$index_cell++;
				}
					$this->Cell($w[$index_cell], 6, ($row['avg']), 'LR', 0, 'LR', $fill);
					
					$this->Ln();
			}
			else
			{
        //Otherwise we are fine with this row, discard undo history.
				$this->commitTransaction();
			}
			//
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Laporan_TO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, a, test, guide');

// set default header data
$img=base_url().'/assets/back/img/logo.png';
$pdf->SetHeaderData('logo.png', '10%', PDF_HEADER_TITLE." Cabang ".$cabang,PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();
###########Setting header tabel############
// column titles
$dat_header="";
$header = array('No','No CBT','Nama Siswa');
//setting width header
$w = array(10,25, 65);
//looping jumlah header untuk nilai paket
//strt index dari 3
$strt_index=3;
//start name paket
$index_paket=1;
$keterangan="<br><h4>Keterangan :</h4><ul>";
foreach ($dat_paket as $key_paket) {
	//setting header untuk nilai paket
	$name_paket="Paket ".$index_paket;
	$header[$strt_index]=$name_paket;
	$strt_index++;
	$index_paket++;
	//info untuk keterangan paket
	$keterangan.='<li>'.$name_paket.' : '.$key_paket["nm_paket"].'</li>';
	//setting width header paket
}
$w_paket=60/$index_paket;
for ($z=1; $z <$index_paket ; $z++) { 
	$w[$z+2]=15;
}
//setting header rata
$header[$strt_index]="Rata-rata";
//setting width untuk rata2
$w[$strt_index]=20;
$keterangan.="</ul>";

###########Setting header tabel############
// pengantar
// $pengantar="<p> Pada tanggal xxx telah dilakasanakan tryout, yang terdiri dari beberapa paket yaitu : ,.. Dari pelaksanaan tryout menghasilkan  </p>";
// $pdf->writeHTML($pengantar,false, false, false, false, '');
//judul tabel
$nameTbl='<h1>Hasil '.$nm_tryout.' </h1> <br>';
$pdf->writeHTML($nameTbl,false, false, false, false, '');
// print colored table
$pdf->ColoredTable($header, $all_report,$dat_paket,$w);
// --------------------------------------------------------
$pdf->writeHTML($keterangan,  true, false, true, false, '');
//kesimpulan
$kesimpulan="<br><h3>Siswa dengan nilai terbaik :</h3>";
// $kesimpulan.="<ul>
// 						<li>No CBT :".$no_cbt_max." </li>
// 						<li>Nama : ".$nama_max."</li>
// 						<li>Rata-rata nilai :".$avg_max." </li>
// </ul>";
$kesimpulan .= '
<table border="0" style="width:50%;">
	 <tr>
	    <th align="left" style="background-color:#FAF6F6;"><b>- No CBT</b></th>
	    <td width="5%" style="background-color:#FAF6F6;">:</td>
	    <td align="left" style="background-color:#FAF6F6;">'.$no_cbt_max.'</td>
	 </tr>
	  <tr >
	    <th align="left"style="background-color:#E3F2F9;"><b>- Nama</b></th>
	   <td width="5%" style="background-color: #E3F2F9;">:</td>
	    <td align="left" style="background-color: #E3F2F9;">'.$nama_max.'</td>
	 </tr>
	  <tr >
	    <th align="left" style="background-color:#FAF6F6;"><b>- Nilai rata-rata</b></th>
	    <td width="5%" style="background-color:#FAF6F6;">:</td>
	    <td align="left" style="background-color:#FAF6F6;">'.$avg_max.'</td>
	 </tr>
 </table> '
 ;
 $kesimpulan .= '<p>dari '.$sum_siswa.' siswa yang mengikuti tryout dengan nilai rata-rata '.$avg_to.'.<p/>';
$pdf->writeHTML($kesimpulan,  true, false, true, false, '');
// close and output PDF document
$pdf->Output('Laporan_TO.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
