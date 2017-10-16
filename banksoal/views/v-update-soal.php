<!-- Start pengecekan jika pilihan 5 atau 4 pilihan -->
<?php 

if (!isset($piljawaban['0']['id_pilihan'])) {
 $piljawaban['0']['id_pilihan']="";
 $piljawaban['0']['jawaban']="";
 $piljawaban['0']['gambar']="";
}
if ( !isset($piljawaban['1']['id_pilihan'])) {
  $piljawaban['1']['id_pilihan']="";
  $piljawaban['1']['jawaban']="";
  $piljawaban['1']['gambar']="";
}
if (!isset($piljawaban['2']['id_pilihan'])) {

  $piljawaban['2']['id_pilihan']="";
  $piljawaban['2']['jawaban']="";
  $piljawaban['2']['gambar']="";
}
if (  !isset($piljawaban['3']['id_pilihan'])) {
  $piljawaban['3']['id_pilihan']="";
  $piljawaban['3']['jawaban']="";
  $piljawaban['3']['gambar']="";  
}
if (!isset($piljawaban['4']['id_pilihan'])) {
  $piljawaban['4']['id_pilihan']="";
  $piljawaban['4']['jawaban']="";
  $piljawaban['4']['gambar']="";
}
?>
<!-- Strat Script Matjax -->
<script type="text/x-mathjax-config">
 MathJax.Hub.Config({
 showProcessingMessages: false,
 tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
});
</script>
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>
<script>
  var Preview = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview");
    this.buffer = document.getElementById("MathBuffer");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
      this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("MathInput").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
       ["Typeset",MathJax.Hub,this.buffer],
       ["PreviewDone",this]
       );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview.callback = MathJax.Callback(["CreatePreview",Preview]);
Preview.callback.autoReset = true;  // make sure it can run more than once

</script>
<script>
var Preview2 = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview2");
    this.buffer = document.getElementById("MathBuffer2");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview2.timeout = null;
    if (this.mjPending) return;
        var text = CKEDITOR.instances.editor1.getData();
    // console.log(text);
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview2.callback = MathJax.Callback(["CreatePreview",Preview2]);
Preview2.callback.autoReset = true;  // make sure it can run more than once

</script>
<!-- END Script Matjax -->
<!-- ENND pengecekan jika pilihan 5 atau 4 pilihan -->
<!-- START Template Main -->
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
<!-- ENND pengecekan jika pilihan 5 atau 4 pilihan -->
<!-- START Template Main -->
<section id="main" role="main">
  <!-- START Template Container -->
  <script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

  <div class="container-fluid">
     <?php $UUID=$banksoal['UUID']?>
     <!-- MODAL EDITOR -->
<div class="modal fade" id="m-editor" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger"></h2>
      </div>
      <div class="modal-body">
        <textarea class="editor1 " name="m_editor" id="editor3" cols="60" rows="10"  ></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="javascript:void(0)" type="button" class="btn btn-default" onclick="send_val()">OK</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL EDITOR -->
    <!-- Start Modal salah upload gambar -->
    <div class="modal fade" id="warningupload" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek type extension gambar! </h3>
            <h5 class="text-center">Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png"</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start Modal salah upload size img -->
    <div class="modal fade" id="e_size_img" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek file size Gambar!</h3>
            <h5 class="text-center">File size audio maksimal 100kb</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start Modal salah upload video -->
    <div class="modal fade" id="warningupload2" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek type extension video!</h3>
            <h5 class="text-center">Type yang bisa di upload hanya .mp4</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start Modal salah upload size video -->
    <div class="modal fade" id="e_size_video" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek file size video!</h3>
            <h5 class="text-center">File size video maksimal 90Mb</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start Modal salah upload audio -->
    <div class="modal fade" id="warning-upload-audio" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek type extension Audio!</h3>
            <h5 class="text-center">Type yang bisa di upload hanya .mp3</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start Modal salah upload size audio -->
    <div class="modal fade" id="e_size_audio" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Silahkan cek file size Audio!</h3>
            <h5 class="text-center">File size audio maksimal 50Mb</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- preview Soal-->
    <div class="modal fade " id="modalpreview" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" style="width:60%; ">
       <!-- Start Panel preview -->
       <div class="panel panel-teal">
        <!-- Start heading -->
        <div class="panel-heading ">
          <div class="panel-toolbar">
           <h4 class="modal-title ">preview Soal</h4>
         </div>
         <div class="panel-toolbar text-right">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
       </div>
       <!-- End heading -->
       <!-- Start body preview -->
       <div class="panel-body ">
       <div  class="hidden-audio" >
          <audio class="col-sm-12" id="prevAudio" src="<?=base_url();?>assets/audio/soal/<?=$banksoal['audio'];?>" type="audio/mpeg" controls >
          </audio>
       </div>
       <hr>
        <label class="ml10">Sumber :</label> <a id="prevSumber"  ></a> <br>
          <label class="ml10">judul  :</label> <a id="prevJudul" ></a> <br>
          <label class="ml10">Soal   : </label>
          <div class="panel row ml10 mr10 mt5 mb2 pt5">
            <!-- img -->
            <div class="col-sm-12 pt5">
              <div class="text-center" >
                <img id="previewSoal2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/soal/<?=$banksoal['gambar_soal'];?>" alt="" />
              </div>
            </div>
            <!-- img -->
            <div class=" prevSoal col-sm-12 mt10">
              <div class="a" id="MathPreview2" ></div>
              <div class="a" id="MathBuffer2" style=" 
              visibility:hidden; position:absolute; top:0; left: 0"></div>
            </div>
          </div>
          <!-- pilihan jawaban -->
          <div class="col-sm-12" >
            <!-- preview pilihan jawaban TEXT -->
            <!-- pp_text= preview pilihan text -->
            <ol type="A" id="pp_text">
              <li class="panel pl10 plr10 pt10 pb10" id="a"></li>
              <li class="panel pl10 plr10 pt10 pb10" id="b"></li>
              <li class="panel pl10 plr10 pt10 pb10" id="c"></li>
              <li class="panel pl10 plr10 pt10 pb10" id="d"></li>
              <li class="panel pl10 plr10 pt10 pb10" id="e"></li>
            </ol>
            <!-- / preview pilihan jawaban TEXT -->
            <!-- preview pilihan jawaban Gambar -->
            <!-- pp_text= preview pilihan img/gambar -->
            <div class="row" id="pp_img">
              <div class="col-sm-4">
                <ol type="A" >
                  <li class=" pl10 pt10 pb10">
                    <img id="previewA2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['0']['gambar'];?>" alt="" width="" />
                  </li>
                  <li class=" pl10 pt10 pb10">
                    <img id="previewB2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['1']['gambar'];?>" alt="" width="" />
                  </li>
                </ol>
              </div>
              <div class="col-sm-4">
                <ol type="A" start="3">
                  <li class=" pl10 pt10 pb10">
                    <img id="previewC2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['2']['gambar'];?>" alt="" width="" />
                  </li>
                  <li class=" pl10 pt10 pb10">
                    <img id="previewD2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['3']['gambar'];?>" alt="" width="" />
                  </li>
                </ol>
              </div>
              <div class="col-sm-4">
                <ol type="A" start="5">
                  <li class="pl10 pt10 pb10">
                    <img id="previewE2" style="max-width: 200px; max-height: 125px;  " class="img-thumbnail" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['4']['gambar'];?>" alt="" width="" />
                  </li>
                </ol>
              </div>
            </div>
            <!-- preview pilihan jawaban Gambar -->
          </div>

          <!-- jawaban -->
          <div class="col-sm-12"> 
            <hr>
            <label>Jawaban : </label> <a id="prevJawaban"></a>
          </div>
        </div>
        <!-- END body preview -->
        <!-- Start footer preview -->
        <div class="panel-footer hidden-xs">
          <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Keluar</button>
     </div>
     <!-- end footer preview -->

   </div>
   <!-- END panel preview -->

 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END Priew -->
