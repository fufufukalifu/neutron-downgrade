<?php



// extend TCPF with custom functions
class TOKENPDF extends TCPDF {

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
	public function ColoredTable($header,$data) {
		$w = array(10, 27, 25, 48, 25, 20,30);
		   $this->DrawHeader($header, $w);
		$fill = 0;
		$no=1;
		foreach($data as $row) {
			//Get current number of pages.
		$num_pages = $this->getNumPages();
      	$this->startTransaction();
			$this->Cell($w[0], 6, $no, 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ($row['namaCabang']), 'LR', 0, 'LR', $fill);
			$this->Cell($w[2], 6, ($row['noIndukNeutron']), 'LR', 0, 'C', $fill);
			$this->Cell($w[3], 6, ($row['namaDepan']), 'LR', 0, 'C', $fill);
			$this->Cell($w[4], 6, ($row['tgl_lahir']), 'LR', 0, 'C', $fill);
			$this->Cell($w[5], 6, ($row['aliasTingkat']), 'LR', 0, 'C', $fill);
			$this->Cell($w[6], 6, ($row['nomorToken']), 'LR', 0, 'C', $fill);
			$this->Ln();
			 //If old number of pages is less than the new number of pages,
            //we hit an automatic page break, and need to rollback.
			//repeat header
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
				$this->Cell($w[0], 6, $no, 'LR', 0, 'L', $fill);
				$this->Cell($w[1], 6, ($row['namaCabang']), 'LR', 0, 'LR', $fill);
				$this->Cell($w[2], 6, ($row['noIndukNeutron']), 'LR', 0, 'C', $fill);
				$this->Cell($w[3], 6, ($row['namaDepan']), 'LR', 0, 'C', $fill);
				$this->Cell($w[4], 6, ($row['tgl_lahir']), 'LR', 0, 'C', $fill);
				$this->Cell($w[5], 6, ($row['aliasTingkat']), 'LR', 0, 'C', $fill);
				$this->Cell($w[6], 6, ($row['nomorToken']), 'LR', 0, 'C', $fill);
				$this->Ln();
			}
			else
			{
                //Otherwise we are fine with this row, discard undo history.
				$this->commitTransaction();
			}
			//
			$fill=!$fill;
			$no++;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new TOKENPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin Neon');
$pdf->SetTitle('List_Token');
$pdf->SetSubject('Permohonan Token');
$pdf->SetKeywords('TCPDF, PDF, a, test, guide');


//test
$cabang="bali1";
// set default header data
$img=base_url().'/assets/back/img/logo.png';
$pdf->SetHeaderData('logo.png', '10%', "LIST TOKEN TAMBAH SISWA KE-2 (29 Sep)",PDF_HEADER_STRING);

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

// column titles
$header = array('No','Cabang','NIS CBT',' 
	Nama','Tanggal Lahir','Tingkat','Token');

// vardump
// var_dump($data_token);

// data loading
// judul tabel
$nameTbl='<h1>Token Siswa</h1>
<p style="color:red;">*Untuk nama pengguna menggunakan NIS CBT dan untuk katasandi menggunakan tanggal lahir siswa.</p>
<p>Contoh: nama pengguna: 31-466-001, katasandi : 2017-09-21 </p><br>
			';
$pdf->writeHTML($nameTbl,false, false, false, false, '');
// print colored table
$pdf->ColoredTable($header, $data_token);

// close and output PDF document
$pdf->Output('Token_Siswa_29_Sep.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
