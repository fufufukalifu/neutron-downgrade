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
    <div class="col-md-12">
      <!-- div panel -->
      <div class="panel panel-teal">
        <div class="panel-heading">
        <h3 class="panel-title">Kirim Laporan </h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-11">

            <div class="col-sm-4">
             <select class="form-control" name="cabang">
              <option value="all">Semua Cabang</option>
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
          <div class="col-md-12" >
            <!-- recor per page tabel pengguna token -->
            <div class="col-md-2 mb2 mt10 pl0">
              <select  class="form-control" name="records_per_page" >
                <!-- <option value="10" selected="true">records per page</option> -->
                <option value="10" selected="true">10</option>
                <option value="1">1</option>
                <option value="25">25</option>
                <option value="50" >50</option>
                <option value="100">100</option>
                <option value="200">200</option>
              </select>
            </div>
            <!-- /recor per page tabel pengguna token -->
            <!-- div pencarian  -->
            <div class="col-md-10 mb10 mt10 pr0">
              <div class="input-group">
                <span class="input-group-addon btn" id="cariDat"><i class="ico-search"></i></span>
                <input class="form-control" type="text" name="cariDat" placeholder="Cari Data">
              </div>
            </div>
            <!-- div pencarian -->
          </div>
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

            <tbody id="record_daftar_report">

            </tbody>
          </table>
            <!-- div pagination daftar token -->
            <div class="col-md-12">
              <ul class="pagination pagination-report">

              </ul>
            </div>
            <!-- div pagination daftar token -->
        </div>
      </div>
      <!-- div panel -->
    </div>
  </div>

<!-- sound notification -->
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
<!-- /sound notification -->
<script src="http://macyjs.com/assets/js/macy.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

<script type="text/javascript">
  var tb_report_ortu;
  var mySelect;
  var url;
  var dataReport;
  var records_per_page=50;
  var page=0;
  var pagination_report;
  var pageVal=0;
  var pageSelek=0;
  var meridian=4;
  var prev=1;
  var next=2;
  var cabang= "all";
  var tingkat="all";
  var kelas="all";
  var keySearch='';
  // next page
  function nextPage() {
    selectPagePaket(next);
  }
  // prev page
  function prevPage() {
    selectPagePaket(prev);
  }
    
  $(document).ready(function(){
    var cabang = $('select[name=cabang]').val();
    get_cabang();  
    mySelect = $('select[name=cabang]').val();
    function set_tb_report() { 
      url=base_url+"laporanortu/addlaporanortu_ajax/"+cabang;
      dataReport={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tingkat:tingkat,kelas:kelas,keySearch:keySearch};
      console.log(dataReport)
      $.ajax({
        url:url,
        data:dataReport,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
          tb_report = JSON.parse(Data);
          $('#record_daftar_report').append(tb_report);
        },
        error:function(){

        },
      });
    }
    function set_pagination_tb_report() {
      url=base_url+"laporanortu/pagination_daftar_all_report";
      dataReport={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tingkat:tryout,paket:paket,keySearch:keySearch};
      console.log(dataPaket);
      $.ajax({
        url:url,
        data:dataPaket,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
       $('.pagination-report').empty();
          pagination_report = JSON.parse(Data);
          $('.pagination-report').append(pagination_report);
        },
        error:function(){

        },
      });
    }
  });

  // get cabang
  function get_cabang(){
    var url_get_cabang=base_url+"laporanortu/get_cabang";
    $.ajax({
      url:url_get_cabang,
      dataType:"json",
      type:"post",
      success:function(data){
       $('select[name=cabang]').html('<option value="all">Semua Cabang </option>');

       $.each(data, function(i, data){
        $('select[name=cabang]').append("<option value='"+data.id+"'>"+data.namaCabang+"</option>");
      });

     },
     error:function(){

     }
   });

  }


// CABANG KETIKA DI CHANGE
$('select[name=cabang]').change(function(){

  cabang = $('select[name=cabang]').val();
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
  cabang = $('select[name=cabang]').val();
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

  cabang = $('select[name=cabang]').val();
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