<div class="row">
  <div class="col-md-12 kirim_token">
    <div class="panel panel-teal">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Paket TO</h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-12 mr0 pr0">
           <div class="col-sm-4 hide">
             <!-- kalo gada yang di filter -->
             <?php if (!empty($post)): ?>
               <input name="filter_cabang" type="hidden" value="<?=$post['select_cabang']  ?>">
               <input name="filter_to" type="hidden" value="<?=$post['to']  ?>">
               <input name="filter_paket" type="hidden" value="<?=$post['paket']  ?>">
             <?php endif ?>
             <!-- kalo gada yang di filter -->
             <select class="form-control" id="select_cabang">
             <!--  <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?> -->
            </select>
          </div>

          <div class="col-sm-4 mt5 pl0 pr0">
           <select class="form-control" id="select_to">
            <option value="all">Semua Tryout</option> 
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout'] ?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-4 mt5">
         <select class="form-control col-sm-6" id="select_paket">
          <option value="all">Semua paket</option>
          </select>
          <!-- <button class="btn btn-sm btn-inverse " onclick="pdf()">PDF</button> -->
        </div>
        <div class="col-sm-4 mt5 ml0 pl0 pr0">
          <!-- dropdown laporan -->
        <div class="btn-group" style="margin-bottom:5px;">
          <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">Download Report<span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:void(0);" onclick="pdf_rto()"">PDF Report TO </a></li>
            <li><a href="javascript:void(0);" onclick="pdf()">PDF Report Paket </a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);"  onclick="excel()">Excel Report TO </a></li>
          </ul>
        </div>
        <!-- /dropdown laporan -->
        </div>
      </div>
   <!--    <button class="btn btn-sm btn-inverse col-sm-1" onclick="pdf()">PDF</button>
      <button class="btn btn-sm btn-outline btn-inverse col-sm-1" onclick="pdf_rto()">PDF</button> -->
      <!-- <button class="btn btn-sm btn-primary" onclick="excel()">excel</button> -->
        
    </div>

  </div>

  <div class="panel-body">
    <div class="col-md-12" >
      <!-- recor per page tabel pengguna token -->
      <div class="col-md-2 mb2 mt10 pl0">
        <select  class="form-control" name="records_per_page" >
          <!-- <option value="10" selected="true">records per page</option> -->
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50" selected="true">50</option>
          <option value="100">100</option>
          <option value="200">200</option>
        </select>
      </div>
      <!-- /recor per page tabel pengguna token -->
      <!-- div pencarian  -->
      <div class="col-md-10 mb10 mt10 pr0">
        <div class="input-group">
           <span class="input-group-addon btn" id="cariDat"><i class="ico-search"></i></span>
           <input class="form-control" type="text" name="cariDat" placeholder="Masukkan Username">
        </div>
      </div>
      <!-- div pencarian -->
      </div>
    <table class="daftarpaket table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>No</th>
            <th>Cabang</th>
          <th>Nis CBT</th>
          <th>Nama SIswa</th>
           <th>Nama Paket</th>
          <th>Jumlah Soal</th>
          <th>Benar</th>
          <th>Salah</th>
          <th>Kosong</th>
          <th>Nilai</th>
          <th>Waktu Mengerjakan</th>
          <th>Aksi</th>

        </tr>
      </thead>

      <tbody id="record_daftar_paket">

      </tbody>

    </table>
    <!-- div pagination daftar token -->
    <div class="col-md-12">
      <ul class="pagination pagination-paket">

      </ul>
    </div>
    <!-- div pagination daftar token -->
  </div>

