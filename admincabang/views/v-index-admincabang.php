<!DOCTYPE html>
<html class="backend">
<!-- START Head -->
<head>
 <!-- START META SECTION -->
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?=$judul_halaman;?></title>
 <meta name="author" content="pampersdry.info">
 <meta name="description" content="Adminre is a clean and flat backend and frontend theme build with twitter bootstrap 3.1.1">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

 <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('assets/image/touch/apple-touch-icon-144x144-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('assets/image/touch/apple-touch-icon-114x114-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/image/touch/apple-touch-icon-72x72-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/image/touch/apple-touch-icon-57x57-precomposed.png') ?>">
 <link rel="shortcut icon" href="<?= base_url('assets/image/favicon.ico') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
 <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
 <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">

 <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
 <script type="text/javascript" src="<?=base_url('assets/plugins/owl/js/owl.carousel.min.js');?>"></script>
 
 <script>var base_url = '<?php echo base_url() ?>';var halaman = false;</script>
 <!--/ END META SECTION -->

 

 <!-- START STYLESHEETS -->
 <!-- Plugins stylesheet : optional -->


 <!--/ Plugins stylesheet -->

 <!-- Application stylesheet : mandatory -->
 <link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/stylesheet/layout.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/stylesheet/uielement.min.css') ?>">
 <!--/ Application stylesheet -->
 <!-- END STYLESHEETS -->

 <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
 <script src="<?= base_url('assets//library/modernizr/js/modernizr.min.js') ?>"></script>
 <!--/ END JAVASCRIPT SECTION -->
</head>
<!--/ END Head -->

<!-- START Body -->
<body>


  <!-- PERMODALAN -->
  <!-- Start Modal salah upload gambar -->
  <div class="modal fade" id="filter_tryout_pencarian_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title text-center text-info">Silahkan PIlih Cabang, tryout dan paket</h2>
        </div>
        <div class="modal-body">
          <h3 class="text-center">Filter</h3>

          <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/admincabang/laporanpaket" method="post" >

            <div  class="form-group">
              <label class="col-sm-3 control-label">Cabang</label>
              <div class="col-sm-8">

               <select class="form-control" name="select_cabang">
                <option value="all">Semua Cabang</option>
                <?php foreach ($cabang as $item): ?>
                  <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Tryout</label>
            <div class="col-sm-8">

              <select class="form-control" name="to">
                <option value="all">Semua Tryout</option>
                <?php foreach ($to as $item): ?>
                  <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Paket</label>
            <div class="col-sm-8">

             <select class="form-control col-sm-6" name="paket">
              <option value="all">Semua paket</option>

            </select>
          </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default">cari</button>
      </div>
    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- PERMODALAN -->



<!-- START Template Header -->
<header id="header" class="navbar navbar-fixed-top">
  <!-- START navbar header -->
  <div class="navbar-header">
   <!-- Brand -->
   <a class="navbar-brand" href="javascript:void(0);">
    <span class="logo-figure"></span>
    <span class="logo-text"></span>
  </a>
  <!--/ Brand -->
</div>
<!--/ END navbar header -->

<!-- START Toolbar -->
<div class="navbar-toolbar clearfix">
 <!-- START Left nav -->
 <ul class="nav navbar-nav navbar-left">
  <!-- Sidebar shrink -->
  <li class="hidden-xs hidden-sm">
   <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar">
    <span class="meta">
     <span class="icon"></span>
   </span>
 </a>
</li>
<!--/ Sidebar shrink -->

<!-- Offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
<li class="navbar-main hidden-lg hidden-md hidden-sm">
 <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
  <span class="meta">
   <span class="icon"><i class="ico-paragraph-justify3"></i></span>
 </span>
</a>
</li>
<!--/ Offcanvas left -->

</ul>
<!--/ END Left nav -->

<!-- START navbar form -->
<div class="navbar-form navbar-left dropdown" id="dropdown-form">
  <form action="" role="search">
   <div class="has-icon">
    <input type="text" class="form-control" placeholder="Search application...">
    <i class="ico-search form-control-icon"></i>
  </div>
</form>
</div>
<!-- START navbar form -->

<!-- START Right nav -->
<ul class="nav navbar-nav navbar-right">
  <!-- Profile dropdown -->
  <li class="dropdown profile">
   <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
    <span class="meta">
     <span class="avatar"></span>
     <span class="text hidden-xs hidden-sm pl5"><?=$this->session->userdata['USERNAME'];?></span>
     <span class="caret"></span>
   </span>
 </a>
 <ul class="dropdown-menu" role="menu">
  <li><a href="javascript:void(0);"><span class="icon"><i class="ico-user-plus2"></i></span> My Accounts</a></li>
  <li><a href="javascript:void(0);" onclick="show_f_updt_pswd()"><span class="icon"><i class="ico-cog4"></i></span>Ubah Katasandi</a></li>
  <li><a href="javascript:void(0);"><span class="icon"><i class="ico-question"></i></span> Help</a></li>
  <li class="divider"></li>
  <li><a href="<?=base_url('index.php/logout');?>"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
</ul>
</li>
<!-- Profile dropdown -->


</ul>
<!--/ END Right nav -->
</div>
<!--/ END Toolbar -->
</header>
<!--/ END Template Header -->

<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
  <!-- START Sidebar Content -->
  <section class="content slimscroll">
   <h5 class="heading">Main Menu</h5>
   <!-- START MENU -->
   <ul class="topmenu topmenu-responsive" data-toggle="menu">
    <li >
     <a href="<?= base_url('index.php/admincabang') ?>">
      <span class="figure"><i class="ico-trophy"></i></span>
      <span class="text">Dashboard</span>
    </a>
  </li>
</li>


<li>
 <a href="javascript:void(0);" data-target="#laporantryout" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard"></i></span>
  <span class="text">Laporan Try Out </span>
  <span class="arrow"></span>
</a>

<ul id="laporantryout" class="submenu collapse ">
  <li class="submenu-header ellipsis">Laporan Try Out</li>

  <li>
   <a href="<?= base_url('index.php/admincabang/laporanpaket');?>">
    <span class="text">Laporan Paket (Semua)</span>
  </a>
</li>

<!-- <li >
 <a onclick="show_filter_tryout()" style="cursor: hand">
  <span class="text">Laporan Paket (Filter)</span>
</a>
</li> -->

<li >
 <a href="<?= base_url('index.php/admincabang/infograph');?>">
  <span class="text">Infografics Tryout</span>
</a>
</li>

<li >
 <a href="<?= base_url('index.php/admincabang/pengerjaan');?>">
  <span class="text">Status Pengerjaan</span>
</a>
</li>
</ul>
</li>
<!-- menu tambahan -->
  <li>
 <a href="javascript:void(0);" data-target="#laporanortu" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard"></i></span>
  <span class="text">Laporan Orang Tua </span>
  <span class="arrow"></span>
</a>

<ul id="laporanortu" class="submenu collapse ">
  <li class="submenu-header ellipsis">Laporan Orang Tua</li>

<li >
 <a href="<?= base_url('index.php/laporanortu/');?>">
  <span class="text">List laporan Orang Tua</span>
</a>
</li>

<li >
 <a href="<?= base_url('index.php/laporanortu/addlaporan');?>">
  <span class="text">Kirim Laporan</span>
</a>
</li>
</ul>
</li>



</ul>
<!-- menu tambahan -->
</ul>
<!--/ END Template Navigation/Menu -->
</section>
<!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left) -->