<!-- START row -->
<div class="row">
  <div class="col-md-12">
    <!-- Form horizontal layout bordered -->
    <form class="form-horizontal form-bordered panel panel-teal edit-form" action="<?=base_url()?>index.php/banksoal/updatebanksoal" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
      <div class="panel-heading">
        <h3 class="panel-title">Form Update Soal </h3>
        <!-- untuk menampung bab id -->
        <input type="text" name="subBabID" value="<?=$subBabID;?>"  hidden="true">
        <input type="text" name="soalID" value="<?=$banksoal['id_soal'];?>" hidden="true">
        <input type="text" name="UUID" value="<?=$banksoal['UUID'];?>"  hidden="true">
        <!-- Start old info data soal -->
        <input type="text" id="oldtkt" value="<?=$infosoal['id_tingkat'];?>" hidden="true">
        <input type="text"  id="oldmp"  value="<?=$infosoal['id_mp'];?>" hidden="true">
        <input type="text" id="oldbab"  value="<?=$infosoal['id_bab'];?>" hidden="true">
        <input type="text" id="oldsub"  value="<?=$infosoal['id_subbab'];?>" hidden="true">
        <!-- END old info data soal -->
        <!-- Untuk menampung page -->
        <input type="text" name="page" value="<?=$page?>" hidden="true">
        <!--  -->
      </div>               
      <div class="panel-body">
       <!-- Start Dropd Down depeden -->

       <div  class="form-group " >
        <label class="col-sm-1 control-label">Tingkat</label>
        <div class="col-sm-4">
          <select class="form-control" name="tingkat" id="tingkat">
            <option>-Pilih Tingkat-</option>
          </select>
        </div>
        <label class="col-sm-2 control-label">Mata Pelajaran</label>
        <div class="col-sm-4">
          <select class="form-control" name="mataPelajaran" id="pelajaran">

          </select>
        </div>
      </div>

      <div class="form-group jenissoal">
        <label class="col-sm-1 control-label">Bab</label>
        <div class="col-sm-4">
          <select class="form-control" name="bab" id="bab">

          </select>
        </div>

        <label class="col-sm-2 control-label">Subab</label>
        <div class="col-sm-4">
         <select class="form-control" name="subBabID" id="subbab">

         </select>
         <span class="text-danger"><?php echo form_error('subBab'); ?></span>
       </div>
     </div>

     <!-- END Drop Down depeden -->
     <div class="form-group">
      <label class="control-label col-sm-2">Judul Soal</label>
      <div class="col-sm-8">
        <input type="text" name="judul" value="<?=$banksoal['judul_soal'];?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Kesulitan</label>
      <div class="col-sm-8">
        <input type="text" name="tampkesulitan" value="<?=$banksoal['kesulitan'];?>" id='tampkesulitan' hidden="true">
        <select name="kesulitan" class="form-control">
          <option value="">--Silahkan Pilih Tingkat Kesulitan--</option>
          <option value="1" id="lvl1">Mudah</option>
          <option value="2" id="lvl2">Sedang</option>
          <option value="3" id="lvl3">Sulit</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Sumber</label>
      <div class="col-sm-8">
        <input type="text" name="sumber" value="<?=$banksoal['sumber'];?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Audio</label>
      <div class="col-sm-8">
        <div class="col-sm-12 hidden-audio " hidden="true"> 
          <div class="col-md-5 left"> 
            <h6>Name: <span id="filenameAudio"></span></h6> 
          </div> 
          <div class="col-md-4 left"> 
            <h6>Size: <span id="filesizeAudio"></span>Kb</h6> 
          </div> 
          <div class="col-md-3 bottom"> 
            <h6>Type: <span id="filetypeAudio"></span></h6> 
          </div>
        </div>
        <div class="col-sm-12 hidden-audio" >
          <audio class="col-sm-12" id="previewAudio" src="<?=base_url();?>assets/audio/soal/<?=$banksoal['audio'];?>" type="audio/mpeg" controls >
          </audio>
        </div>
        <div class="col-sm-6 mt10">
          <label for="fileAudio" class="btn btn-sm btn-default">
            Pilih Audio
          </label>
          <input  id="fileAudio" style="display:none;" type="file" name="listening" onchange="ValidateAudioInput(this);">
          <label class="btn btn-sm btn-danger"  onclick='restAudioSoal("<?=$UUID?>")'>Reset</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Gambar Soal</label>
      <div class="col-sm-8 " >
        <div class="col-sm-12">
         <img id="previewSoal" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/soal/<?=$banksoal['gambar_soal'];?>" alt="" />
       </div>

       <div class="col-sm-12">
        <div class="col-md-5 left"> 
          <h6>Name: <span id="filenameSoal"></span></h6> 
        </div> 
        <div class="col-md-4 left"> 
          <h6>Size: <span id="filesizeSoal"></span>Kb</h6> 
        </div> 
        <div class="col-md-3 bottom"> 
          <h6>Type: <span id="filetypeSoal"></span></h6> 
        </div>
      </div>

      <div class="col-sm-12">
        <label for="fileSoal" class="btn btn-sm btn-default">
          Pilih Gambar
        </label>
        <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
        <label class="btn btn-sm btn-danger"  onclick='restImgSoal("<?=$UUID?>")'>Reset</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Jenis Editor</label>
    <div class="col-sm-8">
      <div class="btn-group" data-toggle="buttons" >
        <label class="btn btn-teal btn-outline active " id="in-soal">
          <input type="radio" name="options"  autocomplete="off" checked="true"> Input Soal
        </label>
        <label class="btn btn-teal btn-outline" id="pr-rumus">
          <input type="radio" name="options"   autocomplete="off"> Rumus Matematika
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
   <!-- Start Editor Soal -->
   <div id="editor-soal">
    <label class="control-label col-sm-2">Soal</label>
    <div class="col-sm-10">

     <textarea  name="editor1" class="form-control" id=""><?=$banksoal['soal'];?></textarea>

   </div>
 </div>
 <!-- End Editor Soal -->
 <!-- Start Math jax -->
 <div id="editor-rumus" hidden="true">
  <label class="control-label col-sm-2">Buat rumus </label>
  <div class="col-sm-10">

   <textarea class="form-control" id="MathInput" cols="60" rows="10" onkeyup="Preview.Update()" ></textarea>

 </div>
 <label class="control-label col-sm-2"></label>
 <div class="col-sm-10">
   <p>
     Configured delimiters:
     <ul>
       <li>TeX, inline mode: <code>\(...\)</code> or <code>$...$</code></li>
       <li>TeX, display mode: <code>\[...\]</code> or <code> $$...$$</code></li>
       <li>Asciimath: <code>`...`</code>.</li>
     </ul>
   </p>
 </div>

 <label class="control-label col-sm-2"></label>
 <div class="col-sm-10">
  <label class="control-label" >Preview is shown here:</label>
  <div class="form-control" id="MathPreview" ></div>
  <div class="form-control" id="MathBuffer" style=" 
  visibility:hidden; position:absolute; top:0; left: 0"></div>
