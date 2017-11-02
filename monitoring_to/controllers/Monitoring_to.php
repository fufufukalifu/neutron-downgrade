<?php 
/**
 * 
 */
 class Monitoring_to extends MX_Controller
 {
 	
  function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Monitoring_to_model');
		$this->load->model('toback/Mtoback');
		$this->load->library('sessionchecker');

 	}
 	public function index($value='')
 	{
 		$data['judul_halaman'] = "List Siswa TO";
		$data['files'] = array(
			APPPATH . 'modules/monitoring_to/views/v-monitoring_to.php',
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
 	public function ajax_siswa_to()
 	{
 		$post=$this->input->post();
 		$type_return="record";
 		$status_pengerjaan=$post["status_pengerjaan"];
 		$arr_siswa=$this->Monitoring_to_model->get_siswa_to($post,$type_return);
 		if ($status_pengerjaan==0) {
 			$status_pengerjaan = '<h2 class="text text-center text-danger"><i class="ico-exclamation-sign" title="belum mengerjakan"></i></h2>';
 		} else {
 			$status_pengerjaan = '<h2 class="text text-center text-success"><i class="ico-ok-sign" title="sudah mengerjakan"></i></h2>';
 		}
 		$tb_monitring=null;
 		$no = $post["page"] +1;
 		foreach ($arr_siswa as $key) {
 			$tb_monitring.='<tr>
 				<td>'.$no.'</td>
 				<td>'.$key->noIndukNeutron.'</td>
 				<td>'.$key->namaDepan.'</td>
 				<td>'.$key->aliasTingkat.'</td>
 				<td>'.$key->nama_kurikulum.'</td>
 				<td>'.$key->namaCabang.'</td>
 				<td>'.$key->nm_tryout.'</td>
 				<td>'.$key->nm_paket.'</td>
 				<td>'.$status_pengerjaan.'</td>

 			</tr>';
 			$no++;
 		}
 		echo json_encode($tb_monitring);
 	}

 	public function op_tingkat()
 	{
 		$tingkat_arr=$this->Mtoback->get_tingkat();
 		$option='<option value="all">All</option>';
 		foreach ($tingkat_arr as $key ) {
 			$option.='<option value="'.$key->id.'">'.$key->aliasTingkat.'</option>';
 		}
 		echo json_encode($option);
 	}
 		//option kurikulum untuk filter siswa di add bundle paket
 	public function op_kurikulum()
 	{
 		$kurikulum_arr=$this->Mtoback->get_kurikulum();
 		$option='<option value="all">All</option>';
 		foreach ($kurikulum_arr as $key ) {
 			$option.='<option value="'.$key->id.'">'.$key->nama_kurikulum.'</option>';
 		}
 		echo json_encode($option);
 	}
 	public function op_cabang(){
 		$kurikulum_arr=$this->Monitoring_to_model->get_cabang_by_siswa_to();
 		$option='<option value="all">All</option>';
 		foreach ($kurikulum_arr as $key ) {
 			$option.='<option value="'.$key->id_cabang.'">'.$key->namaCabang.'</option>';
 		}
 		echo json_encode($option);
 	}
 	public function op_tryout(){
 		$post=$this->input->post();
 		$kurikulum_arr=$this->Monitoring_to_model->get_tryout_by_cabang($post);
 		$option='<option value="all">All</option>';
 		foreach ($kurikulum_arr as $key ) {
 			$option.='<option value="'.$key->id_tryout.'">'.$key->nm_tryout.'</option>';
 		}
 		echo json_encode($option);
 	}
 	public function op_paket(){
 		$id_tryout=$this->input->post("tryout");
 		$kurikulum_arr=$this->Monitoring_to_model->get_pakekt_by_to($id_tryout);
 		$option='<option value="all">All</option>';
 		foreach ($kurikulum_arr as $key ) {
 			$option.='<option value="'.$key->id_paket.'">'.$key->nm_paket.'</option>';
 		}
 		echo json_encode($option);
 	}

 	public function sum_page_monitoring(){
 		$post=$this->input->post();
 		$type_return="sum";
 		$per_page= $post["per_page"];
 		$sum_record=$this->Monitoring_to_model->get_siswa_to($post,$type_return);
 		$sum_page =ceil($sum_record/$per_page);
 		
 		echo json_encode($sum_page);
 	}
 	//get info pengerjaan to
 	//info jumlah siswa yg sudah atau belum mengerjakan tryout di suatu cabang
 	public function info_pengerjaan()
 	{
 		$post=$this->input->post();
 		$post["kurikulum"]="all";
 		$post["tingkat"]="all";
 		$post["paket"]="all";
 		$post["keysearch"]=null;

 		$id_tryout=$post["tryout"];
 		$arr_paket=$this->Monitoring_to_model->get_paket_to($id_tryout);

 		$info=null;
 		$no=0;
 		foreach ($arr_paket as $key) {
 		$no++;
 		//status pengerjaan = 1 = siswa yg sudah mengerjakan
 		$post["status_pengerjaan"]=1;
 		//untuk ememilih jenis retrun
 		// sum =  me retrun jumlah record
 		$type_return="sum";
 		//menmpung jumlah siswa yg mengikuti tryout
 		$sum_sdh_mengerjakan=$this->Monitoring_to_model->get_siswa_to($post,$type_return);
 		// ubah status pegerjaan jadi 0
 		$post["status_pengerjaan"]=0;
 		//menmpung jumlah siswa yg belum mengerjakan tryout
 		$sum_blm_mengerjakan=$this->Monitoring_to_model->get_siswa_to($post,$type_return);
 		$sum_siswa_to=$sum_sdh_mengerjakan+$sum_blm_mengerjakan;
 		$info.='<tr>
 			<td>'.$no.'</td>
 			<td>'.$key->nm_paket.'</td>
 			<td>'.$sum_siswa_to.'</td>
 			<td>'.$sum_sdh_mengerjakan.'</td>
 			<td>'.$sum_blm_mengerjakan.'</td>
 		</tr>
 		';
 		}

 		echo json_encode($info);
 	}
 } ?>