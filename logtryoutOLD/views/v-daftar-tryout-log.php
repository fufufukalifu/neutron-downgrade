  <div class="col-md-12 kirim_token">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Laporan Pengerjaan</h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-12">
           <div class="col-sm-4">
             <select class="form-control" id="select_cabang">
              <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="col-sm-4">
           <select class="form-control" id="select_to">
            <option value="all">Semua Tryout</option>          
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-4">
         <select class="form-control col-sm-6" id="select_paket">
          <option value="all">Semua paket</option>
        </select>
        <!-- <button class="btn btn-sm btn-inverse " onclick="pdf()">PDF</button> -->
      </div>
    </div>
  </div>
</div>
<div class="panel-body">
  <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >

    <table class="daftarlog table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>

          <th>ID</th>
          <th>Nama Pengguna</th>
          <th>Nama Lengkap</th>
          <th>Waktu perngerjaan</th>

          <th>Nama Tryout</th>
          <th>Nama Paket</th>
          <th>Status Tryout</th>

        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>
    <hr>

  </div>
  <div class="panel-footer">
  </div>
</div>
</div>
</div>

<script>
  $(document).ready(function(){

    url = base_url+"logtryout/ajax_status_to";
    dataTablePaket = $('.daftarlog').DataTable({
      "ajax": {
        "url": url,
        "type": "POST"
      },
      "emptyTable": "Tidak Ada Data Pesan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
    });

  });



// TO KETIKA DI CHANGE
$('#select_cabang').change(function(){
  cabang = $('#select_cabang').val();
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();

  url = base_url+"logtryout/ajax_status_to/"+cabang+"/"+tryout+"/"+paket;
  dataTablePaket = $('.daftarlog').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

});

    // TO KETIKA DI CHANGE
    $('#select_to').change(function(){
      cabang = $('#select_cabang').val();
      tryout = $('#select_to').val();
      paket = $('#select_paket').val();

      url = base_url+"logtryout/ajax_status_to/"+cabang+"/"+tryout+"/"+paket;
      dataTablePaket = $('.daftarlog').DataTable({
        "ajax": {
          "url": url,
          "type": "POST"
        },
        "emptyTable": "Tidak Ada Data Pesan",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
        "bDestroy": true,
      });

      load_paket(tryout);
    });
//ketika paket di change
function load_paket(id_to){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>admincabang/get_paket/"+id_to,
  success: function(data){
   $('#select_paket').html('<option value="all">-- Pilih Paket  --</option>');
   $.each(data, function(i, data){
    $('#select_paket').append("<option value='"+data.id_paket+"'>"+data.nm_paket+"</option>");
  });
 }
});
}
// TO KETIKA DI CHANGE
$('#select_paket').change(function(){
  cabang = $('#select_cabang').val();
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();

  url = base_url+"admincabang/admincabang/laporanto/"+cabang+"/"+tryout+"/"+paket;
  dataTablePaket = $('.daftarpaket').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});

</script>