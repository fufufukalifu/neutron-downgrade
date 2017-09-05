<?php 
/**
 * 
 */
 class Help extends MX_Controller
 {
 	
 	function __construct()
 	{
 				parent::__construct();
		$this->load->library('parser');
		$this->load->model('help_model');
 	}

 	public function index($value='')
 	{
		$data['judul_halaman'] = "Help";
		$data['files'] = array(
			APPPATH . 'modules/help/views/v-user_guide.php',
			);
		
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			$this->parser->parse('templating/index-b-guru', $data);
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
 	}
 	//get list  pdf user guide
 	public function get_list_user_guide($value='')
 	{
 		$data=$this->help_model->sc_user_guide();
 		$tamHeader='
 		<div class="mb15">
 		<div class="section-header section-header-bordered mb10">';
		$tampFooter='</ul>
				</div>';
				$datArr=array();
 		$tAdmin=$tamHeader.'<h4 class="section-title">
							<p class="font-alt nm">User Guide Admin </p>
						</h4>
					</div>
					<ul class="list-unstyled" >';
 		$tAdminCabang=$tamHeader.'<h4 class="section-title">
							<p class="font-alt nm">User Guide Admincabang </p>
						</h4>
					</div>
					<ul class="list-unstyled" >';
 		$tGuru=$tamHeader.'<h4 class="section-title">
							<p class="font-alt nm">User Guide Guru</p>
						</h4>
					</div>
					<ul class="list-unstyled" >';
 		$tSiswa=$tamHeader.'<h4 class="section-title">
							<p class="font-alt nm">User Guide Siswa</p>
						</h4>
					</div>
					<ul class="list-unstyled" >';
 		foreach ($data as $key ) {
 			$status_user_guide=$key->status_user_guide;
 			$listTutor='<li class="mb5"> <i class="ico-angle-right text-muted mr5"></i> <a href="javascript:void(0);" onClick="get_pdf_ug('.$key->id.')">'.$key->url_pdf.'</a></li>';
 			if ($status_user_guide==1) {
 				$tAdmin.=$listTutor;
 			} elseif($status_user_guide==2) {
 				$tAdminCabang.=$listTutor;
 			}elseif($status_user_guide==3) {
 				$tGuru.=$listTutor;
 			}elseif($status_user_guide==4) {
 				$tSiswa.=$listTutor;
 			}
 			
 		}
 		$tAdmin.=$tampFooter;
 		$tAdminCabang.=$tampFooter;
 		$tGuru.=$tampFooter;
 		$tSiswa.=$tampFooter;
 		$hakAkses = $this->session->userdata['HAKAKSES'];
 		if ($hakAkses =='admin') {
 			$dat=$tAdmin."<hr>".$tAdminCabang."<hr>".$tGuru."<hr>".$tSiswa;
 		} else if($hakAkses =='guru') {
 			$dat=$tGuru."<hr>".$tSiswa;
 		}
 		
 		
 		echo json_encode($dat);
 	}
 	public function get_pdf_user_guide()
 	{
 		$id=$this->input->post('id');
 		$data=$this->help_model->select_user_guide($id);
 		$url_pdf=$data[0]->url_pdf;
 		echo json_encode($url_pdf);
 	}
 } ?>