<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
 class Admincabangback extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Admincabang_back_model');
		$this->load->model('cabang/mcabang');
		$this->load->model('guru/mguru');
		$this->load->library('sessionchecker');


 	}

 	public function index()
 	{
 		$this->list_admincabang();
 	}

 	public function tambah_admincabang($value='')
 	{
 		# get cabang
		$arrCabang = $this->Admincabang_back_model->get_cabang();
		// var_dump($arrCabang);
		$optionCabang='';
		foreach ($arrCabang as $value) {
			$optionCabang.='<option value="'.$value->id.'">'.$value->namaCabang.'</option>';
		}
		$data['cabang']=$optionCabang;
		$data['judul_halaman'] = "Form Admin Cabang";
		$data['files'] = array(
			APPPATH . 'modules/admincabangback/views/v-form_admin_cabang.php',
			);
		
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
 	}

 	public function list_admincabang($value='')
 	{
 		$data['judul_halaman'] = "Form Admin Cabang";
		$data['files'] = array(
			APPPATH . 'modules/admincabangback/views/v-list_admincabang.php',
			);
		
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
 	}

 	public function add_admincabang($value='')
 	{
 		$namaPengguna=$this->input->post("username");
 		$dataP["namaPengguna"]=$namaPengguna;
 		$dataP["kataSandi"]=md5($this->input->post("password"));
 		$dataP["eMail"]=$this->input->post("email");
 		$dataP["hakAkses"]="admin_cabang";
 		//insert pengguna kemudian meretrun idpengguna
 		$this->Admincabang_back_model->in_pengguna($dataP);
 		$id_pengguna=$this->Admincabang_back_model->get_idPengguna($namaPengguna);
 		$data["id_cabang"]=$this->input->post("cabang");
 		$data["id_pengguna"]=$id_pengguna;
 		// add relasi pengguna dengan cabang
 		$this->Admincabang_back_model->in_pengguna_cabang($data);

 	
 	}

 	public function ajax_list_admincabang($records_per_page='10',$pageSelek='0',$keySearch='')
 	{
 		$records_per_page=$this->input->post("records_per_page");
 		$pageSelek=$this->input->post("pageSelek");
 		$keySearch=$this->input->post("keySearch");
 		$arrAdminCabang=$this->Admincabang_back_model->get_admincabang($records_per_page,$pageSelek,$keySearch);
 		$tb_admincabang=null;
 		$no=$pageSelek+1;
 		foreach ($arrAdminCabang as $value ) {
 			// parameter untuk di lempar ke fungsi di js
 			$namaPengguna="'".$value->namaPengguna."'";
 			$tb_admincabang.='
 												<tr>
 														<td>'.$no.'</td>
 														<td>'.$value->namaPengguna.'</td>
 														<td>'.$value->eMail.'</td>
 														<td>'.$value->namaCabang.'</td>
 														<td>'.$value->tgldaftar.'</td>
 														<td>

 																<a class="btn btn-sm btn-warning" onclick="editAdminCabang('.$value->idCabang.')" title="Edit"><i class="ico-pencil3"></i></a>
 																<a class="btn btn-sm btn-danger" title="Rest Katasandi"  onclick="restKatasandi('.$value->id.','.$namaPengguna.')"><i class="ico-key2"></i></a>
 																	<a class="btn btn-sm btn-danger" title="Hapus admin cabang" onclick="hapusAkun('.$value->id.','.$value->idCabang.')"><i class="ico-close3"></i></a>
 														</td>
 												</tr>
 			';
 			$no++;
 		}
 		echo json_encode($tb_admincabang);
 	}

 	public function pagination_admincabang($records_per_page='10',$pageSelek='0',$keySearch='')
 	{
 		$records_per_page=$this->input->post("records_per_page");
 		$pageSelek=$this->input->post("pageSelek");
 		$keySearch=$this->input->post("keySearch");
 		$jumlah_data=$this->Admincabang_back_model->sum_admincabang($pageSelek,$keySearch);

 		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';
    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);
    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		$pagination.='<li ><a href="javascript:void(0)" onclick="selectPage('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPage('.$i.')" >'.$pagePagination.'</a></li>';
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
    	 // cek jika halaman pagination hanya satu set pagination menjadi null
    	 if ($sumPagination<=1) {
    	 		$pagination='';
    	 }

 		echo json_encode($pagination);
 	}

 	public function del_admincabang($id_pengguna='')
 	{
 		$id_pengguna=$this->input->post("id_pengguna");
 		$idCabang=$this->input->post("idCabang");
 		// data admincabang tidakbenar-benar dihapus tetapi satus di ubah dari 1 menjadi 0
 		$this->Admincabang_back_model->ch_status_admincabang($id_pengguna);
 		$this->Admincabang_back_model->ch_status_idPengguna_cabang($idCabang);
 		echo json_encode($idCabang);
 	}

 	// reset katasandi admincabang
   // reset sandi penggunaID 
public function reset_katasandid_admincabang()
{
  $id_pengguna=$this->input->post('id_pengguna');
  $namaPengguna=$this->input->post('namaPengguna');
  $date=date("d");
  $newPassword=$namaPengguna.$date;
    //m5 katasandi
  $md5Sandi=md5($newPassword);
  $this->mguru->ch_password($md5Sandi,$id_pengguna);
    // return kata sandi baru
  echo json_encode($newPassword);
}

// pengecekan namaPengguna harus uniq
public function cek_namaPengguna()
{
	//load library n helper
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->form_validation->set_rules('username', 'Nama Pengguna', 'trim|required|is_unique[tb_pengguna.namaPengguna]');
	
	if($this->form_validation->run() == FALSE) {
		 echo json_encode("false");
	}else{
		echo json_encode("true");
	}
}

// pengecekan email harus uniq
public function cek_email()
{
	//load library n helper
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tb_pengguna.email]');
	
	if($this->form_validation->run() == FALSE) {
		 echo json_encode("false");
	}else{
		echo json_encode("true");
	}
}

 } ?>