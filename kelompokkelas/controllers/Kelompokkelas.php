<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Kelompokkelas extends MX_Controller {
	private $hakakses;
	function __construct(){
		$this->load->library('parser');
		$this->load->model('kelompokkelas_model');
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

	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Cabang",
			);

		$data['files'] = array(
			APPPATH . 'modules/cabang/views/v-daftar-cabang.php',
			);
		// var_dump($data['dataToken']);
		$this->loadparser($data);
	}

	function ajax_data($data){
		$list = $this->kelompokkelas_model->get_kelompok_kelas_byid_cabang($data);
		$data = array();
		$no=1;
		foreach ( $list as $item ) {
			$row = array();
			$row[] = $no;
			$row[] = $item->KelompokKelas;

			$row[] =  
			'<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_kelas('."'".$item->id_kk."'".')"><i class="ico-remove"></i></a>'.
			' <a class="btn btn-sm btn-warning kelas-'.$item->id_kk.'"  title="Edit Kelas" data-id='."'".json_encode($item)."'".'  onclick="edit_kelas('."'".$item->id_kk."'".')"><i class="ico-pencil5"></i></a>';
			$data[] = $row;
			$no++;
		}

		$output = array(
			"data"=>$data,
			);
		echo json_encode( $output );
	}

	function insert_kelompokkelas_ajax(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$data = array("kelompokKelas"=>$post['kk'],"cabangID"=>$post['cabang']);
			$this->kelompokkelas_model->insert_kk($data);
		}
	}

	function drop_cabang(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$this->mcabang->drop_cabang($post);
		}
	}

	function update_cabang_ajax(){
		if ($this->input->post()) {
		$post = $this->input->post();
		$data = array("id"=>$post['id'],
			"namaCabang"=>$post['kota'],
			"alamat"=>$post['alamat'],
			"kodeCabang"=>$post['kodecabang']);
		$this->mcabang->update_cabang($data);
		}
	}

	// hapus data kelas
	// status kelas di-update menjadi 0
	function del_kelompok_kelas(){
		$id_kk=$this->input->post('id');
		$this->kelompokkelas_model->up_status($id_kk);
	}

	function update_kelompok_kelas(){
		$post=$this->input->post();
		$id_kk=$post['id_kk'];
		$kk=$post['kk'];
		$this->kelompokkelas_model->ch_kelompokKelas($id_kk,$kk);
		
	}
}
?>