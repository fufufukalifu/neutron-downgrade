            <!-- MODAL TABEL STEP -->
            <div class="modal fade cabang-modal" tabindex="-1" role="dialog">

              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">




                  </div>
                  <div class="modal-body">
                   <input type="hidden" class="form-control" name="idCabang">
                   <form  class="panel panel-default form-horizontal form-bordered form-kelas"  method="post" >
                     <div  class="form-group">
                       <label class="col-sm-2 control-label">Kelas</label>
                       <div class="col-sm-5">
                        <input type="text" name="id_kk" hidden="true">
                         <input type="text" class="form-control" name="kelas">

                       </div>
                       <div class="col-sm-4">
                         <a class="btn btn-primary buat_kk" onclick="add_kk()">Simpan</a>
                       </div>

                     </div>

                     <div  class="form-group">
                       <label class="col-sm-1 control-label"></label>
                     </div>

                   </form>
                   <table class="daftar_kelompok_kelas table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kelompok Kelas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>

                    </tbody>
                  </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- MODAL TABEL STEP -->


          <div class="row">
            <div class="col-md-12 kirim_token">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Buat Cabang</h3> 
                </div>
                <div class="panel-body">
                  <form  class="panel panel-default form-horizontal form-bordered form-cabang"  method="post" >
                   <div  class="form-group">
                     <label class="col-sm-2 control-label">Nama Kota</label>
                     <div class="col-sm-3">
                       <!-- stkt = soal tingkat -->
                       <input type="text" class="form-control" name="kota">
                       <input type="hidden" class="form-control" name="id">
                     </div>
                     <label class="col-sm-2 control-label">Alamat</label>
                     <div class="col-sm-4">
                       <!-- stkt = soal tingkat -->
                       <textarea class="form-control" name="alamat"></textarea>
                     </div>
                     <label class="col-sm-2 control-label">Kode Cabang</label>
                     <div class="col-sm-2">
                       <!-- stkt = soal tingkat -->
                       <input type="text" class="form-control" name="kodecabang">
                     </div>
                   </div>

                   <div  class="form-group">
                     <label class="col-sm-1 control-label"></label>
                     <a class="btn btn-primary buat_cabang" onclick="add_cabang()">Simpan</a>
                   </div>



                 </form>
                 <div  class="form-group">
                  <table class="daftar_cabang table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Kota</th>
                        <th>Alamat</th>
                        <th>Kode Cabang</th>
                        <th>Aksi</th>


                      </tr>
                    </thead>

                    <tbody>

                    </tbody>
                  </table>
                  <hr>

                </div>

              </div>
            </div>
          </div>
          <script type="text/javascript">
          var dataTableCabang; 
          var 

          dataTableKelompokKelas
          $(document).ready(function(){

  // TABLE TOKEN
  dataTableCabang = $('.daftar_cabang').DataTable({
    "ajax": {
      "url": base_url+"cabang/ajax_data",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});

          function add_cabang () {
            metod = $('.buat_cabang').html();
            datas = $('.form-cabang').serialize();

            if (metod=='Simpan') {
              url = base_url+"cabang/insert_cabang_ajax";
            }else{
              url = base_url+"cabang/update_cabang_ajax";
            };

            $.ajax({
              url:url,
              data:datas,
              type:"POST",
              dataType:"TEXT",
              success:function(data){
                
                swal('Cabang Berhasil Di '+metod+'');
                dataTableCabang.ajax.reload(null,false);
                $('.buat_cabang').html('Simpan');
                $('.form-cabang')[0].reset();
              },error:function(){
                swal('Gagal '+metod+' Cabang');
              }
            });
           
          }

          function drop_cabang(data){
            url = base_url+"cabang/drop_cabang";
            swal({
              title: "Yakin akan hapus Cabang?",
              text: "Anda tidak dapat membatalkan ini.",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya,Tetap hapus!",
              closeOnConfirm: false
            },
            function(){
              var datas = {id:data};
              $.ajax({
                dataType:"text",
                data:datas,
                type:"POST",
                url:url,
                success:function(){
                  swal("Terhapus!", "Cabang berhasil dihapus.", "success");
                  dataTableCabang.ajax.reload(null,false)
                },
                error:function(){
                  sweetAlert("Oops...", "Data gagal terhapus!", "error");
                }

              });
            });
          }

          function add_kelas(data){
            var kelas ='.detail-'+data;
            var meta = $(kelas).data('id');

            $('.cabang-modal').modal('show');
            judul = " <h4 class='modal-title' style='display: inline'>Daftar Step : "+
            "<span class='text-info'>"+meta.namaCabang+"</h4>";

            $('.cabang-modal .modal-header').html(judul);
            $('input[name=idCabang]').val(meta.id);
            dataTableKelompokKelas = $('.daftar_kelompok_kelas').DataTable({
              "ajax": {
                "url": base_url+"kelompokkelas/ajax_data/"+meta.id,
                "type": "POST",
              },
              "emptyTable": "Tidak Ada Data Pesan",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "bDestroy": true,
              "pageLength": 3,

            });

          }
          function edit_cabang(data){
            var kelas ='.detail-'+data;
            var datas = $(kelas).data('id');
            $('input[name=kota]').val(datas.namaCabang);
            $('input[name=kodecabang]').val(datas.kodeCabang);
            $('textarea[name=alamat]').val(datas.alamat);
            $('input[name=id]').val(datas.id);

            $('.buat_cabang').html('Perbaharui');
          }

// KELOMPOK KELAS
function add_kk(){
  kelas = $('input[name=kelas]').val();
  id_kk = $('[name=id_kk]').val();
  metod = $('.buat_kk').html();
  if (kelas) {
    
    
    if (metod=='Simpan') {
      datas = {kk:kelas,cabang:$('input[name=idCabang]').val()};
      url = base_url+"kelompokkelas/insert_kelompokkelas_ajax";
    } else {
     
      datas = {kk:kelas,id_kk:id_kk};
      url = base_url+"kelompokkelas/update_kelompok_kelas";
    }
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Tersimpan!", "kelompok kelas berhasil disimpan.", "success");
        dataTableKelompokKelas.ajax.reload(null,false);
        $('.form-kelas')[0].reset();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal disimpan!", "error");
      }
    });
  }else{
    swal('Isi kelas terlebih dahulu!');
  }
}

function drop_kelas(data){
  url = base_url+"kelompokkelas/del_kelompok_kelas";
  swal({
    title: "Yakin akan hapus Kelas?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    var datas = {id:data};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Kelas berhasil dihapus.", "success");
        dataTableKelompokKelas.ajax.reload(null,false);
        $('.form-kelas')[0].reset();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }

    });
  });
}
function edit_kelas(data){
  $('.buat_kk').html('Perbaharui');
  var kelas = '.kelas-'+data;
  var datas = $(kelas).data('id');
  $name = $('[name=kelas]').val(datas.KelompokKelas);
  $id_kk = $('[name=id_kk]').val(datas.id_kk);
  
}
</script>