</div>
</div>
<script>
  Preview.Init();
</script>
<script>
  Preview2.Init();
</script>
<!-- End MathJax -->
</div>
<div class="form-group">
  <label class="control-label col-sm-2">Jumlah Pilihan</label>
  <div class="col-sm-8">
    <div class="btn-group" data-toggle="buttons" >
      <label class="btn btn-teal btn-outline " id="empatpil">
        <input type="radio" name="opjumlah" value="4" autocomplete="off" id="radio4"> 4 Pilihan
      </label>
      <label class="btn btn-teal btn-outline" id="limapil">
        <input type="radio" name="opjumlah"  value="5" autocomplete="off" id="radio5"> 5 Pilihan
      </label>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">Jenis Pilihan</label>
  <div class="col-sm-8">
    <div class="btn-group" data-toggle="buttons" >
      <label class="btn btn-teal btn-outline active " id="text">
        <input type="radio" name="options" value="text" autocomplete="off" checked="true"> Text
      </label>
      <label class="btn btn-teal btn-outline" id="gambar">
        <input type="radio" name="options"  value="gambar" autocomplete="off"> Gambar
      </label>
    </div>
  </div>
</div>
<!-- Start input jawaban A -->
<div class="form-group">
  <label class="control-label col-sm-2">
    <a href="javascript:void(0);" type="button" class="btn btn-sm btn-inverse btn-pilihan" data-toggle="tooltip" data-placement="top" title="Klik" onclick="my_editor('Pilihan Jawaban A')" >Pilihan A</a>
  </label>
  <!-- Start input text A -->
  <div class="col-sm-8 piltext">
    <textarea name="a"  class="form-control hide" > <?=$piljawaban['0']['jawaban'];?></textarea>
     <div  class="panel pl10 pt10 pr10 pb10 mb0" id="view-a" style="background:#F1EEEE; min-height: 40px;" data-toggle="tooltip" data-placement="top" title="Klik Pilihan A">
       <?=$piljawaban['0']['jawaban'];?>
     </div>
  </div>
  <!-- END input text A -->
  <!-- Start input gambar A -->
  <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewA" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['0']['gambar'];?>" alt="" />
   </div>

   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameA"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeA"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeA"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileA" class="btn btn-sm btn-default ">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileA" value="<?=$piljawaban['0']['gambar'];?>" name="gambar1" onchange="ValidateSingleInput(this);"/>
     <label class="btn btn-sm btn-danger"  onclick='restImgPilihan("<?=$UUID?>","A")'>Reset</label>
  </div>
</div>
<!-- END input Gambar A -->
</div>
<!-- END input jawaban A -->

<!-- Start input jawaban B -->
<div class="form-group">
  <label class="control-label col-sm-2">
    <a href="javascript:void(0);" class="btn btn-sm btn-inverse btn-pilihan" data-toggle="tooltip" data-placement="top" title="Klik" onclick="my_editor('Pilihan Jawaban B')">Pilihan B</a>
  </label>
  <!-- Start input text B -->
  <div class="col-sm-8 piltext">
    <textarea name="b" class="form-control hide"> <?=$piljawaban['1']['jawaban'];?></textarea>
      <div class="panel pl10 pt10 pr10 pb10 mb0" style="background:#F1EEEE; min-height: 40px;" id="view-b" data-toggle="tooltip" data-placement="top" title="Klik Pilihan B">
       <?=$piljawaban['1']['jawaban'];?>
     </div>
  </div>
  <!-- END input text B -->
  <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewB" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['1']['gambar'];?>" alt="" width="" />
   </div>

   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameB"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeB"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeB"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileB" class="btn btn-sm btn-default ">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileB" value="<?=$piljawaban['1']['gambar'];?>" name="gambar2" onchange="ValidateSingleInput(this);"/>
    <label class="btn btn-sm btn-danger"  onclick='restImgPilihan("<?=$UUID?>","B")'>Reset</label>
  </div>
</div>
</div>
<!-- END input jawaban  -->

<!-- Start input jawaban C -->
<div class="form-group">
  <label class="control-label col-sm-2">
    <a href="javascript:void(0);" class="btn btn-sm btn-inverse btn-pilihan" onclick="my_editor('Pilihan Jawaban C')" data-toggle="tooltip" data-placement="top" title="Klik">Pilihan C</a>
  </label>
  <!-- Start input text C -->
  <div class="col-sm-8 piltext" >
    <textarea name="c" class="form-control hide"> <?=$piljawaban['2']['jawaban'];?></textarea>
     <div   class="panel pl10 pt10 pr10 pb10 mb0" style="background:#F1EEEE; min-height: 40px;" id="view-c" data-toggle="tooltip" data-placement="top" title="Klik Pilihan C">
       <?=$piljawaban['2']['jawaban'];?>
     </div>
  </div>
  <!-- END input text C -->
  <!-- Start input gambar C -->
  <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewC" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['2']['gambar'];?>" alt="" width="" />
   </div>

   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameC"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeC"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeC"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileC" class="btn btn-sm btn-default">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileC" value="<?=$piljawaban['2']['gambar'];?>" name="gambar3" onchange="ValidateSingleInput(this);"/>
    <label class="btn btn-sm btn-danger"  onclick='restImgPilihan("<?=$UUID?>","C")'>Reset</label>
  </div>