<!-- START Template Main -->
<section id="main" role="main">
  <!-- START Template Container -->
  <div class="container-fluid">
   <!-- Page Header -->
   <div class="page-header page-header-block">
    <div class="page-header-section">
     <h4 class="title semibold"><?=$judul_halaman;?></h4>
   </div>

 </div>

 <?php
 foreach ($files as $file) {
  include $file;
}
?>

<!-- Page Header -->
</div>
<!--/ END Template Container -->

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->
<!-- MODAL Form Ubah katasandi -->
<div class="modal fade" id="m-udt_pswd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center">Ubah Katsandi</h2>
      </div>
      <div class="">
       <form class="modal-body form-horizontal" action="javascript:void:(0)" id="form_updt_pswd">
         <div class="form-group" id="old_pswd">
          <label class="col-sm-3 control-label">Katasandi Lama</label>
          <div class="col-sm-9" >
            <input type="password" class="form-control" name="old_pswd">
              <span class="text-danger" hidden="true" id="wr_pswd">*Katasandi Salah!</span>
          </div>

        </div>
         <div class="form-group" id="new_pswd">
          <label class="col-sm-3 control-label">Katasandi Baru</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" name="new_pswd">
            <span class="text-danger" hidden="true" id="wr_ln_pswd">*Katasandi minimal 8 karakter!</span>
          </div>
        </div>
        <div class="form-group" id="konfirm_pswd">
          <label class="col-sm-3 control-label">Ulangi Katasanadi</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" name="konfirm_pswd">
          </div>
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="javascript:void(0)" type="button" class="btn btn-primary" disabled id="save_pswd">Simpan</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</section>
<!--/ END Template Main -->

