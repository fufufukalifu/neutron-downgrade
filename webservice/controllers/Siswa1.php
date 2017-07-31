<?php

/**
 *
 */
class Siswa extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->model('register/mregister');
        $this->load->helper('session');
        $this->load->library('parser');

        // sessionkonfirm();
        // get_session_siswa();
    }

    //

    public function profilesetting() {
        $data['siswa'] = $this->msiswa->get_datsiswa();
        $this->load->view('templating/t-header');
        $this->load->view('templating/t-navbarUser');
        $this->load->view('vPengaturanProfile', $data);
        $this->load->view('templating/t-footer');
    }

    public function index() {
        $data['siswa'] = $this->msiswa->get_datsiswa();
        $this->load->view('templating/t-header');
        $this->load->view('templating/t-navbarUser');
        $this->load->view('t-profile-siswa', $data);
        $this->load->view('templating/t-footer');
    }

    //menampilkan halaman pengaturan profile
    public function PengaturanProfile() {
        $data['tb_siswa'] = $this->msiswa->get_datsiswa();
        $this->load->view('templating/t-header');
        $this->load->view('templating/t-navbarUser');
        $this->load->view('vPengaturanProfile', $data);
        $this->load->view('templating/t-footer');
    }

    public function ubahprofilesiswa() {
        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //syarat pengisian form perubahan profile
        $this->form_validation->set_rules('namadepan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        ;

        //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('is_unique', '*Nama Pengguna sudah terpakai');
        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');
        $this->form_validation->set_message('min_length', '*Nama Pengguna minimal 5 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');



        if ($this->form_validation->run() == FALSE) {
            $data['siswa'] = $this->msiswa->get_datsiswa();
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser');
            $this->load->view('vPengaturanProfile', $data);
            $this->load->view('templating/t-footer');
        } else {
            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));
            $biografi = htmlspecialchars($this->input->post('biografi'));
            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));
            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));


            $data_post = array(
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
                'biografi' => $biografi,
                'namaSekolah' => $namaSekolah,
                'alamatSekolah' => $alamatSekolah,
            );

            $this->msiswa->update_siswa($data_post);
        }
    }

    public function ubahemailsiswa() {

        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //syarat pengisian form perubahan nama pengguna dan email

        $this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_pengguna.eMail]');

        //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('is_unique', '*Email sudah terpakai');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');


        if ($this->form_validation->run() == FALSE) {
            $data['siswa'] = $this->msiswa->get_datsiswa();
            sessionkonfirm();
            sessionsiswa();
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser');
            $this->load->view('vPengaturanProfile', $data);
            $this->load->view('templating/t-footer');
        } else {
            $email = htmlspecialchars($this->input->post('email'));

            $data_post = array(
                'eMail' => $email,
            );
            $this->msiswa->update_email($data_post);
        }
    }

    public function ubahkatasandi() {

        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        //syarat pengisian form perubahan pasword
        $this->form_validation->set_rules('sandilama', 'Kata Sandi Lama', 'required');
        $this->form_validation->set_rules('newpass', 'Kata Sandi Baru', 'required|matches[verifypass]');
        $this->form_validation->set_rules('verifypass', 'Password Confirmation', 'required');

        //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('required', '*tidak boleh kosong!');
        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');


        if ($this->form_validation->run() == FALSE) {
            $data['siswa'] = $this->msiswa->get_datsiswa();
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser');
            $this->load->view('vPengaturanProfile', $data);
            $this->load->view('templating/t-footer');
        } else {
            $kataSandi = htmlspecialchars(md5($this->input->post('newpass')));
            $inputSandi = htmlspecialchars(md5($this->input->post('sandilama')));
            $data_post = array('kataSandi' => $kataSandi,);
            $data['pengguna'] = $this->msiswa->get_password()[0];
            $kataSandi = $data['pengguna']['kataSandi'];
            var_dump($kataSandi);
            if ($kataSandi == $inputSandi) {
                $this->msiswa->update_katasandi($data_post);
            } else {
                // code...
                echo "salah"; //for testing
            }
        }
    }

    public function upload($oldphoto) {
        unlink(FCPATH . "./assets/image/photo/siswa/" . $oldphoto);
        $config['upload_path'] = './assets/image/photo/siswa';
        $config['allowed_types'] = 'jpeg|gif|jpg|png|mkv';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {


            $data['error'] = array('error' => $this->upload->display_errors());
            $data['siswa'] = $this->msiswa->get_datsiswa();
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser');
            $this->load->view('vPengaturanProfile', $data);

            $this->load->view('templating/t-footer');


            // $this->load->view('beranda/main_view',$error);,
        } else {
            $file_data = $this->upload->data();
            $photo = $file_data['file_name'];
            $this->msiswa->update_photo($photo);
            echo "berhasil upload"; //for testing
            // $data['img'] = base_url().'/images/'.$file_data['file_name'];
            // $this->load->view('beranda/success_msg',$data);
        }
    }

    ##menampilkan daftar siswa ajax

    public function ajax_daftar_siswa() {
        $list = $this->msiswa->get_all_siswa();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_siswa['idsiswa'];
            ;
            $row[] = $list_siswa['penggunaID'];
            $row[] = $list_siswa['namaDepan'] . " " . $list_siswa['namaBelakang'];
            $row[] = $list_siswa['namaPengguna'];

            $row[] = $list_siswa['namaSekolah'];
            $row[] = '<a href=""  title="Mail To">' . $list_siswa['eMail'] . '</a> <i class="ico-mail-send"></i>';

            $row[] = '<a class="btn btn-sm btn-warning"  title="Edit" onclick="edit_siswa(' . "'" . $list_siswa['id'] . "'" . ')"><i class="ico-edit"></i></a> 

        <a class="btn btn-sm btn-primary"  title="Detail" onclick="detail_siswa(' . "'" . json_encode($list_siswa['id']) . "'" . ')"><i class="ico-file5"></i></a>

        <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa(' . "" . $list_siswa['idsiswa'] . "," . $list_siswa['penggunaID'] . ')"><i class="ico-remove"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    ##menampilkan siswa

    public function daftar() {
        $data['judul_halaman'] = "Pengelolaan Data Siswa";
        $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-daftar-siswa.php',
        );
        // jika admin
        $this->parser->parse('admin/v-index-admin', $data);
    }

    public function daftarsiswa() {
        $data['judul_halaman'] = "Pengelolaan Data Siswa";
        $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-form-siswa.php',
        );
        // jika admin
        $this->parser->parse('admin/v-index-admin', $data);
    }