</div>
<!-- END input Gambar C -->                       
</div>
<!-- END input Jawaban C -->

<!-- Start input jawaban D -->
<div class="form-group">
  <label class="control-label col-sm-2">
    <a href="javascript:void(0);" class="btn btn-sm btn-inverse btn-pilihan" onclick="my_editor('Pilihan Jawaban D')" data-toggle="tooltip" data-placement="top" title="Klik">Pilihan D</a>
  </label>
  <!-- Start input text D -->
  <div class="col-sm-8 piltext" >
    <textarea name="d" class="form-control hide"> <?=$piljawaban['3']['jawaban'];?></textarea>
     <div   class="panel pl10 pt10 pr10 pb10 mb0" style="background:#F1EEEE; min-height: 40px;" id="view-d" data-toggle="tooltip" data-placement="top" title="Klik Pilihan D">
       <?=$piljawaban['3']['jawaban'];?>
     </div>
  </div>
  <!-- END input text D -->
  <!-- Start input gambar D -->
  <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewD" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['3']['gambar'];?>" alt="" width="" />
   </div>

   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameD"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeD"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeD"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileD" class="btn btn-sm btn-default ">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileD" value="<?=$piljawaban['3']['gambar'];?>" name="gambar4" onchange="ValidateSingleInput(this);"/>
    <label class="btn btn-sm btn-danger"  onclick='restImgPilihan("<?=$UUID?>","D")'>Reset</label>
  </div>
</div>
<!-- END input Gambar D -->                       
</div>
<!-- END input Jawaban D -->

<!-- Start input jawaban E -->
<div class="form-group" id="pilihan">
  <label class="control-label col-sm-2">
    <a href="javascript:void(0);" class="btn btn-sm btn-inverse btn-pilihan" onclick="my_editor('Pilihan Jawaban E')" data-toggle="tooltip" data-placement="top" title="Klik">Pilihan E</a>
  </label>
  <!-- Start input text E -->
  <div class="col-sm-8 piltext" >
    <textarea name="e" class="form-control hide"> <?=$piljawaban['4']['jawaban'];?></textarea>
     <div   class="panel pl10 pt10 pr10 pb10 mb0" style="background:#F1EEEE; min-height: 40px;" id="view-e" data-toggle="tooltip" data-placement="top" title="Silahkan Klik Pilihan E">
       <?=$piljawaban['4']['jawaban'];?>
     </div>
  </div>
  <!-- END input text E -->
  <!-- Start input gambar E -->
  <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewE" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/jawaban/<?=$piljawaban['4']['gambar'];?>" alt="" width="" />
   </div>

   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameE"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeE"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeE"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileE" class="btn btn-sm btn-default">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileE"  value="<?=$piljawaban['4']['gambar'];?>" name="gambar5" onchange="ValidateSingleInput(this);"/>
    <label class="btn btn-sm btn-danger"  onclick='restImgPilihan("<?=$UUID?>","E")'>Reset</label>
  </div>
</div>
<!-- END input Gambar C -->                       
</div>
<!-- END input Jawaban E -->

<div class="form-group">
  <label class="control-label col-sm-2">Jawaban Benar</label>
  <div class="col-sm-8">
    <input type="text" id="tampjawaban" value="<?=$banksoal['jawaban'];?>" hidden="true"> 
    <select name="jawaban" class="form-control" id="opjawaban">
     <option value="">--Silahkan Pilih Jawaban Benar--</option>
     <option value="A" >A</option>
     <option value="B" >B</option>
     <option value="C" >C</option>
     <option value="D" >D</option>
     <option value="E" id="pilihanop">E</option>
   </select>
 </div>
</div>
<div class="form-group">
  <div class="col-sm-1 col-sm-offset-4">
    <div class="checkbox custom-checkbox">  
      <input type="text" id="tamppublish" value="<?=$banksoal['publish'];?>" hidden="true">
      <input type="checkbox" name="publish" id="gift" value="1">  
      <label for="gift"> Publish?</label>   
    </div>
  </div>
  <div class="col-sm-4 col-sm-offset-1">
    <div class="checkbox custom-checkbox">
      <input type="text" id="tamprandom" value="<?=$banksoal['random'];?>" hidden="true">  
      <input type="checkbox" name="random" id="idrand" value="1">  
      <label for="idrand">Random?</label>   
    </div>
  </div>
</div>
<!-- Start button show hide pembahasan -->
<div class="form-group">
 <label class="control-label col-sm-2">Form Pembahasan</label>

 <div class="col-sm-8">
  <div class="btn-group" data-toggle="buttons" >

    <label class="btn btn-inverse btn-outline " id="show-pembahasan">

      <input type="radio" name="oppembahasan" value="4" autocomplete="off" > <i class=" ico-file6"></i> Tampil Form Pembahasan

    </label>

    <label class="btn btn-inverse btn-outline active" id="hide-pembahasan">

      <input type="radio" name="oppembahasan"  value="5" autocomplete="off" checked="true"> <i class="ico-file-remove"></i> Hide

    </label>

  </div>
</div>
</div>
<!-- END button show hide pembahasan -->

