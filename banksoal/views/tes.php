<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>

        <!-- START Template Main -->
        <section id="main" role="main">
                 <!-- Start Modal salah upload type gambar -->
<div class="modal fade" id="warningupload" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek type extension gambar!</h3>
        <h5 class="text-center">Type yang bisa di upload hanya .jpeg|.gif|.jpg|.png|.bmp</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

         <!-- Start Modal salah upload size gambar -->
<div class="modal fade" id="warninguploadsize" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek ukuran gambar!</h3>
        <h5 class="text-center">Ukuran yang bisa di upload maksimal 400Kb! </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

            <!-- START Template Container -->
            <div class="container-fluid">

<!-- Priview -->
 <div class="modal fade " id="modalpriview" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">

   <!-- Start Panel Priview -->
   <div class="panel panel-teal">
    <!-- Start heading -->
    <div class="panel-heading ">
      <div class="panel-toolbar">
       <h4 class="modal-title ">Priview Soal</h4>
      </div>
       <div class="panel-toolbar text-right">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    </div>
    <!-- End heading -->
    <!-- Start body priview -->
    <div class="panel-body ">
    <label class="">Sumber :</label> <a id="prevSumber"  ></a> <br>
    <label> judul  :</label> <a id="prevJudul" ></a> <br>
    <label>Soal   : </label>
    <!-- img -->
    <div class="col-sm-12">
      <img id="previewSoal2" style="max-width: 200px; max-height: 125px;  " class="img" src="" alt="" />
    </div>
    <!-- img -->
    <div class="prevSoal col-sm-12">

    </div>
    <!-- pilihan jawaban -->
    <div class="col-sm-12">
      <ol type="A">
        <li id="a"></li>
        <li id="b"></li>
        <li id="c"></li>
        <li id="d"></li>
        <li id="e"></li>
      </ol>
    </div>
    <!-- jawaban -->
    <div class="col-sm-12"> 
      <label>Jawaban : </label> <a id="prevJawaban"></a>
    </div>
    
    </div>
    <!-- END body priview -->

    <!-- Start footer priview -->
    <div class="panel-footer hidden-xs">
     <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Keluar</button>
    </div>
    <!-- end footer priview -->

   </div>
    <!-- END panel Priview -->

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


            
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">BANK SOAL</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START panel -->
                        <div class="panel panel-default">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Soal</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <form class="form-horizontal form-bordered" action="<?=base_url()?>index.php/Banksoal/uploadsoal" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <?php echo $this->session->flashdata('msg'); ?>
                                <?php echo validation_errors(); ?>
                                    
                                    
                                    


                                    <div class="form-group">
                                        <label class="col-sm-2">Mata Pelajaran</label>
                                    <div class="col-sm-5">
                                        <select class='form-control' name="id_mapel" id='id_mapel'>
                                              <option value='0'>--pilih--</option>
                                              <?php 
                                                foreach ($mapel as $pel) {
                                                echo "<option value='$pel[id_mapel]'>$pel[nama_mapel]</option>";
                                                }
                                              ?>
                                            </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">BAB</label>
                                        <div class="col-sm-5">
                                            <select class='form-control' name="judul_bab" id='id_bab'>
                                            <option value='0'>--pilih--</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Judul Soal</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="judul_soal" class="form-control" value="<?php echo set_value('judul_soal'); ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Kesulitan</label>
                                        <div class="col-sm-5">
                                            <select name="kesulitan" id="kesulitan" class="form-control">
                                            <option value="1">Mudah</option>
                                            <option value="2">Sedang</option>
                                            <option value="3">Sulit</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group">

                            <label class=" col-sm-2">Gambar Soal</label>

                             <div class="col-sm-8 " >

                                <div class="col-sm-12">

                                     <img id="previewSoal" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />

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

                                    <label for="fileSoal" class="btn btn-success">

                                        Pilih Gambar

                                    </label>

                                    <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>

                                    <label class="btn btn-danger"  onclick="restImgSoal()">Reset</label>

                                </div>

                            </div>

                        </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Sumber</label>
                                        <div class="col-sm-5">
                                            <input name="sumber" id="sumber" type="text" class="form-control" value="<?php echo set_value('sumber'); ?>">
                                        </div>
                                    </div>
                                     <div class="form-group">


                            <label class=" col-sm-2">Jenis Editor</label>

                            <div class="col-sm-8">

                                <div class="btn-group" data-toggle="buttons" >

                                      <label class="btn active " id="in-soal">

                                        <input type="radio" name="options"  autocomplete="off" checked="true"> Input Soal

                                      </label>

                                      <label class="btn" id="pr-rumus">

                                        <input type="radio" name="options"   autocomplete="off"> Rumus Matematika

                                      </label>

                                 </div>

                            </div>

                        </div>

                        <div class="form-group">
                           <!-- Start Editor Soal -->
                           <div id="editor-soal">
                            <label class="col-sm-2">Soal</label>
                             <div class="col-sm-10">

                                 <textarea  name="editor1" class="form-control" >

                                     

                                 </textarea>

                             </div>
                            </div>
                            <!-- End Editor Soal -->
                            <!-- Start Math jax -->
                            <div id="editor-rumus" hidden="true">
                              <label class="control-label col-sm-2">Buat rumus</label>
                              <div class="col-sm-10">

                               <textarea class="form-control" id="MathInput" cols="60" rows="10" onkeyup="Preview.Update()" >
                               </textarea>

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
                            <!-- End MathJax -->
                        </div>

                        <div class="form-group">


                

            </div>



            
                        <div class="form-group">

                            <label class="control-label col-sm-2">Jenis Pilihan</label>

                            <div class="col-sm-8">

                                <div class="btn-group" data-toggle="buttons" >

                                      <label class="btn active " id="text">

                                        <input type="radio" name="options" value="text" autocomplete="off" checked="true"> Text

                                      </label>

                                      <label class="btn" id="gambar">

                                        <input type="radio" name="options"  value="gambar" autocomplete="off"> Gambar

                                      </label>

                                 </div>

                            </div>

                        </div>

                         <!-- Start input jawaban A -->
                         <div><?php echo $this->session->flashdata('pesan'); ?></div>

                        <div class="form-group">

                            <label class="col-sm-2">Pilihan A</label>

                            <!-- Start input text A -->

                            <div class="col-sm-5 piltext">

                               <textarea name="a"  class="form-control" rows="2" value="<?php echo   set_value('a'); ?>"  required="true" id="pilA"></textarea>

                            </div>

                            <!-- END input text A -->

                            <!-- Start input gambar A -->

                            <div class="col-sm-8 pilgambar" hidden="true">

                                <div class="col-sm-12">

                                     <img id="previewA" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />

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

                                    <label for="fileA" class="btn btn-sm btn-default">

                                        Pilih Gambar

                                    </label>

                                    <input style="display:none;" type="file" id="fileA" name="gambar1" onchange="ValidateSingleInput(this);"/>
                                    
                                </div>

                            </div>

                            <!-- END input Gambar A -->

                        </div>

                        <!-- END input jawaban A -->
