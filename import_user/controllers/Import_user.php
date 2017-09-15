<?php 
/**
 * 
 */
 class Import_user extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Import_user_model');
		$this->load->library('sessionchecker');

 	}

 	public function index()
 	{
 		echo("okokkokoo");
 	}
 	//view halaman import siswa
 	public function f_import_siswa()
 	{	
		$data['judul_halaman'] = "Form Import Siswa";
		$data['files'] = array(
			APPPATH . 'modules/Import_user/views/v-form_Import_siswa.php',
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

 	 public function f_import_guru()
 	{	
		$data['judul_halaman'] = "Form Import Guru";
		$data['files'] = array(
			APPPATH . 'modules/Import_user/views/v-form_Import_guru.php',
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
 	public function get_cabang()
 	{
 		$arr_cabang=$this->Import_user_model->select_cabang();
 		echo json_encode($arr_cabang);

 	}
 	public function upload_xlsx()
 	{
 		$config['upload_path'] = './assets/excel';
 		$config['allowed_types'] = 'xlsx';
 		$config['max_size'] = 9000;
 		$dat_excel="dat_excel";
 		$config['encrypt_name'] = TRUE;
 		$new_name = time().$_FILES[$dat_excel]['name'];
 		$config['file_name'] = $new_name;
 		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
  		// pengecekan upload
 		if (!$this->upload->do_upload($dat_excel)) {
			$nama_file="gagal";
 		} else {
 			 $file_data = $this->upload->data();
 			 $url_file =$file_data['file_name'];
 			$nama_file=$_FILES[$dat_excel]['name'];
 			$data["nama_file"]=$nama_file;
 			$data["url_file"]=$url_file;
 			$this->Import_user_model->in_file_excel($data);

 			$datExcel["nama_file"]=$nama_file;
 			$datExcel["url_file"]=$url_file;
 			$datExcel["status_upload"]=true;
 		}

 		echo json_encode($datExcel);
 	}
 	public function set_siswa_batch()
 	{
 		$post=$this->input->post();
 		$datArr=$post["datImport"];
 		$cabangID=$post["cabangID"];
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		$fake_uuid=12;
 		$dat_siswa=array();
 		foreach ($datArr as $key ) {
 			$parse_tgl=strtotime($key['tgl_lahir']);
 			$tgl=date("d",$parse_tgl);
 			$tgl_lahir=date("Y-m-d",$parse_tgl);
 			//data pengguna
 			$uuid=uniqid();
 			$kataSandi=$key["noIndukNeutron"].$tgl;
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key["noIndukNeutron"],
 				'kataSandi'=>md5($kataSandi),
 				'eMail'=> $key["eMail"],
 				'hakAkses'=>'siswa',
 				'uuid_user'=>$uuid);
 			$dat_siswa_excel[]=array(
 				'namaDepan'=>$key['namaDepan'],
 				'namaBelakang'=>$key['namaBelakang'],
 				'tgl_lahir' => $tgl_lahir,
 				'alamat'=>$key['alamat'],
 				'namaSekolah'=>$key['namaSekolah'],
 				'alamatSekolah'=>$key['alamatSekolah'],
 				'noKontakSekolah'=>$key['noKontakSekolah'],
				'noIndukNeutron'=>$key['noIndukNeutron'],
				'cabangID' => $cabangID,
				'tingkatID' => $key["tingkatID"],
 				);
 			$uuid_arr[]=array(
 				'uuid_user'=>$uuid);
 		}
 		// simpan data pengguna
 		$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 		//get id pengguna yg baru di insert
 		 $dat_pengguna_ID=$this->Import_user_model->myselect_batch($uuid_arr);
 		 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 		 //merge array dat_siswa_excel dengan array dat_pengguna_ID
 		 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 		 	$dat_siswa[]=array_merge_recursive($dat_siswa_excel[$i],$dat_pengguna_ID[$i]);
 		 }

 		// simpan data Siswa
 		$this->Import_user_model->myinsert_batch($dat_siswa,"tb_siswa");
 		echo json_encode("Data siswa berhasil di tambahkan");
 	}

 	public function set_guru_batch()
 	{
 		$post=$this->input->post();
 		$datArr=$post["datImport"];
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		$dat_siswa=array();
 		foreach ($datArr as $key ) {
 			$parse_tgl=strtotime($key['tgl_lahir']);
 			$tgl=date("d",$parse_tgl);
 			$tgl_lahir=date("Y-m-d",$parse_tgl);
 			//data pengguna
 			$uuid=uniqid();
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key['namaDepan'],
 				'kataSandi'=>md5($key['namaDepan']),
 				'eMail'=> $key["eMail"],
 				'hakAkses'=>'guru',
 				'uuid_user'=>$uuid);

 			$dat_guru_excel[]=array(
 				'namaDepan'=>$key['namaDepan'],
 				'namaBelakang'=>$key['namaBelakang'],
 				'alamat' => $key['alamat'],
 				'tgl_lahir' => $tgl_lahir,
 				'noKontak' => $key['noKontak'],
 				'biografi' => $key['biografi'],
 				
 				);
 			$uuid_arr[]=array(
 				'uuid_user'=>$uuid);
 		}
 		// simpan data pengguna
 		$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 		//get id pengguna yg baru di insert
 		 $dat_pengguna_ID=$this->Import_user_model->myselect_batch($uuid_arr);
 		 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 		 //merge array dat_siswa_excel dengan array dat_pengguna_ID
 		 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 		 	$dat_guru[]=array_merge_recursive($dat_guru_excel[$i],$dat_pengguna_ID[$i]);
 		 }

 		// simpan data Siswa
 		$this->Import_user_model->myinsert_batch($dat_guru,"tb_guru");
 		echo json_encode("Data guru berhasil di tambahkan");
 	}


 	public function unlink_xlsx()
 	{
 		$url_file=$this->input->post("url_file");
 		  unlink(FCPATH . "assets/excel/" . $url_file);
 		$config_del['mytable']="tb_bup_import_excel";
 		$config_del['key_condition']="url_file";
 		$config_del['val_condition']=$url_file;
 		$this->Import_user_model->del_one_record($config_del);
 	}

 	public function rollback_import()
 	{
 		$data['judul_halaman'] = "Rollback Import";
		$data['files'] = array(
			APPPATH . 'modules/Import_user/views/v-rollback_import.php',
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

 	public function validasi_rollback()
 	{	
 		$date=date("d");
 		$post=$this->input->post();
 		$penggunaID=$this->session->userdata['id'];
 		$post_kodevalidasi=md5($post["kode_validasi"]).$date;
 		$kode_validasi=$this->Import_user_model->get_katasandi($penggunaID)[0]->kataSandi.$date;
 		if ($post_kodevalidasi==$kode_validasi) {
 			$count_row=$this->Import_user_model->count_row_pengguna($post);
 			if ($count_row==0) {
 				$dat_retrun["msg"]="false2";

 			} else {
	 			$dat_retrun["msg"]="true";
	 			$x=$this->Import_user_model->del_import($post);
 			}
 		} else {
 			$dat_retrun["msg"]="false1";
 		}
 		echo json_encode($dat_retrun);
 	}

 } ?>