<!-- Start Form Pembahsan -->
<div class="form-group pembahasan" hidden="
true">
<!-- Start Penel Pembahasan -->
<div class="panel panel-teal">
  <div class="panel-heading">
    <h3 class="panel-title">Pembahasan</h3>
    <div class="panel-toolbar text-right">


    </div>
  </div>
  <!-- Start Panel Body Pembahasan  -->
  <div class="panel-body ">
    <!-- Start Pilihan Pembahasan  -->
    <div class="form-group">

      <label class="control-label col-sm-2">Media Pembahasan</label>

      <div class="col-sm-8">

        <div class="btn-group" data-toggle="buttons" >

          <label class="btn btn-teal btn-outline active " id="m-tex">

            <input type="radio" name="opmedia" value="text"  autocomplete="off" checked="true"> Text

          </label>

          <label class="btn btn-teal btn-outline" id="m-vido">

            <input type="radio" name="opmedia" value="video" autocomplete="off"> Video

          </label>

        </div>

      </div>

    </div>
    <!-- End Pilihan Pembahasan-->

    <!-- Start Upload Gambar Pembahasan -->
    <div class="form-group tex">

      <label class="control-label col-sm-2">Gambar Pembahasan</label>

      <div class="col-sm-8 " >

        <div class="col-sm-12">

         <img id="previewPembahasan" style="max-width: 497px; max-height: 381px;  " class="img" src="<?=base_url();?>assets/image/pembahasan/<?=$banksoal['gambar_pembahasan'];?>" alt="" />

       </div>
       <div class="col-sm-12">
        <div class="col-md-5 left"> 
          <h6>Name: <span id="filenamePembahasan"></span></h6> 
        </div> 
        <div class="col-md-4 left"> 
          <h6>Size: <span id="filesizePembahasan"></span>Kb</h6> 
        </div> 
        <div class="col-md-3 bottom"> 
          <h6>Type: <span id="filetypePembahasan"></span></h6> 
        </div>
      </div>
      <div class="col-sm-12">
        <label for="filePembahasan" class="btn btn-sm btn-default">
          Pilih Gambar
        </label>
        <input style="display:none;" type="file" id="filePembahasan" name="gambarPembahasan" onchange="ValidateSingleInput(this);"/>
        <label class="btn btn-sm btn-danger"  onclick='restImgPembahasan("<?=$UUID?>")'>Reset</label>
      </div>
    </div>
  </div>
  <!-- End Upload Gambar Pembahsan -->

  <!-- Start Editor Pembahasan -->
  <div  class="form-group tex "> 
   <div id="editor-soal">
    <label class="control-label col-sm-2">Pembahasan</label>
    <div class="col-sm-10">

     <textarea  name="editor2" class="form-control" id=""><?=$banksoal['pembahasan'];?></textarea>

   </div>
 </div>

</div>
<!-- End Editor Pembahasan -->

<!-- Start Upload Video Pembahasan -->
<!-- pilih option upload video -->
           <!--  <div class="form-group vido" hidden="true">
                <label class="control-label col-sm-2">Pilihan Upload Video</label>
                <div class="col-sm-8">
                    <div class="btn-group" data-toggle="buttons" >
                        <label class="btn btn-teal btn-outline active" id="up_server">
                            <input type="radio" name="option_up" value="server" autocomplete="off" > Upload Video Ke server
                        </label>
                        <label class="btn btn-teal btn-outline " id="up_link">
                            <input type="radio" name="option_up"  value="link" autocomplete="off" checked="true"> Link
                        </label>
                    </div>
                </div>
              </div> -->
              <!-- untuk preview video -->

              <div  class="form-group prv_video " hidden="true">

                <div class="row" style="margin:1%;"> 

                  <div class="col-md-12">
                   <input type="text" id="name_video" value="<?=$banksoal['video_pembahasan']?>" hidden="true">
                   <video id="preview" class="img-tumbnail image"  src="<?=base_url();?>assets/video/videoPembahasan/<?=$banksoal['video_pembahasan'];?>" width="100%" height="50%" controls >
                   </video>
                 </div>
                 <div class="col-md-5 left"> 
                  <h6>Name: <span id="filename"></span></h6> 
                </div> 
                <div class="col-md-4 left"> 
                  <h6>Size: <span id="filesize"></span>Kb</h6> 
                </div> 
                <div class="col-md-3 bottom"> 
                  <h6>Type: <span id="filetype"></span></h6> 
                </div>
              </div>
            </div>


            <!-- upload ke server -->
            <div id="upload" class="form-group server" hidden="true">
              <label class="col-sm-2 control-label">File Video</label>
              <div class="col-sm-4">
                <label for="file" class="btn btn-sm btn-default">
                  Pilih Video
                </label>
                <input style="display:none;" type="file" id="file" name="video" onchange="ValidateInputVideo(this);"/>
                <!-- <span class="col-sm-12 text-danger"><?php echo form_error('video'); ?></span> -->
              </div>
            </div>

            <!-- upload video by link -->
            <div class="form-group link" hidden="true">
              <label class="col-sm-2 control-label">Link Video</label>
              <div class="col-sm-4">
                <input class="form-control" type="text" name="link_video">
              </div>
            </div>


            <!-- end Upload Video Pembahasan-->
          </div>
          <!-- End Panel Body Pembahasan -->
        </div>
        <!-- End Panel Pembahasan -->
      </div>
      <!-- End Form Pembahasan -->
    </div>
    <div class="panel-footer">
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
         <button type="button" class="btn btn-info" onclick="preview()">Preview</button>
      </div>
      <div class="col-md-5"><br><br>
        <div class="indicator show">
          <!-- <span class="spinner"></span> -->
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-success" style="width: 0%" id="ProgressSOal">
              <span class="sr-only">100% Complete (success)</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
  <!--/ Form horizontal layout bordered -->
</div>

</div>
<!--/ END row -->
</div>