<!-- Start input jawaban B -->

                        <div class="form-group">

                            <label class="col-sm-2">Pilihan B</label>

                            <!-- Start input text B -->

                            <div class="col-sm-5 piltext">

                               <textarea name="b" class="form-control" value="<?php echo set_value('b'); ?>" id="pilB" required="true"></textarea>

                            </div>

                            <!-- END input text B -->

                            <div class="col-sm-8 pilgambar" hidden="true">

                                <div class="col-sm-12">

                                     <img id="previewB" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />

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

                                    <label for="fileB" class="btn btn-sm btn-default">

                                        Pilih Gambar

                                    </label>

                                    <input style="display:none;" type="file" id="fileB" name="gambar2" onchange="ValidateSingleInput(this);"/>
                                  

                                </div>

                            </div>

                        </div>

                        <!-- END input jawaban  -->



                        <!-- Start input jawaban C -->

                        <div class="form-group">

                            <label class="col-sm-2">Pilihan C</label>

                            <!-- Start input text C -->

                            <div class="col-sm-5 piltext" >

                               <textarea name="c" class="form-control" value="<?php echo set_value('c'); ?>" id="pilC" required="true"></textarea>

                            </div>

                            <!-- END input text C -->

                            <!-- Start input gambar C -->

                            <div class="col-sm-8 pilgambar" hidden="true">

                                <div class="col-sm-12">

                                     <img id="previewC" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />

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

                                    <input style="display:none;" type="file" id="fileC" name="gambar3" onchange="ValidateSingleInput(this);"/>
                           

                                </div>

                            </div>

                            <!-- END input Gambar C -->                       

                        </div>

                        <!-- END input Jawaban C -->



                        <!-- Start input jawaban D -->

                        <div class="form-group">

                            <label class="col-sm-2">Pilihan D</label>

                            <!-- Start input text D -->

                            <div class="col-sm-5 piltext" >

                               <textarea name="d" class="form-control" value="<?php echo set_value('d'); ?>" id="pilD" required="true"></textarea>

                            </div>

                            <!-- END input text D -->

                            <!-- Start input gambar D -->

                            <div class="col-sm-8 pilgambar" hidden="true">

                                <div class="col-sm-12">

                                     <img id="previewD" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />

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

                                    <label for="fileD" class="btn btn-sm btn-default">

                                        Pilih Gambar

                                    </label>

                                    <input style="display:none;" type="file" id="fileD" name="gambar4" onchange="ValidateSingleInput(this);"/>

                                </div>

                            </div>

                            <!-- END input Gambar D -->                       

                        </div>

                        <!-- END input Jawaban D -->

                        

                        <!-- Start input jawaban E -->

                        <div class="form-group" id="pilihan">

                            <label class="col-sm-2">Pilihan E</label>

                            <!-- Start input text E -->

                            <div class="col-sm-5 piltext" >

                               <textarea name="e" class="form-control" value="<?php echo set_value('e'); ?>" id="pilE" required="true"></textarea>

                            </div>

                            <!-- END input text E -->

                            <!-- Start input gambar E -->

                            <div class="col-sm-8 pilgambar" hidden="true">

                                <div class="col-sm-12">

                                     <img id="previewE" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />

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

                                    <input style="display:none;" type="file" id="fileE" name="gambar5" onchange="ValidateSingleInput(this);"/>


                                </div>

                            </div>

                            <!-- END input Gambar C -->                       

                        </div>

                        <!-- END input Jawaban E -->

                                    <div class="form-group">
                                        <label class="col-sm-2">Jawaban Benar</label>
                                        <div class="col-sm-5">
                                            <select name="jawaban_benar" id="benar" class="form-control">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>


                                        </select>
                                        </div>
                                    </div>

                                    <!-- untuk preview video -->

                                    <div class="form-group">
                                        <label class="col-sm-2">Link Pembahasan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="pembahasan" class="form-control" id="pembahasan" >
                                        </div>
                                    </div>

     <!--        <div  class="form-group prv_video" hidden="true">

                <div class="row" style="margin:1%;"> 

                    <div class="col-md-8">

                        <video id="preview" class="img-tumbnail image" src="" width="100%" height="50%" controls >



                        </video>

                    </div>

                    <div class="col-md-2 left"> 

                        <h6>Name: <span id="filename" name="pembahasan"></span></h6> 

                    </div> 

                    <div class="col-md-2 left"> 

                        <h6>Size: <span id="filesize"></span>Kb</h6> 

                    </div> 

                    <div class="col-md-4 bottom"> 

                        <h6>Type: <span id="filetype"></span></h6> 

                    </div>

                </div>

            </div> -->
            <!-- upload ke server -->

            <!-- <div id="upload" class="form-group server">

                <label class="col-sm-2">Pembahasan</label>

                <div class="col-sm-8">



                    <label for="file" class="btn btn-success">

                        Pilih Video

                    </label>

                    <input style="display:none;" type="file" id="file" name="video" onchange="ValidateSingleInput(this);"/>

                </div>

            </div> -->

                                    
                                    <div class="form-group">
                                        <!-- <label class="col-sm-2">Custom checkbox</label> -->
                                        <div class="col-sm-5">
                                            <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                                <input type="checkbox" name="publish" id="customcheckbox1" value="1" />
                                                <label for="customcheckbox1">&nbsp;&nbsp;Publish</label>
                                            </span>
                                            <span class="checkbox custom-checkbox">
                                                <input type="checkbox" name="random" value="1" id="customcheckbox2" />
                                                <label for="customcheckbox2">&nbsp;&nbsp;Random</label>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <!-- <label class="col-sm-3 control-label">Button</label> -->
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <a class="btn btn-info" onclick="priview()">Priview Soal</a>
                                                <!-- <button type="reset" class="btn btn-danger">Reset button</button> -->
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>
                <!--/ END row -->

                <!-- START row -->
                
                <!--/ END row -->

                <!-- START row -->
                
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->

        </section>
        <!--/ END Template Main -->

        <!-- START Template Sidebar (right) -->

        <!--/ END Template Sidebar (right) -->


 <script>

        // Replace the <textarea id="editor1"> with a CKEditor

        // instance, using default configuration.

        CKEDITOR.replace( 'editor1' );

    </script>



    <!-- script untuk option hide and show -->
    <script type="text/javascript">