</div>
</div>   
</div>
<script type="text/javascript">
  var tb_paket;
  var mySelect
  var url;
  var dataPaket;
  var records_per_page=50;
  var page=0;
  var pagination_paket;
  var pageVal=0;
  var pageSelek=0;
  var meridian=4;
  var prev=1;
  var next=2;
  var cabang= "all";
  var tryout="all";
  var paket="all";
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
    function get_cabang(){
      var url_get_cabang=base_url+"admincabang/get_idCabang";
      $.ajax({
        url:url_get_cabang,
        dataType:"text",
        type:"post",
        success:function(Data){
          var ob_cabang = JSON.parse(Data);

          cabang=ob_cabang.id_cabang;
          // info cabang
          $("#select_cabang").append('<option value="'+cabang+'">'+ob_cabang.namaCabang+'</option>');
          $("#select_cabang").attr("disabled","true");
          set_tb_paket();
          set_pagination_tb_paket()
           // <option value="all">Semua Cabang</option>
        },
        error:function(){

        }
      });

    }
    get_cabang();
    mySelect = $('select[name=cabang]').val();

    //set data laporan paket to
    function set_tb_paket() { 
      url=base_url+"admincabang/laporanto";
      dataPaket={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
      $.ajax({
        url:url,
        data:dataPaket,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
          tb_paket = JSON.parse(Data);
          $('#record_daftar_paket').append(tb_paket);
        },
        error:function(){

        },
      });

      
    }
    
    function set_pagination_tb_paket() {
      url=base_url+"admincabang/pagination_daftar_paket";
      dataPaket={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
      $.ajax({
        url:url,
        data:dataPaket,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
       $('.pagination-paket').empty();
          pagination_paket = JSON.parse(Data);
          $('.pagination-paket').append(pagination_paket);
        },
        error:function(){

        },
      });
    }
    
      // even untuk jumlah record per halaman
    $("[name=records_per_page]").change(function(){
      records_per_page =$('[name=records_per_page]').val();
           selectPagePaket();
        set_pagination_tb_paket();
    });

    // CABANG KETIKA DI CHANGE
    $('#select_cabang').change(function(){
      cabang = $('#select_cabang').val();
      tryout = $('#select_to').val();
      paket = $('#select_paket').val();

      selectPagePaket();
      set_pagination_tb_paket();

    });

    // TO KETIKA DI CHANGE
  $('#select_to').change(function(){
    cabang = $('#select_cabang').val();
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
    selectPagePaket();
    set_pagination_tb_paket();
    load_paket(tryout);
  });

  // TO KETIKA DI CHANGE
  $('#select_paket').change(function(){
    cabang = $('#select_cabang').val();
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
    selectPagePaket();
    set_pagination_tb_paket();
  });

  $('#cariDat').click(function(e){
      //get value dari input name cariDat
      keySearch=$('[name=cariDat]').val();
      selectPagePaket();
      set_pagination_tb_paket();
      //
    });
});
function selectPagePaket(pageVal='0') {
  $('#record_daftar_paket').empty();
  page=pageVal;
  pageSelek=page*records_per_page;
  url=base_url+"admincabang/laporanto";
  dataPaket={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
  $.ajax({
    url:url,
    data:dataPaket,
    dataType:"text",
    type:"post",
    success:function(Data)
    {
      tb_paket = JSON.parse(Data);
      $('#record_daftar_paket').append(tb_paket);
    },
    error:function(){
      // sweetAlert("Oops...", e, "error");
    },
  });

  //meridian adalah nilai tengah padination
 $('#page-'+meridian).removeClass('active');
  var newMeridian=page+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prev").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prev=1;
    next=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#page-'+idPaginationhide;
      showPagination='#page-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridian){
    $("#page-prev").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridian;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridian-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#page-'+idPaginationhide;
          showPagination='#page-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
                idPaginationshow--;
          idPaginationhide++;
        }
  }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridian+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#page-'+idPaginationhide;
      showPagination='#page-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
            idPaginationshow++;
      idPaginationhide--;
    }
  } 
   prev=newMeridian-2;
   next=newMeridian;
   meridian=newMeridian;
   $('#page-'+meridian).addClass('active');

}

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


// laporan pdf per paket
function pdf() {
  /// TOMBOL PDF KETIKA DI KLIK
  cabang = $('#select_cabang').val();
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();
  if (cabang != "all" && tryout != "all" && paket != "all") {
    url = base_url+"admincabang/laporan_paket_PDF/"+cabang+"/"+tryout+"/"+paket;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih cabang, tryout dan paket!","error");
  }
}

//laporan pdf per to
function pdf_rto() {
  cabang = $('#select_cabang').val();
  tryout = $('#select_to').val();
  if (cabang != "all" && tryout != "all") {
    url = base_url+"admincabang/laporan_to_PDF/"+cabang+"/"+tryout;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih cabang, tryout dan paket!","error");
  }
}

function excel() {
  /// TOMBOL PDF KETIKA DI KLIK
  cabang = $('#select_cabang').val();
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();
  if (cabang != "all" && tryout != "all" && paket != "all") {
    url = base_url+"admincabang/laporan_paket_excel/"+cabang+"/"+tryout+"/"+paket;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih cabang, tryout dan paket!","error");
  }
}

function drop_report(datas){
  url = base_url+"admincabang/drop_report";

  swal({
    title: "Yakin akan hapus report?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
      dataType:"text",
      data:{id_report:datas},
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Data report berhasil dihapus.", "success");
        dataTablePaket.ajax.reload(null,false);
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }
    });
  });
}
</script>