<script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
         CKEDITOR.replace( 'editor3' );
      </script>

      <!-- script untuk option hide and show -->
      <script type="text/javascript">

        $(document).ready(function(){
           $("#pp_img").hide();
            //set opton dropdown mp
            loadPelajaran($('#oldtkt').val());
            // #########################

            // set option dropdown bab
            load_bab($('#oldmp').val());
            // ##################
            // set optopn dropdown sub
            load_sub_bab($('#oldbab').val());
            // ###############

          // set option kesulitan ################
          var tampkesulitan=$('#tampkesulitan').val();
          if (tampkesulitan ==3) {
            $('#lvl3').attr('selected','selected');
          }else if (tampkesulitan==2) {
            $('#lvl2').attr('selected','selected');
          }else if (tampkesulitan==1) {
            $('#lvl1').attr('selected','selected');
          }else{

          }
          // ########################

          // Set option Jawaban ###########
          var tampjawaban =  $('#tampjawaban').val();
          if (tampjawaban != '') {
            var tamid ='#opjawaban option[value='+tampjawaban+']';
            $(tamid).attr('selected','selected');
          }else{
          }
          // set option publish################
          var tamppublish=$('#tamppublish').val();
          if (tamppublish ==1) {
           $('#gift').attr('checked','checked');
         }else{
         }
          // ########################

          // set option random################
          var tamprandom=$('#tamprandom').val();
          if (tamprandom ==1) {
           $('#idrand').attr('checked','checked');
         }else{
         }
          // ########################

          // set option jum piljawab################
          var pilE=$('#pilE').val();
          if (pilE=='') {
            // hide input pilihan E
            $("#pilihan").hide();
            $("#pilihanop").hide();
            $("#empatpil").addClass('active');
            $("#radio4").attr('checked',true);
            
          }else{
            $("#limapil").addClass('active');
            $("#radio5").attr('checked',true);
          }
          // ########################

          // Start event untuk jenis editor
          $("#in-soal").click(function(){

            $("#editor-soal").show();

            $("#editor-rumus").hide();

          });

          $("#pr-rumus").click(function(){

            $("#editor-rumus").show();

            $("#editor-soal").hide();

          });
           // End event untuk jenis editor
            // Strat  event untuk pilihan jenis input  
            $("#text").click(function(){
              $(".piltext").show();
              $(".pilgambar").hide();
              $(".btn-pilihan").attr("disabled",false);
                //hide preview pilihan text
              $("#pp_img").hide();
              $("#pp_text").show(); 
            });
            $("#gambar").click(function(){
              $(".pilgambar").show();
              $(".piltext").hide();   
              $(".btn-pilihan").attr("disabled",true);
                 //disable btn editor pilihan jawaban 
              $(".btn-pilihan").attr("disabled",true);
              $("#pp_text").hide();
              $("#pp_img").show();   
            });
            //END  event untuk pilihan jenis input  
            // Strat  event untuk jumlah pilihan  
            $("#empatpil").click(function(){   
             $("#pilihan").hide();
             $("#pilihanop").hide();
           });
            $("#limapil").click(function(){
              $("#pilihan").show();
              $("#pilihanop").show();
            });
            // END  event untuk jumlah pilihan


        // Start Eveb Show Hide Form Pembahasan
        $("#show-pembahasan").click(function(){
         $(".pembahasan").show();
       });
        $("#hide-pembahasan").click(function(){
         $(".pembahasan").hide();
       });

        $("#m-tex").click(function(){
         $(".vido").hide();
         $(".tex").show();

         $(".link").hide();
         $(".server").hide();
         $(".prv_video").hide();
       });
        $("#m-vido").click(function(){
         $(".tex").hide();
         if ($('#name_video').val()!='' && $('#name_video').val()!=' ') {
          $(".prv_video").show();

        }

        $(".vido").show();
        $(".server").show();

      });
        // End Even Show Hide Form Pembahasan

      });
    </script>

    <!-- Start script untuk preview gambar soal -->
    <script type="text/javascript">
      $(function () {
            // Start event preview gambar Soal
            $('#fileSoal').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                  // $('.hidden-audio').hide();
                }else{
                  reader.onload = viewerSoal.load;
                  reader.readAsDataURL(file);
                  viewerSoal.setProperties(file);
                }
              });
            var viewerSoal = {
              load : function(e){
                $('#previewSoal').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameSoal').text(file.name);
                $('#filetypeSoal').text(file.type);
                $('#filesizeSoal').text(Math.round(file.size/1024));
              },
            }
            // End event preview gambar soal
             // Start event preview gambar Audio
             $('#fileAudio').on('change',function () {
               $('.hidden-audio').show();
               var file = this.files[0];
               var reader = new FileReader();
               var size=Math.round(file.size/1024);
               if (size>=50000) {
                $('#e_size_audio').modal('show');
                $('.hidden-audio').hide();
              }else{
                reader.onload = viewerAudio.load;
                reader.readAsDataURL(file);
                viewerAudio.setProperties(file);
              }
            });
             var viewerAudio = {
              load : function(e){
                $('#previewAudio').attr('src', e.target.result);
                  $('#prevAudio').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameAudio').text(file.name);
                $('#filetypeAudio').text(file.type);
                $('#filesizeAudio').text(Math.round(file.size/1024));
              },
            }
            // End event preview gambar Audio
             // Start event preview gambar Pembahasan

             $('#filePembahasan').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerPembahasan.load;
                  reader.readAsDataURL(file);
                  viewerPembahasan.setProperties(file);
                }
              });
             var viewerPembahasan = {
              load : function(e){
                $('#previewPembahasan').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenamePembahasan').text(file.name);
                $('#filetypePembahasan').text(file.type);
                $('#filesizePembahasan').text(Math.round(file.size/1024));
              },
            }

            // End event preview gambar Soal

            // Start event preview gambar pilihan A
            $('#fileA').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerA.load;
                  reader.readAsDataURL(file);
                  viewerA.setProperties(file);
                }

              });
            var viewerA = {
              load : function(e){
                $('#previewA').attr('src', e.target.result);
                //untuk di preview soal
                $('#previewA2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameA').text(file.name);
                $('#filetypeA').text(file.type);
                $('#filesizeA').text(Math.round(file.size/1024));
              },
            }
            // End event preview gambar pilihan A

            // Start event preview gambar pilihan B
            $('#fileB').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                 reader.onload = viewerB.load;
                 reader.readAsDataURL(file);
                 viewerB.setProperties(file);
               }
             });
            var viewerB = {
              load : function(e){
                $('#previewB').attr('src', e.target.result);
                   //untuk di preview soal
                $('#previewB2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameB').text(file.name);
                $('#filetypeB').text(file.type);
                $('#filesizeB').text(Math.round(file.size/1024));
              },
            }

            // End event preview gambar pilihan B

            // Start event preview gambar pilihan C
            $('#fileC').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                 reader.onload = viewerC.load;
                 reader.readAsDataURL(file);
                 viewerC.setProperties(file);
               }
             });
            var viewerC = {
              load : function(e){
                $('#previewC').attr('src', e.target.result);
                //untuk di preview soal
                $('#previewC2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameC').text(file.name);
                $('#filetypeC').text(file.type);
                $('#filesizeC').text(Math.round(file.size/1024));
              },
            }

            // End event preview gambar pilihan C

            // Start event preview gambar pilihan D
            $('#fileD').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerD.load;
                  reader.readAsDataURL(file);
                  viewerD.setProperties(file);
                }
              });
            var viewerD = {
              load : function(e){
                $('#previewD').attr('src', e.target.result);
                //untuk di preview soal
                $('#previewD2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameD').text(file.name);
                $('#filetypeD').text(file.type);
                $('#filesizeD').text(Math.round(file.size/1024));
              },
            }

            // End event preview gambar pilihan D

            // Start event preview gambar pilihan E
            $('#fileE').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerE.load;
                  reader.readAsDataURL(file);
                  viewerE.setProperties(file);
                }
              });
            var viewerE = {
              load : function(e){
                $('#previewE').attr('src', e.target.result);
                //untuk di preview soal
                $('#previewE2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameE').text(file.name);
                $('#filetypeE').text(file.type);
                $('#filesizeE').text(Math.round(file.size/1024));
              },
            }

            // End event preview gambar pilihan E

          });
        </script>
        <!-- End script untuk preview gambar soal -->
        <!-- start script js validation extension -->
        <script type="text/javascript">
         var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
         function ValidateSingleInput(oInput) {
          if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
              var blnValid = false;
              for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                  blnValid = true;
                  break;
                }
              }

              if (!blnValid) {
               $('#warningupload').modal('show');
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
              }
            }
          }
          return true;
        }
