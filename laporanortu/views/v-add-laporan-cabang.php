<!-- Start Modal salah upload gambar -->
<div class="modal fade" id="cekInput" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan pilih nama cabang, nama tryout dan nama paket ! </h3>
        <!-- <h5 class="text-center">Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png"</h5> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="row">
  <div class="col-md-12 kirim_token">
    <div class="panel panel-teal">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Laporan </h3> 

        <div class="panel-toolbar text-right">
          <div class="col-md-11">

            <div class="col-sm-4" id="cabang">
             <select class="form-control" id="select_cabang">
             <!--  <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?> -->
            </select>
          </div>

          <div class="col-sm-4">
            <select class="form-control" name="tingkat_pel">
              <option value="all">Semua Tingkat</option>
              <option value="SD">SD</option>
              <option value="SMP">SMP</option>
              <option value="SMA">SMA</option>
            </select>
          </div>

          <div class="kelas col-sm-4">
            <select class="form-control col-sm-6" name="kelas">
              <option value="all">Semua Kelas</option>
            </select>
          </div>



        </div>
      </div>

    </div>

    <div class="panel-body">
      <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
       <div  class="form-group">
         <label class="col-sm-2 control-label">Jenis Laporan</label>
         <div class="col-sm-9">
           <!-- stkt = soal tingkat -->
           <select class="form-control" name="jenis">
            <option value="0">-- Pilih Jenis --</option>
            <option value="nilai">Nilai</option>
            <option value="absen">Absen</option>
            <option value="umum">Umum</option>
          </select>
        </div>
      </div>
    </form>
    <table class="daftarreport table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Orang Tua</th>
          <th>Nama Siswa</th>
          <th>Username</th>
          <th>Pesan</th>
          <th>
            <span class="checkbox custom-checkbox check-all">
              <input type="checkbox" name="checkall" id="check-all">
              <label for="check-all">&nbsp;&nbsp;</label>
            </span> 
          </th>
        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>
    <a class="btn btn-primary send_laporan">Kirim</a>
  </div>

</div>
</div>   
</div>

<!-- sound notification -->
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
<!-- /sound notification -->
<script src="http://macyjs.com/assets/js/macy.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

<script type="text/javascript">
  var dataTableReport;
  var cabang= "all";
  $(document).ready(function(){
    function get_cabang(){
      var url_get_cabang=base_url+"admincabang/get_idCabang";
      $.ajax({
        url:url_get_cabang,
        dataType:"text",
        type:"post",
        success:function(Data){
          var ob_cabang = JSON.parse(Data);
          cabang=ob_cabang.id_cabang;
          console.log(ob_cabang.namaCabang);
          // info cabang
          $("#select_cabang").append('<option value="'+cabang+'">'+ob_cabang.namaCabang+'</option>');
          $("#select_cabang").attr("disabled","true");
           // <option value="all">Semua Cabang</option>
           set_tb_laporan(cabang);
        },
        error:function(){

        }
      });

    }
    get_cabang();  

  });

function set_tb_laporan(cabang) {
  dataTableReport = $('.daftarreport').DataTable({
      "ajax": {
        "url": base_url+"laporanortu/addlaporanortu_ajax/"+cabang,
        "type": "POST"
      },
      "emptyTable": "Tidak Ada Data Pesan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
    });
}

// CABANG KETIKA DI CHANGE
$('select[name=cabang]').change(function(){

  cabang = $('#select_cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});


// TINGKAT KETIKA DI CHANGE
$('select[name=tingkat_pel]').change(function(){
  cabang = $('#select_cabang').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  load_kelas(tingkat);

});

// LOAD KELAS
function load_kelas(tingkat){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>laporanortu/get_kelas/"+tingkat,
  success: function(data){
   $('select[name=kelas]').html('<option value="all">-- Pilih Kelas  --</option>');

   $.each(data, function(i, data){
    $('select[name=kelas]').append("<option value='"+data.id+"'>"+data.aliasTingkat+"</option>");
  });
 }

});
}

// KELAS KETIKA DI CHANGE
$('select[name=kelas]').change(function(){

  cabang = $('#select_cabang').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});


$('[name="checkall"]:checkbox').click(function () {
 if($(this).attr("checked")){
  $('table.daftarreport tbody input:checkbox').prop( "checked", true );
} else{ 
  $('table.daftarreport tbody input:checkbox').prop( "checked", false );
}
});

// KETIKA BUTTON KIRIM DIKLIK
$('.send_laporan').click(function(){
  kirim_laporan();
});

//fungsi kirim laporan
function kirim_laporan(){
  //tampung id ortu
  id_ortu = [];

  // tampung isi pesan
  pesan = [];
  
  //tampung jenis laporan
  jenis_lapor = $('select[name=jenis]').val();

  //cek kalo belum set jenis laporan
  if (jenis_lapor==0) {
    swal('silahkan tentukan jenis terlebih dahulu');
    $('select[name=jenis]').focus();
  }else{
   $('.daftarreport tbody td :checkbox:checked').each(function(i){
     id_ortu[i] = $(this).val();
   }); 

   jumlah_ortu = id_ortu.length;

   $('.pesan').each(function(i){
    tempt_pesan = $(this).val();
          // cek dulu isi pesannya kosong gak?
          if (tempt_pesan==null || tempt_pesan=="") {
          }else{
            // ini buat ngehapus array
            // kalo ga kosong masukin ke array pesan
            pesan.push(tempt_pesan);   
          }
     
   }); 

    // cek jumlah ortu yang dipilih
    if (jumlah_ortu==0) {
      swal('Silahkan tentukan ortu terlebih dahulu');
    }else{
      
      // cek udah diceklis blm siswanya?
        if($('.daftarreport tbody td :checkbox:checked').is(':checked')) {
          // cek jumlah pesan sesuai dengan yang diceklis atau tidak?
          if (pesan.length != jumlah_ortu) {  
            swal('Maaf', 'Pesan tidak boleh kosong!', 'error');           
          } else {
            $.ajax({
                    type:"POST",
                    url:base_url+"laporanortu/kirim_laporan",
                    data:{id_ortu:id_ortu,
                    jumlah_ortu:jumlah_ortu,
                    jenis_lapor:jenis_lapor,
                    isi:pesan},
                    dataType: "json",
                    cache : false,
                    success: function(data){
                      swal('Yes!','Laporan Berhasil Di Kirim','success');
                      reload();
                    },error:function(){
                      swal('No!','Gagal mengirim Laporan','error');
                    }
              });
          }
        } else {

        }

    }
  }

}

function reload(){
  dataTableReport.ajax.reload(null,false); 
}

</script>