//function untuk menyimpan data pendaftaran user siswa ke database
    public function savesiswa() {
//load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//syarat pengisian form regitrasi siswa
        $this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'trim|required|min_length[5]|max_length[12]|is_unique[tb_pengguna.namaPengguna]');
        $this->form_validation->set_rules('namadepan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        $this->form_validation->set_rules('katasandi', 'Kata Sandi', 'required|matches[passconf]|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_pengguna.email]');


//pesan error atau pesan kesalahan pengisian form registrasi siswa
        $this->form_validation->set_message('is_unique', '*Nama Pengguna atau email sudah terpakai');
        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');
        $this->form_validation->set_message('min_length', '*Inputan minimal 6 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');
        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');
        $this->form_validation->set_message('valid_email', '*silahkan masukan alamat email anda dengan benar');

//pengecekan pengisian form regitrasi siswa
        if ($this->form_validation->run() == FALSE) {
//jika tidak memenuhi syarat akan menampilkan pesan error/kesalahan di halaman regitrasi siswa
            $this->daftarsiswa();
        } else {

//data siswa
            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));


            $tingkatID = htmlspecialchars($this->input->post('tingkatID'));
            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));
            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));

//data akun
            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));
            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));
            $email = htmlspecialchars($this->input->post('email'));
            $hakAkses = 'siswa';

//data array akun
            $data_akun = array(
                'namaPengguna' => $namaPengguna,
                'kataSandi' => $kataSandi,
                'eMail' => $email,
                'hakAkses' => $hakAkses,
            );


//melempar data guru ke function insert_pengguna di kelas model
            $data['mregister'] = $this->mregister->insert_pengguna($data_akun);
//untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel siswa
            $data['tb_pengguna'] = $this->mregister->get_idPengguna($namaPengguna)[0];

            $penggunaID = $data['tb_pengguna']['id'];

//session buat id
            $id_arr = array('id' => $penggunaID);
//            $this->session->set_userdata($id_arr);
//data array siswa
            $data_siswa = array(
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
                'namaSekolah' => $namaSekolah,
                'alamatSekolah' => $alamatSekolah,
                'penggunaID' => $penggunaID,
                'tingkatID' => $tingkatID,
            );
//data unutk session siswa
//            $sess_array = array(
//                'id' => $penggunaID,
//                'USERNAME' => $namaPengguna,
//                'HAKAKSES' => $hakAkses,
//                'eMail' => $email,
//                'tingkatID' => $tingkatID
//            );
//melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->mregister->insert_siswabyadmin($data_siswa, $email, $namaPengguna);
//            redirect(site_url('register/verifikasi'));

            redirect(base_url('index.php/siswa/daftarsiswa'));
        }
    }

    public function deleteSiswa() {
        $idsiswa = $this->input->post('idsiswa');
        $idpengguna = $this->input->post('idpengguna');
        $this->msiswa->hapus_siswa($idsiswa,$idpengguna);
    }

}

?>
