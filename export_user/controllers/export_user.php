<?php 
/**
 * 
 */
 class Export_user extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Export_user_model');
		$this->load->library('sessionchecker');

 	}

 	public function index()
 	{
 		echo("okokkokoo");
 	}
 	public function f_export_siswa()
 	{	
		$data['judul_halaman'] = "Form Export Siswa";
		$data['files'] = array(
			APPPATH . 'modules/export_user/views/v-form_export_siswa.php',
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
 	public function set_siswa_batch()
 	{
 		$datArr=$this->input->post("datArr");
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		foreach ($datArr as $key ) {
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key["namaPengguna"],
 				'kataSandi'=>$key["kataSandi"] ,
 				'eMail'=> $key["eMail"],
 				'hakAkses'=>'guru');
 			$tamp_dat_siswa[]=array(
 				'namaDepan'=>$key['namaDepan'],
 				'namaBelakang'=>$key['namaBelakang'],
 				'alamat'=>$key['alamat'],
 				'namaSekolah'=>$key['namaSekolah'],
 				'alamatSekolah'=>$key['alamatSekolah'],
 				'noKontakSekolah'=>$key['noKontakSekolah'],
				'noIndukNeutron'=>$key['noIndukNeutron'],
 				);
 		}
 			$this->Export_user_model->ib_siswa($dat_pengguna);
 		echo json_encode("berhasil masuk ke controller");
 	}

 	public function set_pengguna_batch()
 	{
 		# code...
 	}
 	public function set_ortu_batch()
 	{
 		# code...
 	}
 } ?>