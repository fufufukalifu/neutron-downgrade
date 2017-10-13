<?php



defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );


class Welcome extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model( 'matapelajaran/mmatapelajaran' );
        $this->load->model( 'tingkat/MTingkat' );
        $this->load->model( 'siswa/msiswa' );
        $this->load->model( 'ortuback/Ortuback_model' );
        $this->load->model( 'ortu/mortu' );
        $this->load->library( 'parser' );
        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
        if($this->session->userdata('HAKAKSES')=='guru' || 
           $this->session->userdata('HAKAKSES')=='admin'){
            redirect($this->session->userdata('HAKAKSES'));
    }
    }


    public function index() {

        $data = array(
            'judul_halaman' => 'Neon - Welcome',
            'judul_header' =>'Video',
            'judul_header2' =>'Video Belajar'
            );

        $data['files'] = array( 
            APPPATH.'modules/homepage/views/v-header-login.php',
            APPPATH.'modules/welcome/views/v-container-graph.php',
            APPPATH.'modules/testimoni/views/v-footer.php',
            );
        $hakAkses=$this->session->userdata('HAKAKSES');
        if ($hakAkses=='ortu') {
            $id_pengguna= $this->session->userdata['id'];
            $namaDepan=$this->mortu->get_siswa($id_pengguna)[0]['namaDepan'];
            $namaBelakang=$this->mortu->get_siswa($id_pengguna)[0]['namaBelakang'];
            $data['siswa'] =$namaDepan.' '. $namaBelakang ;
        // ini buat ortu

            $data['count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);
            $data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);
        }else if($hakAkses=='siswa'){
            $data['latihan'] = $this->msiswa->get_limit_persentase_latihan(3);
            $data['pesan'] = $this->msiswa->get_pesan();

            $this->parser->parse( 'templating/index', $data );
        }else if($hakAkses=='admin_cabang'){
            redirect("admincabang");
        }else if($hakAkses=='admin'){
            redirect("admin");
        }if($hakAkses=='guru'){
            redirect("guru/dashboardelse ");
        }




    }


    public function faq(){
       $data = array(
        'judul_halaman' => 'Neon - FAQ',
        'judul_header' =>'FAQ HASIL DETECTION',
        'judul_header2' =>'Video Belajar'
        );

       $data['files'] = array( 
        APPPATH.'modules/homepage/views/v-header-login.php',
        APPPATH.'modules/welcome/views/v-faq.php',
        APPPATH.'modules/testimoni/views/v-footer.php',
        );
       $this->parser->parse( 'templating/index', $data );
   }

## get data latihan persentase buat di datatable.
   public function get_data_latihan(){
    $list = $this->msiswa->get_limit_persentase_latihan(10);
    $data = array();
    $n=1;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ( $list as $item ) {
        $row = array();

        $row[] = $n;
        $row[] = $item['judulBab'];
        $row[] = $item['total_soal'];
        $row[] = $item['total_benar'];
        $row[] = $item['total_salah'];
        $row[] = $item['total_kosong'];
        $row[] = (int)$item['total_benar'] / (int)$item['total_soal'] * 100;
        $persentasi = (int)$item['total_benar'] / (int)$item['total_soal'] * 100;   
        $row[] = "<span class='skill-bar' title=".$item['judulBab']." ".$persentasi."> <span class='bar'><span class='bg-color-4 skill-bar-progress' processed='true' style='width: ".$persentasi."%;'></span></span></span>";
        $persentasi;





        $data[] = $row;
        $n++;

    }

    $output = array(
        "data"=>$data,
        );
    echo json_encode( $output );

}
## learning line persentase datatable.
public function get_data_learning_line(){
    $list = $this->msiswa->persentasi_limit(10);
    $data = array();
    $n=1;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ( $list as $item ) {
        $row = array();

        $row[] = $n;
        $row[] = $item['namaTopik'];
        $row[] = $item['stepDone'];
        $row[] = $item['jumlah_step'];
        $persentasi = (int)$item['stepDone'] / (int)$item['jumlah_step'] * 100;   
        $row[] = (int)$persentasi;
        $row[] = "<span class='skill-bar' title=".$item['namaTopik']." ".$persentasi."> <span class='bar'><span class='bg-color-4 skill-bar-progress' processed='true' style='width: ".$persentasi."%;'></span></span></span>";

        $data[] = $row;
        $n++;

    }

    $output = array(
        "data"=>$data,
        );
    echo json_encode( $output );




}

}