<script>
  $(document).ready(function(){
    // event
    $("input[name=konfirm_pswd]").on('keyup',function(e){
      var new_pswd=$("input[name=new_pswd]").val();
      var konfirm_pswd=$("input[name=konfirm_pswd]").val();
        if (new_pswd==konfirm_pswd) {
          $("#konfirm_pswd").removeClass("has-error");
          $("#konfirm_pswd").addClass("has-success");
          $("#save_pswd").attr("disabled",false);
        } else {
          $("#konfirm_pswd").removeClass("has-success");
          $("#konfirm_pswd").addClass("has-error");
          $("#save_pswd").attr("disabled",true);

        }
      });
    $("input[name=new_pswd]").on('keyup',function(e){
      var pass = $("input[name=new_pswd]").val();
      var lengthCahar=pass.length;
       $("input[name=konfirm_pswd]").val('');
       $("#konfirm_pswd").removeClass("has-success");
       $("#konfirm_pswd").removeClass("has-error");
       $("#save_pswd").attr("disabled",true);
      if (lengthCahar>7) {
       $("#new_pswd").removeClass("has-error");
       $("#new_pswd").addClass("has-success");
        $("#wr_ln_pswd").attr("hidden",true);
     } else {
      $("#new_pswd").removeClass("has-success");
      $("#new_pswd").addClass("has-error");
        $("#wr_ln_pswd").removeAttr("hidden");
      }
    });
    $("#save_pswd").click(function(){
      var old_pswd=$("input[name=old_pswd]").val();
      var new_pswd=$("input[name=new_pswd]").val();
      var url_post=base_url+"admincabang/cek_katasandi";
      console.log(url_post);
      $.ajax({
        url:url_post,
        data:{old_pswd:old_pswd,new_pswd:new_pswd},
        type:"post",
        dataType:"text",
        success:function (Data) {
          console.log(Data);
          var ob_Data=JSON.parse(Data);
          if (ob_Data==true) {
            swal("Success","Katasandi berhasil diubah","success");
            reset_form();
          } else {
            $("#old_pswd").addClass("has-error");
            $("#wr_pswd").removeAttr("hidden");
          }
        },
        });
     });
    // Event 
  });
  function reset_form() {
   $("#form_updt_pswd")[0].reset();
   $("#old_pswd").removeClass("has-error");
   $("#wr_pswd").attr("hidden",true);
    $("#new_pswd").removeClass("has-success");
   $("#konfirm_pswd").removeClass("has-success");
     $("#m-udt_pswd").modal("hide");

  }
  function show_filter_tryout(){
    $('#filter_tryout_pencarian_modal').modal('show');
  }

  $('select[name=select_cabang]').change(function(){
    // console.log(this.val);
  });

  // TO KETIKA DI CHANGE
  $('select[name=to]').change(function(){
    load_paket_modal($(this).val())
  });
//ketika paket di change

function load_paket_modal(id_to){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>admincabang/get_paket/"+id_to,
  success: function(data){
   $('select[name=paket]').html('<option value="all">-- Pilih Paket  --</option>');
   $.each(data, function(i, data){
    $('select[name=paket]').append("<option value="+data.id_paket+">"+data.nm_paket+"</option>");
  });
 }
});
}
// menampilkan form modal ubah pswd
function show_f_updt_pswd() {
  $("#m-udt_pswd").modal("show");
 
}

</script>

<!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
<!-- Library script : mandatory -->
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery-migrate.min.j') ?>s"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js') ?>"></script>
<!--/ Library script -->

<!-- App and page level script -->
<script type="text/javascript" src="<?= base_url('assets/plugins/sparkline/js/jquery.sparkline.min.js') ?>"></script><!-- will be use globaly as a summary on sidebar menu -->
<script type="text/javascript" src="<?= base_url('assets/javascript/app.min.js') ?>"></script>

<!--datatable-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
<!--<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/zeroclipboard.js') ?>"></script>-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

<!-- Cometchat -->
<link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
<!--/ App and page level script -->
<!--/ END JAVASCRIPT SECTION -->
</body>
<!--/ END Body -->
</html>