// load bab
$(function(){

$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('index.php/Banksoal/ambil_data') ?>",
cache: false,
});

$("#id_mapel").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'getbab',id:value},
success: function(respond){
$("#id_bab").html(respond);
}
})
}

});

})

</script> 
<script type="text/javascript">
  function restImgSoal() {
      $("input[name=gambarSoal]").val("");
      $('#previewSoal').attr('src', "");
      $('#filenameSoal').text("");
      $('#filetypeSoal').text("");
      $('#filesizeSoal').text("");
    }
    function restImgJawaban() {
      $("input[name=gambarSoal]").val("");
      $('#previewSoal').attr('src', "");
      $('#filenameSoal').text("");
      $('#filetypeSoal').text("");
      $('#filesizeSoal').text("");
    }
</script>

    <script type="text/javascript">

        $(document).ready(function(){
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

            });

            $("#gambar").click(function(){

                $(".pilgambar").show();

                $(".piltext").hide();     

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



        });

    </script>



    <!-- Start script untuk priview gambar soal -->

    <script type="text/javascript">

        $(function () {



            // Start event priview gambar Soal

            $('#fileSoal').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerSoal.load;

                reader.readAsDataURL(file);

                viewerSoal.setProperties(file);

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

            // End event priview gambar pilihan A





            // Start event priview gambar pilihan A

            $('#fileA').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerA.load;

                reader.readAsDataURL(file);

                viewerA.setProperties(file);

            });

            var viewerA = {

                load : function(e){

                    $('#previewA').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameA').text(file.name);

                    $('#filetypeA').text(file.type);

                    $('#filesizeA').text(Math.round(file.size/1024));

                },

            }

            // End event priview gambar pilihan A



            // Start event priview gambar pilihan B

            $('#fileB').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerB.load;

                reader.readAsDataURL(file);

                viewerB.setProperties(file);

            });

            var viewerB = {

                load : function(e){

                    $('#previewB').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameB').text(file.name);

                    $('#filetypeB').text(file.type);

                    $('#filesizeB').text(Math.round(file.size/1024));

                },

            }



            // End event priview gambar pilihan B



            // Start event priview gambar pilihan C

            $('#fileC').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerC.load;

                reader.readAsDataURL(file);

                viewerC.setProperties(file);

            });

            var viewerC = {

                load : function(e){

                    $('#previewC').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameC').text(file.name);

                    $('#filetypeC').text(file.type);

                    $('#filesizeC').text(Math.round(file.size/1024));

                },

            }



            // End event priview gambar pilihan C



            // Start event priview gambar pilihan D

            $('#fileD').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerD.load;

                reader.readAsDataURL(file);

                viewerD.setProperties(file);

            });

            var viewerD = {

                load : function(e){

                    $('#previewD').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameD').text(file.name);

                    $('#filetypeD').text(file.type);

                    $('#filesizeD').text(Math.round(file.size/1024));

                },

            }



            // End event priview gambar pilihan D



            // Start event priview gambar pilihan E

            $('#fileE').on('change',function () {

                console.log('test');

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerE.load;

                reader.readAsDataURL(file);

                viewerE.setProperties(file);

            });

            var viewerE = {

                load : function(e){

                    $('#previewE').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameE').text(file.name);

                    $('#filetypeE').text(file.type);

                    $('#filesizeE').text(Math.round(file.size/1024));

                },

            }



            // End event priview gambar pilihan E



        });

    </script>

     <!-- End script untuk priview gambar soal -->
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
            file = oInput.files[0];
            if (file.size > 410000 ) {
               $('#warninguploadsize').modal('show');
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

            var tingkat_id = {"tingkat_id": $('#tingkat').val()};

            var idTingkat;



            $.ajax({

                type: "POST",

                data: tingkat_id,

                url: "<?= base_url() ?>index.php/videoback/getTingkat",

                success: function (data) {

                    console.log("Data" + data);

                    $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

                    $.each(data, function (i, data) {

                        $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");

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

        $.ajax({

            type: "POST",

            data: tingkatID.tingkat_id,

            url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

            success: function (data) {

                $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');

                $.each(data, function (i, data) {

                    $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");

                });

            }

        });

    }

    //buat load bab

    function load_bab(mapelID) {

        $.ajax({

            type: "POST",

            data: mapelID.mapel_id,

            url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,

            success: function (data) {



                $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

                //console.log(data);

                $.each(data, function (i, data) {

                    $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");

                });

            }



        });

    }

    //load sub bab

    function load_sub_bab(babID) {

        $.ajax({

            type: "POST",

            data: babID.bab_id,

            url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,

            success: function (data) {

                $('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');

                console.log(data);

                $.each(data, function (i, data) {

                    $('#subbab').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");

                });

            }



        });

    }





    loadTingkat();

</script>
<script type="text/javascript">
// Strat  event untuk pilihan jenis input  
 $(document).ready(function () {
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
</script>


<script type="text/javascript">

    // priview soal sebelum di upload
      function priview() {
        var mapel = $('select#id_mapel').text();
        var judul = $("input[name=judul_soal]").val();
        var sumber  = $("input[name=sumber]").val();
        var soal  = CKEDITOR.instances.editor1.getData();
        var jawaban = $('select[name=jawaban_benar]').val();
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
        $('div.prevSoal').html(soal);
        $('a#prevJawaban').text(jawaban);
        $('#modalpriview').modal('show'); // show bootstrap modal
      
      }
        
       $(document).ready(function () {
         // customcheckbox1
        $("#kesulitan").change(function(){ 
          var judul = $("input[name=judul_soal]").val();
          
          // var publish  =$("input[name=publish]").val(); 
          // console.log(pembahasan, publish); 
            if (judul) {
              // swal('Kosong');
            } else {
              swal('Judul Tidak Boleh Kosong');
            }
        });

        $("#sumber").keyup(function(){ 
          var judul = $("input[name=judul_soal]").val();
            if (judul) {
              // swal('Kosong');
            } else {
              swal('Judul Tidak Boleh Kosong');
            }
        });

        $("#pilA").keyup(function(){ 
          var soal  = CKEDITOR.instances.editor1.getData();
            if (soal) {
              // swal('Kosong');
            } else {
              swal('Soal Tidak Boleh Kosong');
            }
        });

        $("#pilB").keyup(function(){ 
          var a  =$("textarea[name=a]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Boleh Kosong');
            }
        });

         $("#pilC").keyup(function(){ 
          var b  =$("textarea[name=b]").val();
          var a  =$("textarea[name=a]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Boleh Kosong');
            }

            if (b) {
              // swal('Kosong');
            } else {
              swal('Jawaban B Tidak Boleh Kosong');
            }
        });

        $("#pilD").keyup(function(){ 
          var c  =$("textarea[name=c]").val();
          var b  =$("textarea[name=b]").val();
          var a  =$("textarea[name=a]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Boleh Kosong');
            }
            
            if (b) {
              // swal('Kosong');
            } else {
              swal('Jawaban B Tidak Boleh Kosong');
            }
            if (c) {
              // swal('Kosong');
            } else {
              swal('Jawaban C Tidak Boleh Kosong');
            }
        });

        $("#pilE").keyup(function(){ 
          var d  =$("textarea[name=d]").val();
          var c  =$("textarea[name=c]").val();
          var b  =$("textarea[name=b]").val();
          var a  =$("textarea[name=a]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Tidak Boleh Kosong');
            }
            
            if (b) {
              // swal('Kosong');
            } else {
              swal('Jawaban B Tidak Boleh Kosong');
            }
            if (c) {
              // swal('Kosong');
            } else {
              swal('Jawaban C Tidak Boleh Kosong');
            }
            if (d) {
              // swal('Kosong');
            } else {
              swal('Jawaban D Tidak Boleh Kosong');
            }
        });

         $("#pembahasan").keyup(function(){ 
          var e =$("textarea[name=e]").val();
            if (e) {
              // swal('Kosong');
            } else {
              swal('Jawaban E Tidak Boleh Kosong');
            }
        });

          $("#customcheckbox1").change(function(){ 
          var pembahasan = $("input[name=pembahasan]").val(); 
          var d  =$("textarea[name=d]").val();
          var c  =$("textarea[name=c]").val();
          var b  =$("textarea[name=b]").val();
          var a  =$("textarea[name=a]").val();
          var e  =$("textarea[name=e]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Tidak Boleh Kosong');
            }
            
          // console.log(pembahasan)
          //   if (pembahasan) {
          //     // swal('Kosong');
          //   } else {
          //     // swal('Pembahasan Tidak Boleh Kosong');
          //   }
        });
          
        $("#benar").change(function(){ 
          var d  =$("textarea[name=d]").val();
          var c  =$("textarea[name=c]").val();
          var b  =$("textarea[name=b]").val();
          var a  =$("textarea[name=a]").val();
          var e  =$("textarea[name=e]").val();
            if (a) {
              // swal('Kosong');
            } else {
              swal('Jawaban A Tidak Boleh Kosong');
            }
            
            if (b) {
              // swal('Kosong');
            } else {
              swal('Jawaban B Tidak Boleh Kosong');
            }
            if (c) {
              // swal('Kosong');
            } else {
              swal('Jawaban C Tidak Boleh Kosong');
            }
            if (d) {
              // swal('Kosong');
            } else {
              swal('Jawaban D Tidak Boleh Kosong');
            }
        });


      });

</script>
<!--END Script drop down depeden  -->