// validation upload video   
function ValidateInputVideo(oInput) {
  var _validFileExtensions = [".mp4"]; 
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;
        }
      }

      if (!blnValid) {
        $('#warningupload2').modal('show');
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
              }
            }
          }
          return true;
        }
      </script>
      <!-- END -->
      <!--Start  Script drop down depeden -->

      <script>

    // Script for getting the dynamic values from database using jQuery and AJAX

    $(document).ready(function () {

      $('#eTingkat').change(function () {

        var form_data = {

          name: $('#eTingkat').val()

        };

        $.ajax({

          url: "<?php echo site_url('videoback/getPelajaran'); ?>",

          type: 'POST',
          dataType: "json",
          data: form_data,

          success: function (msg) {

            var sc = '';

            $.each(msg, function (key, val) {

              sc += '<option value="' + val.id + '">' + val.keterangan + '</option>';

            });

            $("#ePelajaran option").remove();

            $("#ePelajaran").append(sc);

          }

        });

      });

        // Strat  event untuk pilihan jenis input  

        $("#up_server").click(function () {

          $(".server").show();

          $(".link").hide();
        });
        $("#up_link").click(function () {
          $(".link").show();
          $(".server").hide();
          $(".prv_video").hide();
        });
        $("#file").click(function () {
          $(".prv_video").show();
        });
      });




    //buat load tingkat

    function loadTingkat() {

      jQuery(document).ready(function () {
        var oldtkt = $('#oldtkt').val();
        var tingkat_id = {"tingkat_id": $('#tingkat').val()};

        var idTingkat;

        $.ajax({

          type: "POST",
          dataType: "json",
          data: tingkat_id,

          url: "<?= base_url() ?>index.php/videoback/getTingkat",

          success: function (data) {


            $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

            $.each(data, function (i, data) {

              if (data.id==oldtkt) {
               $('#tingkat').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
             } else {
              $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
            }



            return idTingkat = data.id;

          });

          }

        });



        $('#tingkat').change(function () {

          tingkat_id = {"tingkat_id": $('#tingkat').val()};

          loadPelajaran($('#tingkat').val());

        })



        $('#pelajaran').change(function () {

          pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};

          load_bab($('#pelajaran').val());

        })



        $('#bab').change(function () {

          load_sub_bab($('#bab').val());

        })

      })

    }

    ;



    //buat load pelajaran

    function loadPelajaran(tingkatID) {
      var oldmp = $('#oldmp').val();
      $.ajax({

        type: "POST",
        dataType: "json",
        data: tingkatID.tingkat_id,

        url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

        success: function (data) {

          $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');

          $.each(data, function (i, data) {
            if (data.id == oldmp ) {
              $('#pelajaran').append("<option value='" + data.id + "' selected>" + data.keterangan + "</option>");
            } else {
              $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
            }


          });

        }

      });

    }

    //buat load bab

    function load_bab(mapelID) {
      var oldbab = $('#oldbab').val();
      $.ajax({

        type: "POST",
        dataType: "json",
        data: mapelID.mapel_id,

        url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,

        success: function (data) {



          $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');



          $.each(data, function (i, data) {
            if (data.id==oldbab) {
             $('#bab').append("<option value='" + data.id + "' selected>" + data.judulBab + "</option>");
           } else {
             $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
           }


         });

        }



      });

    }

    //load sub bab

    function load_sub_bab(babID) {
      var oldsub = $('#oldsub').val();
      $.ajax({

        type: "POST",
        dataType: "json",
        data: babID.bab_id,

        url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,

        success: function (data) {

          $('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');


          $.each(data, function (i, data) {

           if (data.id==oldsub) {
             $('#subbab').append("<option value='" + data.id + "' selected>" + data.judulSubBab + "</option>");
           } else {
             $('#subbab').append("<option value='" + data.id + "' >" + data.judulSubBab + "</option>");
           }

         });

        }



      });

    }

    loadTingkat();

    function restImgSoal(UUID) {
        url = base_url+"index.php/banksoal/delImgSoal/"+UUID,
       swal({
        title: "Apakah Anda yakin akan menghapus gambar soal ini?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap hapus!",
        closeOnConfirm: false
      },
      function(){
        var datas = {UUID:UUID};
        $.ajax({
          dataType:"text",
          data:datas,
          type:"POST",
          url:url,
          success:function(){
            swal("Terhapus!", "ambar soal berhasil dihapus.", "success");
            $("input[name=gambarSoal]").val("");
            $('#previewSoal').attr('src', "");
            $('#filenameSoal').text("");
            $('#filetypeSoal').text("");
            $('#filesizeSoal').text("");
          },
          error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
          }

        });
      });
    }
    function restImgPembahasan(UUID) {
       url = base_url+"index.php/banksoal/delImgPembahasan/"+UUID,
       swal({
        title: "Apakah Anda yakin akan menghapus gambar pembahasan ini?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap hapus!",
        closeOnConfirm: false
      },
      function(){
        var datas = {UUID:UUID};
        $.ajax({
          dataType:"text",
          data:datas,
          type:"POST",
          url:url,
          success:function(){
            swal("Terhapus!", "Audio soal berhasil dihapus.", "success");
            $("input[name=gambarPembahasan]").val("");
            $('#previewPembahasan').attr('src', "");
            $('#filenamePembahasan').text("");
            $('#filetypePembahasan').text("");
            $('#filesizePembahasan').text("");
          },
          error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
          }

        });
      });


    }

     //reset form input audio soal
     function restAudioSoal(UUID){
       url = base_url+"index.php/banksoal/delAudioSoal/"+UUID,
       swal({
        title: "Apakah Anda yakin akan menghapus audio soal ini?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap hapus!",
        closeOnConfirm: false
      },
      function(){
        var datas = {UUID:UUID};
        $.ajax({
          dataType:"text",
          data:datas,
          type:"POST",
          url:url,
          success:function(){
            swal("Terhapus!", "Audio soal berhasil dihapus.", "success");
            $("input[name=listening]").val("");
            $('#previewAudio').attr('src', "");
            $('#filenameAudio').text("");
            $('#filetypeAudio').text("");
            $('#filesizeAudio').text("");
            $('.hidden-audio').hide();
          },
          error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
          }

        });
      });

      
    }

    //reser/hapus gambar pilihan jawaban A
    function restImgPilihan(UUID,pilihan) {
      //hapus img
        url = base_url+"index.php/banksoal/delImgpilihan/"+UUID+"/"+pilihan,
       swal({
        title: "Apakah Anda yakin akan menghapus gambar soal ini?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap hapus!",
        closeOnConfirm: false
      },
      function(){

        var datas = {UUID:UUID};
        $.ajax({
          dataType:"text",
          data:datas,
          type:"POST",
          url:url,
          success:function(){
            swal("Terhapus!", "ambar soal berhasil dihapus.", "success");
            if (pilihan=="A") {
              resetImgA();
            }else if(pilihan=="B"){
              resetImgB();
            }else if(pilihan=="C"){
              resetImgC();
            }else if(pilihan=="D"){
              resetImgD();
            }else if(pilihan=="E"){
               resetImgE();
            }
          },
          error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
          }

        });
      });
    }

    //reset preview image pilihan jawaban A
    function resetImgA() {
       $("input[name=gambar1]").val("");
            $("#previewA").attr('src', "");
            $("#filenameA").text("");
            $('#filetypeA').text("");
            $('#filesizeA').text("");
    }
    //reset preview image pilihan jawaban B
    function resetImgB() {
       $("input[name=gambar2]").val("");
            $("#previewB").attr('src', "");
            $("#filenameB").text("");
            $('#filetypeB').text("");
            $('#filesizeB').text("");
    }

    //reset preview image pilihan jawaban C
        function resetImgC() {
       $("input[name=gambar3]").val("");
            $("#previewC").attr('src', "");
            $("#filenameC").text("");
            $('#filetypeC').text("");
            $('#filesizeC').text("");
    }
 //reset preview image pilihan jawaban D
        function resetImgD() {
       $("input[name=gambar4]").val("");
            $("#previewD").attr('src', "");
            $("#filenameD").text("");
            $('#filetypeD').text("");
            $('#filesizeD').text("");
    }
     //reset preview image pilihan jawaban E
        function resetImgE() {
       $("input[name=gambar5]").val("");
            $("#previewE").attr('src', "");
            $("#filenameE").text("");
            $('#filetypeE').text("");
            $('#filesizeE').text("");
    }

    //validasi upload audio
    function ValidateAudioInput(oInput){
      var _validFileExtensions = [".mp3"]; 
      if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
          var blnValid = false;
          for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
              blnValid = true;
              break;
            }
          }

          if (!blnValid) {
            $('#warning-upload-audio').modal('show');
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
              }
            }
          }
          return true;
        }
      </script>
      <!--END Script drop down depeden  -->

      <script type="text/javascript">

    // preview soal sebelum di upload
    function preview() {
          Preview2.Update();
      var tingkat = $('select#tingkat').text();
      var judul = $("input[name=judul]").val();
      var sumber  = $("input[name=sumber]").val();
      var jawaban = $('select[name=jawaban]').val();
      var a  =$("textarea[name=a]").val();
      var b  =$("textarea[name=b]").val();
      var c  =$("textarea[name=c]").val();
      var d  =$("textarea[name=d]").val();
      var e  =$("textarea[name=e]").val();
      $("#prevSumber").text(sumber);
      $("#prevJudul").text(judul);
      $('li#a').text(a);
      $('li#b').text(b);
      $('li#c').text(c);
      $('li#d').text(d);
      $('li#e').text(e);
      $('a#prevJawaban').text(jawaban);
        $('#modalpreview').modal('show'); // show bootstrap modal

      }
      var ckeditor_type;
  var pilihanA 
  //show modal ck editor
  function my_editor(data) {
    ckeditor_type=data;
    $('#m-editor').modal('show');
    $('#m-editor h2').html("Editor "+ckeditor_type);
    var val_editor;
    if(ckeditor_type=="Pilihan Jawaban A") {
     val_editor=$("textarea[name=a]").val();
    } else if(ckeditor_type=="Pilihan Jawaban B") {
     val_editor=$("textarea[name=b]").val();
    } else if(ckeditor_type=="Pilihan Jawaban C") {
     val_editor=$("textarea[name=c]").val();
    } else if(ckeditor_type=="Pilihan Jawaban D") {
     val_editor=$("textarea[name=d]").val();
    } else if(ckeditor_type=="Pilihan Jawaban E") {
     val_editor=$("textarea[name=e]").val();
    } 
    // set value ckeditor3
    CKEDITOR.instances.editor3.setData(val_editor);
  } 
  // send value CKeditor untuk pilihan jawaban
  function send_val() {
    var val_editor= CKEDITOR.instances.editor3.getData();
    $('#m-editor').modal('hide');
    if(ckeditor_type=="Pilihan Jawaban A") {
      $("textarea[name=a]").val(val_editor);
      $("#view-a").html(val_editor);
    } else if(ckeditor_type=="Pilihan Jawaban B") {
      $("textarea[name=b]").val(val_editor);
      $("#view-b").html(val_editor);
    } else if(ckeditor_type=="Pilihan Jawaban C") {
      $("textarea[name=c]").val(val_editor);
      $("#view-c").html(val_editor);
    } else if(ckeditor_type=="Pilihan Jawaban D") {
      $("textarea[name=d]").val(val_editor);
      $("#view-d").html(val_editor);
    } else if(ckeditor_type=="Pilihan Jawaban E") {
      $("textarea[name=e]").val(val_editor);
      $("#view-e").html(val_editor);
    } 
}  
    </script>


    <!-- PROGRES BAR -->
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <!-- SCRIPT UNTUK PROGRESS BAR -->
   <!--  <script>
      (function() {
        var bar = $('#ProgressSOal');
        var status = $('#status');
        $('.edit-form').ajaxForm({
          beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
          },
          uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
          },
          success: function() {
            var percentVal = '100%';
            bar.width(percentVal);
            swal({
              title: "Edit selesai",
              text: "Edit lagi atau selesai?",
              type: "success",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Edit Lagi",
              cancelButtonText: "Selesai Edit",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
               location.reload();
             } else {
              uuid = $('input[name=UUID]').val();
              sub = $('input[name=subBabID]').val();
              window.location = base_url+"banksoal/banksoal/mysoal";
            }
          });
          },
          complete: function(xhr) {
            status.html(xhr.responseText);
          }
        }); 

      })();       
    </script> -->
    <!-- ## PROGRES BAR -->
  </section>
        <!--/ END Template Main