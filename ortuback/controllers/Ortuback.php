<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ortuback extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Ortuback_model');
		$this->load->model('Laporanortu/Laporanortu_model');
		$this->load->model('admincabang/admincabang_model');
		$this->load->model('tingkat/Mtingkat');
		$this->load->model('siswa/msiswa');
		$this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();

		$this->hakakses = $this->gethakakses();
	}

	//GET HAK AKSES
	function gethakakses(){
		return $this->session->userdata('HAKAKSES');
	}
	//GET HAK AKSES

	// LOAD PARSER SESUAI HAK AKSES
	public function loadparser($data){
		$this->hakakses = $this->gethakakses();
		if ($this->hakakses=='ortu') {
			$this->parser->parse('templating/index', $data);
		}elseif ($this->hakakses=='siswa'){
			$this->parser->parse('templating/index', $data); 		
		}else {
			echo "forbidden access";   
		}
	}
	// LOAD PARSER SESUAI HAK AKSES

	//laporan ortu ajax
	public function index(){
		$id = $this->session->userdata('id'); 
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME');  
        } 
		$namadepan = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaDepan'];
		$namabelakang = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaBelakang'];
			
		$data['judul_halaman'] = "Laporan $namadepan $namabelakang";

		$hakAkses = $this->session->userdata['HAKAKSES'];
		$data = array(
        'judul_halaman' => 'Neon - Daftar Latihan',
        'judul_header' => 'History Pesan',
        'judul_tingkat' => '',
        );

		$data['files'] = array(
			APPPATH.'modules/homepage/views/v-header-login.php',
			APPPATH . 'modules/templating/views/t-f-pagetitle.php',
			APPPATH . 'modules/ortuback/views/v-daftar-report.php',
			APPPATH.'modules/testimoni/views/v-footer.php',
		);
		
		// get report berdasarkan nilai
		$report_nilai = $this->Ortuback_model->get_report_nilai($id_pengguna);

		// get report berdasarkan absen
		$report_absen = $this->Ortuback_model->get_report_absen($id_pengguna);

		// get report berdasarkan umum
		$report_umum = $this->Ortuback_model->get_report_umum($id_pengguna);

		$data['namaortu'] = $report_nilai[0]['namaOrangTua'];

		$n=1;

		// untuk nampung report nilai
		$data['nilai']=array(); 
		foreach ( $report_nilai as $item ) {
		
			$data['nilai'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report absen
		$data['absen']=array(); 
		foreach ( $report_absen as $item ) {
		
			$data['absen'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report umum
		$data['umum']=array(); 
		foreach ( $report_umum as $item ) {
		
			$data['umum'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id);
		$data['count_pesan'] = $this->Ortuback_model->get_count($id);

		$this->loadparser($data);

	}

	// FUNGSI UNTUK VIEW PESAN ORTU DAN SISWA
	public function pesan($UUID="")
	{
		$id = $this->session->userdata('id'); 
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');
            // update status read menjadi 1
			$this->Ortuback_model->update_read($UUID);  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME'); 
            // update status read menjadi 1
            $this->msiswa->update_read_siswa($UUID);
 
        } 
		$namadepan = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaDepan'];
		$namabelakang = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaBelakang'];
			
		$data['judul_halaman'] = "Laporan $namadepan $namabelakang";

		$hakAkses = $this->session->userdata['HAKAKSES'];
		$data = array(
        'judul_halaman' => 'Neon - Daftar Latihan',
        'judul_header' => 'History Pesan',
        'judul_tingkat' => '',
        );

		$data['files'] = array(
			APPPATH.'modules/homepage/views/v-header-login.php',
			APPPATH . 'modules/templating/views/t-f-pagetitle.php',
			APPPATH . 'modules/ortuback/views/v-daftar-report.php',
			APPPATH.'modules/testimoni/views/v-footer.php',
		);
		
		// get report berdasarkan nilai
		$report_nilai = $this->Ortuback_model->get_report_nilai($id_pengguna);

		// get report berdasarkan absen
		$report_absen = $this->Ortuback_model->get_report_absen($id_pengguna);

		// get report berdasarkan umum
		$report_umum = $this->Ortuback_model->get_report_umum($id_pengguna);

		// cek reportnya null atau tidak?
		if ($report_nilai!='') {
			$data['namaortu'] = $report_nilai[0]['namaOrangTua'];

			$n=1;
			// untuk nampung report nilai
			$data['nilai']=array(); 
			foreach ( $report_nilai as $item ) {
			
				$data['nilai'][]=array(
	                'namaortu'=>$item['namaOrangTua'],
	                'jenis'=>$item['jenis'],
	                'isi'=>$item['isi'],
	               );
			}

			// untuk nampung report absen
			$data['absen']=array(); 
			foreach ( $report_absen as $item ) {
			
				$data['absen'][]=array(
	                'namaortu'=>$item['namaOrangTua'],
	                'jenis'=>$item['jenis'],
	                'isi'=>$item['isi'],
	               );
			}

			// untuk nampung report umum
			$data['umum']=array(); 
			foreach ( $report_umum as $item ) {
			
				$data['umum'][]=array(
	                'namaortu'=>$item['namaOrangTua'],
	                'jenis'=>$item['jenis'],
	                'isi'=>$item['isi'],
	               );
			}
		} else {}

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id);
		$data['count_pesan'] = $this->Ortuback_model->get_count($id);

		$this->loadparser($data);
	}

	//laporan ortu ajax
	public function report_ajax($jenis="all"){

		$datas = ['jenis'=>$jenis];
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME');  
        } 
		$all_report = $this->Ortuback_model->get_report_all($datas,$id_pengguna);

		$data = array();
		$n=1;
		foreach ( $all_report as $item ) {
		
			$row = array();
			$row[] = $n;
			$row[] = $item ['jenis'];
			$row[] = $item ['isi'];

			$data[] = $row;
			$n++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	public function ajax_ortuID()
{
  $guruID=$this->session->userdata['id'];
  $arrMapel=$this->Ortuback_model->get_Ortu($guruID);
  echo json_encode($arrMapel);
}

	// get jumlah pesan untuk pesan
	function jumlah_pesan($id){
		$data['new_count_pesan'] = $this->Ortuback_model->get_count($id);

	  echo json_encode($data['new_count_pesan']);
	}


	public function see_message($id)
	{
		$data['judul_halaman'] = "Pesan Orang Tua";

		$hakAkses = $this->session->userdata['HAKAKSES'];

		$id_pengguna= $this->session->userdata['id'];

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);

			$data['files'] = array(
				APPPATH . 'modules/ortuback/views/v-single-pesan.php',
				);
			$all_report = $this->Ortuback_model->get_pesan_by_id($id);

			// update status read menjadi 1
			$this->Ortuback_model->update_read($id);

			$data['new_count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);

		$n=1;
		$data['pesan']=array(); 
		foreach ( $all_report as $item ) {
		
			$data['pesan'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'isi'=>$item['isi']
               );
		}

			$this->loadparser($data);
		
	}


	// kelola ortu back
	public function list_ortu()
	{
		$data['judul_halaman'] = "List Orang Tua Siswa dan Siswa";

		$hakAkses = $this->session->userdata['HAKAKSES'];
				$data['files'] = array(
		APPPATH . 'modules/ortuback/views/v-list-ortu.php',
			);
		$this->parser->parse('admin/v-index-admin', $data);
	}
	//get siswa yg belum ada akun orangtua
	public function ajax_siswa_not_ortu($records_per_page='10',$pageSelek='0',$keySearch='')
	{	
		$records_per_page=$this->input->post("records_per_page_siswa");
		$pageSelek=$this->input->post("pageSelek_siswa");
		$keySearch=$this->input->post("keySearch_siswa");
		$datArr=$this->Ortuback_model->get_siswa_not_ortu($records_per_page,$pageSelek,$keySearch);
		$tb_siswa=null;
		$n=1;
		$no=$pageSelek+1;
		foreach ($datArr as $value) {
			$nama=$value->namaDepan." ".$value->namaBelakang;
			if ($value->namaCabang=="") {
				$namaCabang="non-neutron";
			} else {
				$namaCabang=$value->namaCabang;
			}
			 $tb_siswa.='<tr>
			 	 <td><span class="checkbox custom-checkbox custom-checkbox-inverse">
								<input type="checkbox" name='.'token'.$n.' id='.'soal'.$value->idSiswa.' value='.$value->idSiswa.'>
								<label for='.'soal'.$value->idSiswa.'>&nbsp;&nbsp;</label></span>
						</td>
						<td>'.$no.'</td>
						<td>'.$value->namaPengguna.'</td>
						<td>'.$nama.'</td>
						<td>'.$value->email.'</td>
						<td>'.$namaCabang.'</td>
			 </tr>
			 ';
			$n++;
    	$no++;
		}
		echo json_encode($tb_siswa);
	}

		public function ajax_ortu($records_per_page='10',$pageSelek='0',$keySearch='')
	{	
		$records_per_page=$this->input->post("records_per_page_ortu");
		$pageSelek=$this->input->post("pageSelek_ortu");
		$keySearch=$this->input->post("keySearch_ortu");
		$datArr=$this->Ortuback_model->get_ortu_siswa($records_per_page,$pageSelek,$keySearch);
		$tb_ortu=null;
		$n=1;
		$no=$pageSelek+1;
		foreach ($datArr as $value) {
			$nama=$value->namaDepan." ".$value->namaBelakang;
			$param_reset_pswd_ortu=$value->id_np_ortu.",'".$value->np_ortu."'";
		 	  // <td><span class="checkbox custom-checkbox custom-checkbox-inverse">
				// 			<input type="checkbox" name='.'token'.$n.' id='.'soal'.$value->idSiswa.' value='.$value->idSiswa.'>
				// 			<label for='.'soal'.$value->idSiswa.'>&nbsp;&nbsp;</label></span>
				// 	</td>
			 $tb_ortu.='<tr>
						<td>'.$no.'</td>
						<td>'.$value->np_ortu.'</td>
						<td> Orang Tua '.$nama.'</td>
						<td>'.$value->np_siswa.'</td>
						<td>'.$nama.'</td>
						<td>
							<button class="btn btn-sm btn-danger" onclick="reset_pswd_ortu('.$param_reset_pswd_ortu.')"><i class="ico-key2"></i></button>
							<button class="btn btn-sm btn-danger" onclick="del_ortu('.$param_reset_pswd_ortu.')"><i class="ico-close3"></i></button>
						</td>
			 </tr>
			 ';
			$n++;
    	$no++;
		}
		echo json_encode($tb_ortu);
	}

	public function pagination_siswa_not_ortu($records_per_page='10',$pageSelek='0',$keySearch='')
	{
     	$keySearch=$this->input->post("keySearch_siswa");
     	$jumlah_data = $this->Ortuback_model->jumlah_siswa_not_ortu($keySearch);
	
    	$pagination='<li class="hide" id="page-prev-siswa"><a href="javascript:void(0)" onclick="prevPageSiswa()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';
    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);
    	
    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		    	 	$pagination.='<li ><a href="javascript:void(0)" onclick="selectPageSiswa('.$i.')" id="pageSiswa-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		    	 	$pagination.='<li class="hide" id="pageSiswa-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPageSiswa('.$i.')" >'.$pagePagination.'</a></li>';
    	 	}

    	 	$pagePagination++;
    	 }
    	 if ($pagePagination>7) {
    	 	  $pagination.='<li class="" id="page-next-siswa">
		      								<a href="javascript:void(0)" onclick="nextPageSiswa()" aria-label="Next">
		        								<span aria-hidden="true">&raquo;</span>
		      								</a>
		    								</li>';
    	 }
    	     	 // cek jika halaman pagination hanya satu set pagination menjadi null
    	 if ($sumPagination<=1) {
    	 		$pagination='';
    	 		# code...
    	 }
    	 echo json_encode ($pagination);
	}

		public function pagination_ortu($records_per_page='10',$pageSelek='0',$keySearch='')
	{
				$records_per_page=$this->input->post("records_per_page_ortu");
		$keySearch=$this->input->post("keySearch_ortu");
			 $jumlah_data = $this->Ortuback_model->jumlah_ortu_siswa($keySearch);
	
    	 $pagination='<li class="hide" id="page-prev-ortu"><a href="javascript:void(0)" onclick="prevPageOrtu()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';
    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);
    	
    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		    	 	$pagination.='<li ><a href="javascript:void(0)" onclick="selectPageOrtu('.$i.')" id="pageOrtu-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		    	 	$pagination.='<li class="hide" id="pageOrtu-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPageOrtu('.$i.')" >'.$pagePagination.'</a></li>';
    	 	}

    	 	$pagePagination++;
    	 }
    	 if ($pagePagination>7) {
    	 	  $pagination.='<li class="" id="page-next-Ortu">
		      								<a href="javascript:void(0)" onclick="nextPageOrtu()" aria-label="Next">
		        								<span aria-hidden="true">&raquo;</span>
		      								</a>
		    								</li>';
    	 }
    	     	 // cek jika halaman pagination hanya satu set pagination menjadi null
    	 if ($sumPagination<=1) {
    	 		$pagination='';
    	 		# code...
    	 }
    	 echo json_encode ($pagination);	

	}

	public function set_ortu()
	{
		// $datArrOrtu=array();
		
		if ($this->input->post() ) {
			$arrIdSiswa=$this->input->post("id_siswa");
				$siswa=$this->Ortuback_model->get_siswa_batch($arrIdSiswa);

			// }
			$pengguna_ortu=array();
			foreach ($siswa as $value) {
				$pengguna[]=array(
					"namaPengguna"=>"P-".$value->namaPengguna,
					"kataSandi"=>$value->kataSandi,
					"hakakses"=>"ortu",
					"aktivasi"=>"1",
					"status"=>"1",
					"keterangan"=>$value->siswaID
					);
			}
			$this->Ortuback_model->in_pengguna_ortu($pengguna);


			//get id pengguna ortu berdasarkan id_siswa
			$arrPengguna_ortu=$this->Ortuback_model->get_penggunaOrtu($arrIdSiswa);
			foreach ($arrPengguna_ortu as $val) {
				$ortu[]=array(
					"namaOrangTua"=>$val->namaPengguna,
					"siswaID"=>$val->id_siswa,
					"penggunaID"=>$val->id
					);
			}
			$this->Ortuback_model->in_data_ortu($ortu);
			echo json_encode($ortu);
		} else {
			echo json_encode("Data Kosong atau NULL");
		}
		
		
			
	}

	public function reset_kataSandi_ortu(){
		$id_pengguna=$this->input->post("id");
		$namaPengguna=$this->input->post("namaPengguna");
		// katasandi baru
		$date=date("d");
		$new_pswd=md5($namaPengguna.$date);
		$this->Ortuback_model->up_kataSandi_ortu($id_pengguna,$new_pswd);
		echo json_encode($namaPengguna.$date);
		
	}
	public function del_pengguna_ortu(){
		$id_pengguna=$this->input->post("id");
		$this->Ortuback_model->up_status_ortu($id_pengguna);
		echo json_encode($id_pengguna);

	}
}

?>