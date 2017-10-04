<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanortu extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Laporanortu_model');
		$this->load->model('cabang/mcabang');
		$this->load->model('admincabang/admincabang_model');
		$this->load->model('tingkat/Mtingkat');
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
		if ($this->hakakses=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		}else{
			echo "forbidden access";    		
		}
	}
	// LOAD PARSER SESUAI HAK AKSES

	public function index()
	{
		$data['judul_halaman'] = "Laporan Orang Tua";
		
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$id_pengguna=$this->session->userdata["id"];
			$idcabang = $this->admincabang_model->get_idCabang_adminCabang($id_pengguna)[0]['id_cabang'];
			$data['cabang'] = 
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-daftar-laporan-cabang.php',
				);
			$this->parser->parse('admincabang/v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-daftar-laporan.php',
				);
			$this->loadparser($data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
		
	}

	//laporan ortu ajax
	public function laporanortu_ajax($cabang="all",$tingkat="all",$kelas="all",$jenis="all"){
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();

		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$datas = ['cabang'=>$cabang,'tingkat'=>$tingkat,'kelas'=>$kelas,'jenis'=>$jenis];

		$all_report = $this->Laporanortu_model->get_report_ortu_all($datas);

		$data = array();
		$n=1;
		foreach ( $all_report as $item ) {
		
			$row = array();
			$row[] = $n;
			$row[] = $item ['namaOrangTua'];
			$row[] = $item ['namaDepan']." ".$item ['namaBelakang'];
			$row[] = $item ['namaPengguna'];
			$row[] = $item ['isi'];
			// $row[] = "<textarea name='isi' class='pesan' style='width:300px; height:200px;'></textarea>";
			// $row[] = '<a href="' . base_url('index.php/siswa/reportSiswa/' .$item['siswaID'] .'/'. $item['penggunaID']) . '""> Lihat detail</a></i>';
			// $row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
			// <input type='checkbox' name="."report".$n." id="."soal".$item['id_ortu']." value=".$item['id_ortu'].">
			// <label for="."soal".$item['id_ortu'].">&nbsp;&nbsp;</label></span>";
			
			$data[] = $row;
			$n++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	// function get kelas
	public function get_kelas( $tingkat ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Laporanortu_model->get_kelas( $tingkat ) ) );
	}

	// FUNGSI INSERT LAPORAN
	function kirim_laporan(){
		if ($this->input->post()) {
			$post = $this->input->post();

			$jumlah_laporan = $post['jumlah_ortu'];
			$id=$post['id_ortu'];
			$jenis=$post['jenis_lapor'];
			$isi=$post['isi'];
			$UUID=uniqid();

			for ($i=0; $i < $jumlah_laporan; $i++) { 
				//masukan ke array data laporannya
				$token_update = array("id_ortu"=>$id[$i],
										"jenis"=>$jenis,
										"isi"=>$post['isi'][$i],
										"UUID"=>$UUID
					);
				
				// insert laporan
				$this->Laporanortu_model->insert_laporan($token_update);
			}

			// //get data komen by UUID
          $datArr=$this->Laporanortu_model->get_laporan_by_id($UUID);

          $dataLaporan['id_ortu']=$datArr[0]['id_ortu'];
          $dataLaporan['siswaID']=$datArr[0]['siswaID'];
          $dataLaporan['jenis_lapor']=$datArr[0]['jenis'];
          $dataLaporan['isi']=$datArr[0]['isi'];
          $dataLaporan['namaPengguna']=$datArr[0]['namaPengguna'];
          $dataLaporan['UUID']=$datArr[0]['UUID'];
          $idortu= $datArr[0]['id_ortu'];
          $dataKomen['new_count_pesan'] = $this->db->where("read_status_ortu = 0 and id_ortu =$idortu" )->count_all_results('tb_laporan_ortu');
          $dataLaporan['success']=true;

          echo json_encode($dataLaporan);

		}
	}

	// fungsi add laporan
	public function addlaporan()
	{
		$data['judul_halaman'] = "Laporan Orang Tua";
		
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-add-laporan-cabang.php',
				);
			$this->parser->parse('admincabang/v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-add-laporan.php',
				);
			$this->loadparser($data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
		
	}

	//laporan ortu ajax
	public function addlaporanortu_ajax($cabang="all",$tingkat="all",$kelas="all",$records_per_page=10,$page=0){
		//data post
		$records_per_page=$this->input->post('records_per_page');
		$page=$this->input->post('page');
		$cabang=$this->input->post('cabang');
		$tryout=$this->input->post('tingkat');
		$paket=$this->input->post('kel');
		$keySearch=$this->input->post('keySearch');
		//data post

		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();

		if ($keySearch != '' && $keySearch !=' ' ) {
			$datas = ['cabang'=>$cabang,'tingkat'=>$tingkat,'kelas'=>$kelas];
			$all_report = $this->Laporanortu_model->get_report_ortu($datas,$records_per_page,$page);
			// $all_report = $this->admincabang_model->cari_report_paket($datas,$records_per_page,$page,$keySearch);
		} else {
			$datas = ['cabang'=>$cabang,'tingkat'=>$tingkat,'kelas'=>$kelas];
			$all_report = $this->Laporanortu_model->get_report_ortu($datas,$records_per_page,$page);
		}

		$data = array();
		$tb_report=null;
		$no=$page+1;

		if($all_report){
			foreach ( $all_report as $item ) {
				$tb_report.=	'<tr>
				<td>'.$no.'</td>	
				<td>'.$item ['namaOrangTua'].'</td>
				<td>'.$item ['namaDepan']." ".$item ['namaBelakang'].'</td>
				<td>'.$item ['namaPengguna'].'</td>
				<td><textarea name="isi" class="pesan" style="width:300px; height:200px;"></textarea></td>
				<td><span class="checkbox custom-checkbox custom-checkbox-inverse">
					<input type="checkbox" name='."report".$n.' id='."report".$item['id_ortu'].' value='.$item['id_ortu'].'>
					<label for='."report".$item['id_ortu'].'>&nbsp;&nbsp;</label></span></td>
				
			</tr>';
			$no++;
			}
		}else{
			$tb_report=	"<tr><td colspan=11>Tidak Ada Data</td></tr>";
		}

		// <td><a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_report('."'".$item['id_report']."'".')"><i class="ico-remove"></i></a></td>

		echo json_encode( $tb_report );
	}

	// function get kelas
	public function set_cabang( $tingkat ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Laporanortu_model->get_nc( $tingkat ) ) );
	}

	// function get cabang
	public function get_cabang() {
	  $data = $this->output
	  ->set_content_type( "application/json" )
	  ->set_output( json_encode( $this->Laporanortu_model->get_cabang() ) ) ;
	}

	public function pagination_daftar_all_report($cabang="all",$tryout="all",$paket="all",$records_per_page=100,$page=0,$keySearch='')
	{
		//data post
		// $records_per_page=$this->input->post('records_per_page');
		// $page=$this->input->post('page');
		//data post
		# get cabang
	$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
	$data['to'] = $this->mtoback->get_To();
	$cabang=$this->input->post('cabang');
	$tryout=$this->input->post('tryout');
	$paket=$this->input->post('paket');
	$keySearch=$this->input->post('keySearch');
	$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
	if ($keySearch != '' && $keySearch !=' ' ) {
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$jumlah_data = $this->admincabang_model->jumlah_cari_report_paket($datas,$keySearch);
	} else {
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$jumlah_data = $this->admincabang_model->jumlah_report_paket($datas);
	}


	$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
				</a></li>';

	$pagePagination=1;

	$sumPagination=($jumlah_data/$records_per_page);

	for ($i=0; $i < $sumPagination; $i++) { 
		if ($pagePagination<=7) {
			$pagination.='<li ><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
		}else{
			$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" >'.$pagePagination.'</a></li>';
		}

		$pagePagination++;
	}

	if ($pagePagination>7) {
		$pagination.='<li class="" id="page-next">
		<a href="javascript:void(0)" onclick="nextPage()" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a>
	</li>';
	}

	if ($pagePagination<3) {
		$pagination='';
	}


	echo json_encode($pagination);
	}

}

?>