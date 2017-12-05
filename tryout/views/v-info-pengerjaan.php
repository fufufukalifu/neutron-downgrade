<br>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <!-- panel body -->
        <div class="panel-body">
          <h2 class="text-center pb-30"><b>Selamat Datang di Try Out Online Neon</b></h2> <br>
          <div class="row">
            <div class="col-sm-12">
              <p>Nama Paket : <?=$paket['nm_paket'];?> <br>
              Jumlah Soal : <?=$paket['jumlah_soal'];?> <br>
              Durasi  : <?=$paket['durasi'];?> Menit</p>
            </div>
          </div>
          <hr><br>
          <p class="mt-10"><b>Sebelum Memulai Tes Perhatikan</b></p>
          <p>1. OS Minimal <br>
              2. Browser <br>
              3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <a class="modal-on" data-todo='<?=json_encode($paket)?>'></a>
          <a class="col-sm-12 btn btn-success" onclick="kerjakan_paket()">Mulai Try Out</a> <br>
          <div class="clearfix"></div>
        </div>
        <!-- end panel body -->
      </div>
   </div>
  </div>
</div>

<script>
  //MULAI TRYOUT
  function kerjakan_paket(){  
    var kelas = ".modal-on";
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatto";

    var global_properties = {
      id_paket: data_to.id_paket,
      id_tryout: data_to.id_tryout,
      id_mm_tryoutpaket: data_to.mmid
    };

    $.ajax({
      url : url,
      type: "POST",
      data: global_properties,
      dataType: "TEXT",
      success: function(data){
       window.location.href = base_url + "index.php/tryout/mulaitest";
     },error: function (jqXHR, textStatus, errorThrown,data){
        // console.log(data);
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }
    });
  }
</script>