<?php

/**
 *
 */
class Videoback extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('session');
        $this->load->model('Mvideoback');
        $this->load->library('table');
        $this->load->model('video/mvideos');
        $this->load->model('guru/mguru');
        $this->load->model('templating/mtemplating');
         $this->load->library('parser');
    }

    # Mengambil video berdasarkan id guru
    function get_video_manager() {
        $guru_id = $this->session->userdata['id_guru'];
        $data['videos_uploaded'] = $this->load->mvideos->get_video_by_teacher($guru_id);
        //untuk mengambil data guru
        //untuk menghitung berapa banyak video yang sudah diupload
        $data['jumlah_video'] = count($this->load->mvideos->get_video_by_teacher($guru_id));
        return $data;
    }
    ##

    # ajax mengambil video by id guru
    function ajax_get_video_by_id_guru(){
        $guru_id = $this->session->userdata['id_guru'];
        $data['videos_uploaded'] = $this->load->mvideos->get_all_video_by_teacher($guru_id);
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        //var_dump($list);
        //mengambil nilai list
        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();

            // $row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
            //                     <input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
            //                     <label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
            //                 </span>";
            if ($list_video['published']=='1') {
              $publish='Publish';
            }else{
              $publish='No Publish';
            }
            $row[] = $list_video['videoID'];
            $row[] = $list_video['judulVideo'];
            $row[] = $list_video['namaFile'];
            $row[] = $list_video['matapelajaran'];
            $row[] = $list_video['judulBab'];
            $row[] = $list_video['judulSubBab'];
            $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
            $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
            $row[] =  $publish;
           $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';

            $data[] = $row;
            $n++;

        }

        $output = array(
            "data"=>$data,
        );
        echo json_encode( $output );
    }

    public function index() {
        $this->load->view('templating/t-footer-back');
        $this->load->view('templating/t-header');
        $this->load->view('guru/v-left-bar');
        $this->load->view('v-upload-video-form');
    }

    //menampilkan view form upload
    public function formupvideo() {


        $data['judul_halaman'] = "upload Video";
        $data['files'] = array(
            APPPATH . 'modules/videoback/views/v-upload-video-form.php',
        );
        

        $hakAkses=$this->session->userdata['HAKAKSES'];
        // cek hakakses 
        if ($hakAkses=='admin') {
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
            // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }
    }

     //menampilkan view form upload
    public function formUpdateVideo($UUID) {
         $data['video']=$this->Mvideoback->get_video_by_UUID($UUID)[0];
         $subBabID=$data['video']['subBabID'];
          $data['infovideo']=$this->Mvideoback->get_info_video($subBabID);
        $data['judul_halaman'] = "update Video";
        $data['files'] = array(
            APPPATH . 'modules/videoback/views/v-update-video-form.php',
        );
        

        $hakAkses=$this->session->userdata['HAKAKSES'];
        // cek hakakses 
        if ($hakAkses=='admin') {
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
            // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }

            // jika guru untul sentara yg guru bisa di tembak URL untuk testing
         
    
    }

    public function managervideo() {
        // $data['paket_soal'] = $this->load->MPaketsoal->getpaketsoal();
        $data['judul_halaman'] = "My Video";
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-container-video.php',
        );


        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{

            redirect(site_url('login'));
        }

    }

    // fungsi untuk upload video
    public function upvideo($data) {

        $config['upload_path'] = './assets/video';
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = 90000;
        $this->load->library('upload', $config);
             // pengecekan upload
        if (!$this->upload->do_upload('video')) {
                // jika upload video gagal
            $error = array('error' => $this->upload->display_errors());

        } else {
                // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
            $file_data = $this->upload->data();
            $video = $file_data['file_name'];


            $penggunaID = $this->session->userdata['id'];
            $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
            $guruID = $data['tb_guru']['id'];
            $UUID=uniqid();
                //data yg akan di masukan ke tabel video
            $data_video = array(
                'judulVideo' => $data['judulVideo'] ,
                'namaFile' => $video,
                'deskripsi' => $data['deskripsi'],
                'published' => $data['published'],
                'guruID' => $guruID,
                'subBabID' => $data['subBabID'],
                'UUID' => $UUID,
                'jenis_video' => $data['jenis_video']
                );

            $this->Mvideoback->insertVideo($data_video);
        }
    }
       

    public function cek_option_upload()
     {
          //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');



        //set role
        $this->form_validation->set_rules('judulvideo', 'Judul Video', 'required');
        $this->form_validation->set_rules('subBab', 'Subbab', 'required');
         // $this->form_validation->set_rules('video', 'Video', 'required');

        //pesan error atau pesan kesalahan pengisian form upload video
        $this->form_validation->set_message('required', '*Data tidak boleh kosong!');
        //value post
         $data['judulVideo'] = htmlspecialchars($this->input->post('judulvideo'));
         $data['deskripsi'] = htmlspecialchars($this->input->post('deskripsi'));
         $data['subBabID'] = htmlspecialchars($this->input->post('subBab'));
         $data['published'] = htmlspecialchars($this->input->post('publish'));
         $data['jenis_video'] = htmlspecialchars($this->input->post('jenis_video'));
         $link=$this->input->post('link_video');
         $option_up=htmlentities($this->input->post('option_up'));
        if ($this->form_validation->run() == FALSE) {
            $this-> formupvideo();
        }else{
             if ($option_up =='link') {
                $penggunaID = $this->session->userdata['id'];
                $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
                $guruID = $data['tb_guru']['id'];
                $UUID = uniqid();
                $linkembed=$this->get_linkembed($link);
                 $data_video = array(
                    'judulVideo' => $data['judulVideo'] ,
                    'link' => $linkembed,
                    'deskripsi' => $data['deskripsi'],
                    'published' => $data['published'],
                    'guruID' => $guruID,
                    'subBabID' => $data['subBabID'],
                    'UUID' => $UUID,
                     'jenis_video' => $data['jenis_video']
                );
               
                $this->Mvideoback->insertVideo($data_video);
             }else{
                $this->upvideo($data);
             }
        }
     } 

     // get id video youtube untuk di simpan ke db
     public function get_linkembed($link)
     {
        $mulai='0';
        $end='0';
        $linkembed=' ';
        $i=0;
        // echo strlen($nama);
        for ($x = 0; $x < strlen($link); $x++) {

          if ($link[$x] == '=' ) {
            $startID=$x+1;
            $linkembed='https://www.youtube.com/embed/'.substr($link, $startID,11);
            break;
          }else{
            $linkembed=$link;
          }
          
        }
        return $linkembed;
     }

     public function cek_option_update()
     {
           //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //set role
        $this->form_validation->set_rules('judulvideo', 'Judul Video', 'required');
        $this->form_validation->set_rules('subBab', 'Subbab', 'required');
         // $this->form_validation->set_rules('video', 'Video', 'required');

        //pesan error atau pesan kesalahan pengisian form upload video
        $this->form_validation->set_message('required', '*Data tidak boleh kosong!');
        //value post
         $data['judulVideo'] = htmlspecialchars($this->input->post('judulvideo'));
         $data['deskripsi'] = htmlspecialchars($this->input->post('deskripsi'));
         $data['subBabID'] = htmlspecialchars($this->input->post('subBab'));
         $data['published'] = htmlspecialchars($this->input->post('publish'));
         $data['UUID']=$this->input->post('UUID');
         $UUID=$data['UUID'];
         $link=$this->input->post('link_video');
         $option_up=htmlentities($this->input->post('option_up'));
        if ($this->form_validation->run() == FALSE) {
            $this-> formUpdateVideo($data['UUID']);
        }else{
             if ($option_up =='link') {
                $this->dropVideoServer($UUID);
                $penggunaID = $this->session->userdata['id'];
                $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
                $guruID = $data['tb_guru']['id'];
                $linkembed=$this->get_linkembed($link);
                 $data['video'] = array(
                    'judulVideo' => $data['judulVideo'] ,
                    'namaFile' => null,
                    'link' => $linkembed,
                    'deskripsi' => $data['deskripsi'],
                    'published' => $data['published'],
                    'guruID' => $guruID,
                    'subBabID' => $data['subBabID'],
                );
               
                $this->Mvideoback->ch_video($data);

             }else{
                
              
                $this->updateVideo($data);
             }
        }
     }

     // fungsi untuk Update video server
    public function updateVideo($data) {
       
        $config['upload_path'] = './assets/video';
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = 90000;
        $this->load->library('upload', $config);

        $penggunaID = $this->session->userdata['id'];
        $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
        $guruID = $data['tb_guru']['id'];
        $UUID=$data['UUID'];
       
             // pengecekan upload
        if ($this->upload->do_upload('video')) {
          $this->dropVideoServer($UUID);
                // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
         $file_data = $this->upload->data();
         $video = $file_data['file_name'];
                //data yg akan di masukan ke tabel video
         $data['video'] = array(
          'judulVideo' => $data['judulVideo'] ,
          'namaFile' => $video,
          'link' => null,
          'deskripsi' => $data['deskripsi'],
          'published' => $data['published'],
          'guruID' => $guruID,
          'subBabID' => $data['subBabID'],
          );
        } else {
          $data['video'] = array(
            'judulVideo' => $data['judulVideo'] ,
            'link' => null,
            'deskripsi' => $data['deskripsi'],
            'published' => $data['published'],
            'guruID' => $guruID,
            'subBabID' => $data['subBabID'],
            );
        }
          $this->Mvideoback->ch_video($data);
    }
    //hapus video di server
    public function dropVideoServer($UUID)
    {
        $video=$this->Mvideoback->get_video_by_UUID($UUID)[0];

        if ($video['namaFile']!=null) {
          unlink(FCPATH . "./assets/video/" . $video['namaFile']);
        }

    }

    //hapus video di db
    public function dropVideo($videoID)
    {
        $this->Mvideoback->del_video($videoID);
    }
    //hapus file video
    public function del_file_video($videoID)
    {
        $oldVideo=$this->mvideos->get_nameFile($videoID)[0];
        $nameVideo=$oldVideo->namaFile;
        
       if ($nameVideo!=null) {
           unlink(FCPATH . "./assets/video/" . $nameVideo);
       }
       $this->dropVideo($videoID);
        

    }

    //Start function untuk dropdown dependent pada form upload video#

    public function getPelajaran( $tingkatID ) {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mvideoback->scPelajaran( $tingkatID ) ) ) ;
    }

    public function getBab( $tpelajaranID ) {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mvideoback->scBab( $tpelajaranID ) ) ) ;
    }

    public function getSubbab( $babID ) {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mvideoback->scSubbab( $babID ) ) );


    }

    public function getTingkat() {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mvideoback->scTingkatvideo() ) ) ;
    }




    //Start function untuk dropdown dependent pada form upload video#

    // fungsi untuk filter video
    public function filter_video()
    {
        $tingkat = $this->input->post('tingkat');
        $pelajaran = $this->input->post('mataPelajaran');
        $bab=$this->input->post('bab');
        $subbab=$this->input->post('subbab');

        if ($subbab != null) {
            $this->video_by_subbab($subbab);
        } else if ($bab != null) {
            $this->video_by_bab($bab);
        } else if ($pelajaran != null) {
            $this->video_by_mapel($pelajaran);
        } else if ($tingkat != null) {
            $this->video_by_tingkat($tingkat);
        } else {
           $this->listvideo();
        }    
    }
    //menampilkan video by subbab
    public function video_by_subbab($subbab)
    {
        $data['subBabID']=$subbab;
        $namasub=$this->Mvideoback->get_nama_sub($subbab);
        $data['nama']=$namasub['judulSubBab'];
        $data['judul_halaman'] = "Daftar Video";
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-subbab-video.php',
        );
        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }

    }
    //menampilkan video by bab
    public function video_by_bab($bab)
    {
        $data['babID']=$bab;
        $namabab=$this->Mvideoback->get_nama_bab($bab);
        $data['nama']= $namabab['judulBab'];
        $data['judul_halaman'] = "Daftar Video ";
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-bab-video.php',
        );
        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
           $data['files'] = array(
            APPPATH.'modules/templating/views/v-maintenance.php',
          );
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }
    }
    //menampilkan video by mata pelajaran
    public function video_by_mapel($pelajaran)
    {
        $data['mapelID']=$pelajaran;
        $mapel=$this->Mvideoback->get_nama_mapel($pelajaran);
         $data['nama']= $mapel['keterangan'];
        $data['judul_halaman'] = "Daftar Video ";
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-mapel-video.php',
        );
        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
           $data['files'] = array(
            APPPATH.'modules/templating/views/v-maintenance.php',
          );
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }
    }
    //menampilkan video by tingkat
    public function video_by_tingkat($tingkat)
    {
        $data['tingkatID']=$tingkat;
        $tingkat=$this->Mvideoback->get_nama_tingkat($tingkat);
        $data['nama']= $tingkat['aliasTingkat'];
        $data['judul_halaman'] = "Daftar Video" ;
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-tingkat-video.php',
        );
        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
           $data['files'] = array(
            APPPATH.'modules/templating/views/v-maintenance.php',
          );
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
            $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{
            
            redirect(site_url('login'));
        }
    }

    // daftar semua video
    public function listvideo()
    {
        $data['judul_halaman'] = "Daftar Video";
        $data['files'] = array(
            APPPATH.'modules/videoback/views/v-all-video.php',
        );

            $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
           //maintenance
           $data['files'] = array(
            APPPATH.'modules/templating/views/v-maintenance.php',
          );
                    // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                    // jika guru
             $this->parser->parse('templating/index-b-guru', $data);
        }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }else{

            redirect(site_url('login'));
        }
        
    }

    // menampilkan data semua video
    function ajax_get_all_video(){
        
        $data['videos_uploaded'] = $this->load->mvideos->get_all_video();
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        //var_dump($list);
        //mengambil nilai list
        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();
            if ($list_video['published']=='1') {
              $publish='Publish';
            }else{
              $publish='No Publish';
            }
            $row[] = $list_video['videoID'];
            $row[] = $list_video['judulVideo'];
            $row[] = $list_video['namaFile'];
            $row[] = $list_video['matapelajaran'];
            $row[] = $list_video['judulBab'];
            $row[] = $list_video['judulSubBab'];
            $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
            $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
            $row[] =  $publish;
            $guru_id =null;
            if (isset( $this->session->userdata['id_guru'])) {
                $guru_id =$this->session->userdata['id_guru'] ;
               
            } 
                     
          if ($guru_id == null) {
              $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          } elseif ($guru_id == $list_video['guruID']) {
                            $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          }else{ 
               $row[] = '
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a>  ';
          }
          
         

          $data[] = $row;
          $n++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

    // menampilkan data by subbab video
    function ajax_get_subbab_video($subbab){
        $data['videos_uploaded'] = $this->load->mvideos->get_subbab_video($subbab);
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();
            if ($list_video['published']=='1') {
              $publish='Publish';
          }else{
              $publish='No Publish';
          }
          $row[] = $list_video['videoID'];
          $row[] = $list_video['judulVideo'];
          $row[] = $list_video['namaFile'];
          $row[] = $list_video['matapelajaran'];
          $row[] = $list_video['judulBab'];
          $row[] = $list_video['judulSubBab'];
          $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
          $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
          $row[] =  $publish;
          $guru_id =null;
            if (isset( $this->session->userdata['id_guru'])) {
                $guru_id =$this->session->userdata['id_guru'] ;
               
            }
          if ($guru_id == null) {
            $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          } elseif ($guru_id == $list_video['guruID']) {
                            $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          }else{ 
               $row[] = '
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a>  ';
          }
          
         

          $data[] = $row;
          $n++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

    // menampilkan data by bab video
    function ajax_get_bab_video($bab){
        $data['videos_uploaded'] = $this->load->mvideos->get_bab_video($bab);
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();
            if ($list_video['published']=='1') {
              $publish='Publish';
          }else{
              $publish='No Publish';
          }
          $row[] = $list_video['videoID'];
          $row[] = $list_video['judulVideo'];
          $row[] = $list_video['namaFile'];
          $row[] = $list_video['matapelajaran'];
          $row[] = $list_video['judulBab'];
          $row[] = $list_video['judulSubBab'];
          $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
          $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
          $row[] =  $publish;
          $guru_id =null;
            if (isset( $this->session->userdata['id_guru'])) {
                $guru_id =$this->session->userdata['id_guru'] ;
               
            }
          if ($guru_id == null) {
             $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          } elseif ($guru_id == $list_video['guruID']) {
                            $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          }else{ 
               $row[] = '
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a>  ';
          }
          
         

          $data[] = $row;
          $n++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

     // menampilkan data by bab mapel
    function ajax_get_mapel_video($mapel){
        $data['videos_uploaded'] = $this->load->mvideos->get_mapel_video($mapel);
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();
            if ($list_video['published']=='1') {
              $publish='Publish';
          }else{
              $publish='No Publish';
          }
          $row[] = $list_video['videoID'];
          $row[] = $list_video['judulVideo'];
          $row[] = $list_video['namaFile'];
          $row[] = $list_video['matapelajaran'];
          $row[] = $list_video['judulBab'];
          $row[] = $list_video['judulSubBab'];
          $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
          $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
          $row[] =  $publish;
           $guru_id =null;
            if (isset( $this->session->userdata['id_guru'])) {
                $guru_id =$this->session->userdata['id_guru'] ;
               
            }
          if ($guru_id == null) {
              $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          } elseif ($guru_id == $list_video['guruID']) {
                            $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          }else{ 
               $row[] = '
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a>  ';
          }
          
         

          $data[] = $row;
          $n++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

         // menampilkan data by bab mapel
    function ajax_get_tingkat_video($tingkat){
        $data['videos_uploaded'] = $this->load->mvideos->get_tingkat_video($tingkat);
       // var_dump($data['videos_uploaded']);
        $list = $data['videos_uploaded'];
        $data = array();

        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();
            if ($list_video['published']=='1') {
              $publish='Publish';
          }else{
              $publish='No Publish';
          }
          $row[] = $list_video['videoID'];
          $row[] = $list_video['judulVideo'];
          $row[] = $list_video['namaFile'];
          $row[] = $list_video['matapelajaran'];
          $row[] = $list_video['judulBab'];
          $row[] = $list_video['judulSubBab'];
          $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
          $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
          $row[] =  $publish;
          $guru_id =null;
            if (isset( $this->session->userdata['id_guru'])) {
                $guru_id =$this->session->userdata['id_guru'] ;
               
            }
          if ($guru_id == null) {
             $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          } elseif ($guru_id == $list_video['guruID']) {
                           $row[] = ' 
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          }else{ 
               $row[] = '
              <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              data-id='."'".json_encode($list_video)."'".'
              onclick="detail('."'".$list_video['videoID']."'".')"
              >
              <i class=" ico-play3"></i>
                </a>  ';
          }
          
         

          $data[] = $row;
          $n++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

}

?>
