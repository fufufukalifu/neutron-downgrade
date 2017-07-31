<?php
class Logtryout extends MX_Controller {


	function __construct(){
		$this->load->library('parser');
		$this->load->model('logtryout_model');
        date_default_timezone_set('Asia/Jakarta');

	}

	function ajax_status_to($cabang="all",$tryout="all",$paket="all"){

		$data['param'] = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$list = $this->logtryout_model->get_log_tryout($data['param']);

		$data = array();
		foreach ( $list as $list_item ) {
			$row = array();
			$row[]=$list_item['id'];
			$row[]=$list_item['namaPengguna'];

			$row[]=$list_item['namaDepan'].' '.$list_item['namaBelakang'];
			$row[]=$list_item['waktu_mulai'];
			$waktu_mulai = date('Y-m-d H:i:s',strtotime($list_item['waktu_mulai']));

			$date_mulai =  new DateTime($waktu_mulai);

			$waktu_minggat = $date_mulai->modify('+'.$list_item['durasi'].' minutes');

			// var_dump($waktu_minggat);
			// echo "<br>";

			$sekarang = new DateTime('now');
			// var_dump($sekarang);
			
			$row[]=$list_item['nm_tryout'];
			$row[]=$list_item['nm_paket'];


			if ($list_item['status_pengerjaan']=="") {
				if ($sekarang>=$waktu_minggat) {
					$row[]="<i class='ico-paper-plane text-danger' title='meninggalkan'></i>";
				}else{
					$row[]="<i class='ico-pencil3 text-primary' title='sedang mengerjakan'></i>";
				}
			} else {
				// jika waktu mulai + durasinya >= sekarang
				// artikan dia sebagai minggat
				$row[]="<i class='ico-checkmark3 text-success' title='selesai mengerjakan'></i>";
				
			}
			
			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);
		echo json_encode( $output );
	}
}
?>