<!-- START Template Main  -->

<section id="main" role="main">

    <!-- START Template Container -->



    <div class="container-fluid">

        <!-- START row -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2 ">

                <?php if ($this->session->flashdata('notif') != '') {

                    ?>

                    <div class="alert alert-warning fade in">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                    </div>

                <?php } else { ?>

                    <div class="alert alert-warning fade in">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                        <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.

                    </div>

                <?php }; ?>

                <!-- Form horizontal layout bordered -->

                <form class="form-horizontal panel panel-default login-form " name="form-register" action="<?= base_url() ?>index.php/siswa/savesiswa" method="post">

                    <div class="panel-heading">

                        <h3 class="panel-title">Tambah Data Siswa</h3>

                        <!-- untuk menampung bab id -->

                        <a href="<?= base_url('index.php/siswa/daftar')?>" class="btn btn-default btn-sm pull-right"style="margin-top:-33px;" >Kembali</a>

                    </div>               

                    <div class="panel-body">

                        <br>

                        <div class="">

                            <p class="text-center">IDENTITAS PENGGUNA</p>

                        </div>

                        <div class="clear-both"></div>





                        <div class="form-group">

                            <!--<label class="control-label col-sm-2">Judul Soal</label>-->

                            <div class="col-sm-5 col-md-offset-1">

                                <input type="text" name="namadepan" class="form-control" placeholder="Nama Depan" required="true" value="<?php echo set_value('namadepan'); ?>">

                                <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>

                            </div>

                            <div class="col-sm-5">

                                <input type="text" name="namabelakang" class="form-control" placeholder="Nama Belakang" required="true" value="<?php echo set_value('namabelakang'); ?>">

                                <span class="text-danger"> <?php echo form_error('namabelakang'); ?></span>

                            </div>



                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" data-parsley-required required>

                                <span class="text-danger"> <?php echo form_error('alamat'); ?></span> 

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input type="text" class="form-control" placeholder="No Kontak" name="nokontak" value="<?php echo set_value('nokontak'); ?>" data-parsley-required required>

                                <span class="text-danger"> <?php echo form_error('nokontak'); ?></span> 

                            </div>

                        </div>

                        <hr>



                        <div class="">

                            <br>

                            <p class="text-center">IDENTITAS SEKOLAH</p>

                        </div>

                        <div class="clear-both"></div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <select class="form-control" name="tingkatID" id="tingkatID" required>

                                    <option value="">-Pilih Tingkat Sekolah-</option>

                                    <option value="6">Kelas 1 - SD</option>

                                    <option value="7">Kelas 2 - SD</option>

                                    <option value="8">Kelas 3 - SD</option>

                                    <option value="9">Kelas 4 - SD</option>

                                    <option value="10">Kelas 5 - SD</option>

                                    <option value="11">Kelas 6 - SD</option>

                                    <option value="12">Kelas 7 - SMP</option>

                                    <option value="13">Kelas 8 - SMP</option>

                                    <option value="14">Kelas 9 - SMP</option>

                                    <option value="15">Kelas 10 - SMA IPA</option>

                                    <option value="16">Kelas 11 - SMA IPA</option>

                                    <option value="17">Kelas 12 - SMA IPA</option>

                                    <option value="18">Kelas 10 - SMA IPS</option>

                                    <option value="19">Kelas 11 - SMA IPS</option>

                                    <option value="19">Kelas 12 - SMA IPS</option>  

                                </select>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input type="text" placeholder="Nama Sekolah" class="form-control" name="namasekolah" value="<?php echo set_value('namasekolah'); ?>"data-parsley-required required>

                            </div>

                        </div>



                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Alamat Sekolah" type="text" class="form-control" name="alamatsekolah" value="<?php echo set_value('alamatsekolah'); ?>"data-parsley-required required>

                            </div>

                        </div>


                        <hr>

                        <div class="">

                            <br>

                            <p class="text-center">IDENTITAS AKUN</p>

                        </div>



                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Username" type="text" class="form-control" name="namapengguna" value="<?php echo set_value('namapengguna'); ?>"  data-parsley-required required>

                                <span class="text-danger"><?php echo form_error('namapengguna'); ?></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Password" type="password" class="form-control" name="katasandi" maxlength="20" required>

                                <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Confirm Password" type="password" class="form-control" name="passconf" data-parsley-equalto="input[name=password]" maxlength="20" required>

                                <span class="text-danger"><?php echo form_error('katasandi'); ?></span>



                            </div>

                        </div>
                        <hr>
                        <!-- Start form data bimbel -->
                        <div  class="form-group">
                             <div class="col-sm-10 col-md-offset-1">


                                <p class="text-center">BIMBEL</p>

                                <!-- list Bimbel -->
                                <select class="form-control" name="bimbel">
                                    <option value="">- Pilih Bimbel Kalian -</option>
                                    <option value="Neutron">Neutron</option>
                                    <option value="GO">GO</option>
                                    <option value="1bimbel lainya">Bimbel lainya</option>
                                </select>
                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                    <span class="text-danger"><?php echo form_error('bimbel'); ?></span>
                             
                                <!--  -->

                            </div>
                        </div>
                        <hr>
   
                        <!-- start from data siswa neon -->
                            <div class="form-group Keaktivan hide " >
                                 <div class="col-sm-10 col-md-offset-1">
                                <p class="text-center">DATA NEON</p>
                                </div>
                            </div> 
                            <div class="form-group Keaktivan hide ">
                                <div class="col-sm-10 col-md-offset-1">
                                    <select class="form-control" name="cabang">
                                        <option value="">- Pilih Cabang -</option>
                                        <?php foreach ($cabang as $cabang_item): ?>
                                            <option value="<?=$cabang_item->id ?>"><?=$cabang_item->namaCabang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                    <span class="text-danger"><?php echo form_error('cabang'); ?></span>
                                </div>
                            </div>

                            <div class="form-group Keaktivan hide">

                                <div class="col-sm-10 col-md-offset-1">

                                    <input placeholder="Nomer Induk Siswa Neutron contoh : 120300xxx" type="text" class="form-control" name="noinduk" value="<?php echo set_value('noinduk'); ?>" data-parsley-required>

                                    <i class="ico-tag9 form-control-icon"></i>

                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                                    <span class="text-danger"><?php echo form_error('noinduk'); ?></span>

                                </div>

                            </div>
                        <!-- end from data siswa neon  -->
       
                        <!-- end form data bimbel -->
                        <hr class="Keaktivan hide">

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">


                                <p class="small">Untuk konfirmasi dan pengaktifan akun siswa, akan dikirim kode aktivasi ke email ini.</p>

                                <!-- Star form konfirmasi akun by email -->

                                <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="xxx@mail.com" required>

                                <!-- untuk menampilkan pesan kesalahan penginputan email -->

                                <span class="text-danger"><?php echo form_error('email'); ?></span> 

                            </div>

                        </div>

                    </div>

                    <div class="panel-footer">

                        <div class="col-md-4 pull-right">

                            <button type="submit" class="btn btn-primary">Simpan</button>

                            <button type="button" class="btn btn-info">Batal</button>

                        </div>

                    </div>

                </form>

                <!--/ Form horizontal layout bordered -->

            </div>



        </div>

        <!--/ END row -->

    </div>

</section>

 <!-- END Template Main -->
 <script type="text/javascript">
$('select[name=bimbel]').change(function(){
    var bimbel = $('select[name=bimbel]').val();
    if (bimbel=='Neutron') {
        $('.Keaktivan').removeClass('hide');
    }else{
        $('.Keaktivan').addClass('hide animate');

    }
});
</script>