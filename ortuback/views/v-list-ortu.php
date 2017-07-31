<section>
	<div class="row">
		<div class="col-md-12">
			<!-- div panel Siswa yg belum ada kaun orangtua-->
			<div class="panel panel-teal  " id="panel-ortu">
				<div class="panel-heading">
					<h3 class="panel-title">List Siswa Belum Ada Akun Orang Tua</h3>
					<div class="panel-toolbar text-right">
              	<a href="javascript:void(0)" class="btn btn-danger" title="Sembunyikan" id="hide-tbSiswa"><i class="ico-arrow-down"></i></a>
           </div>
				</div>
				<!-- panel body siswa				-->
				<div class="panel-body">
						<div class="col-md-12" >
						<!-- recor per page tabel Siswa -->
						<div class="col-md-2 mb2 mt10 pl0">
							<select  class="form-control" name="records_per_page_siswa" >
								<!-- <option value="10" selected="true">records per page</option> -->
								<option value="10" selected="true">10</option>
								<option value="25">25</option>
								<option value="50" >50</option>
								<option value="100">100</option>
								<option value="200">200</option>
							</select>
						</div>
						<!-- /recor per page tabel Siswa -->
						<!-- div pencarian  -->
						<div class="col-md-10 mb10 mt10 pr0">
							<div class="input-group">
								<span class="input-group-addon btn" id="cariSiswa"><i class="ico-search"></i></span>
								<input class="form-control" type="text" name="cariSiswa" placeholder="Cari Data">
							</div>
						</div>
						<!-- div pencarian -->
					</div>
					<table  class="daftarsiswa table table-striped display responsive nowrap ">
						<thead>
							<tr>
								<th><span class="checkbox custom-checkbox check-all-siswa">
                    <input type="checkbox" name="checkall_siswa" id="check-all-siswa">
                    <label for="check-all-siswa">&nbsp;&nbsp;</label></span> </th>
								<th>No</th>
								<th>Nama Pengguna</th>
								<th>Nama Siswa</th>
								<th>Email</th>
								<th>Cabang Neutron</th>
							</tr>
						</thead>

						<tbody id="record_daftar_siswa">

						</tbody>
					</table>
					 <!-- div pagination daftar siswa -->
					  <div class="col-md-12">
					  	<ul class="pagination pagination-siswa">

					  	</ul>
					  </div>
   					<!-- div pagination daftar siswa -->
				</div>
				<!-- /panel body siswa -->
				<!-- panel footer siswa -->
				<div class="panel-footer">
					<button class="btn btn-sm btn-primary" onclick="add_ortu()">Add orang Tua Siswa</button>
				</div>
				<!-- panel footer siswa -->
			</div>
		</div>
			<div class="col-md-12">
			<!-- div panel  orangtua-->
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h3 class="panel-title">List Orang Tua</h3>
					<div class="panel-toolbar text-right">
              	<a href="javascript:void(0)" class="btn btn-success" title="Tambah Orang Tua Siswa" id="add-ortu"><i class="ico-user"></i></a>
           </div>
				</div>
				<div class="panel-body">
						<div class="col-md-12" >
						<!-- recor per page tabel orangtua -->
						<div class="col-md-2 mb2 mt10 pl0">
							<select  class="form-control" name="records_per_page_ortu" >
								<!-- <option value="10" selected="true">records per page</option> -->
								<option value="10" selected="true">10</option>
								<option value="25">25</option>
								<option value="50" >50</option>
								<option value="100">100</option>
								<option value="200">200</option>
							</select>
						</div>
						<!-- /recor per page tabel orangtua -->
						<!-- div pencarian  -->
						<div class="col-md-10 mb10 mt10 pr0">
							<div class="input-group">
								<span class="input-group-addon btn" id="cariOrtu"><i class="ico-search"></i></span>
								<input class="form-control" type="text" name="cariOrtu" placeholder="Cari Data orangtua">
							</div>
						</div>
						<!-- div pencarian -->
					</div>
					<table class="table table-striped display responsive nowrap">
						<thead>
							<tr>
								<!-- th><span class="checkbox custom-checkbox check-all">
									<input type="checkbox" name="checkall_ortu" id="check-all-siswa">
									<label for="check-all">&nbsp;&nbsp;</label></span> </th> -->
								<th>No</th>
								<th>Nama Pengguna Orang Tua</th>
								<th>Nama Orang Tua</th>
								<th>Nama Pengguna Siswa</th>
								<th>Nama Siswa</th>
								<th>Aksi</th>
							</tr>
						</thead>

						<tbody id="record_daftar_Ortu">

						</tbody>
					</table>
						<!-- div pagination daftar ortu -->
					  <div class="col-md-12">
					  	<ul class="pagination pagination-ortu">

					  	</ul>
					  </div>
   					<!-- div pagination daftar ortu -->
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	// attr Siswa
	var meridian_siswa = 4;
	var prev_siswa=1;
	var next_siswa=2;
	var records_per_page_siswa=10;
	var page_siswa=0;
	var pageVal_siswa;
	var keySearch_siswa='';
	var pageSelek_siswa=0;
	var tb_siswa;
	var pagination_siswa;
	// attr ortu
	var meridian_ortu = 4;
	var prev_ortu=1;
	var next_ortu=2;
	var records_per_page_ortu=10;
	var page_ortu=0;
	var pageVal_ortu;
	var keySearch_ortu='';
	var pageSelek_ortu=0;
	var tb_ortu;
	var pagination_ortu;
	$(document).ready(function(){
		// set record siswa
		function set_tb_siswa(){
			var url = base_url+"ortuback/ajax_siswa_not_ortu"
			var datas ={records_per_page_siswa:records_per_page_siswa,pageSelek_siswa:pageSelek_siswa,keySearch_siswa:keySearch_siswa};
			$.ajax({
				url:url,
				data:datas,
				dataType:"text",
				type:"post",
				success:function(Data){
					set_pagination_siswa();
					$('#record_daftar_siswa').empty();
					tb_siswa = JSON.parse(Data);
        			$('#record_daftar_siswa').append(tb_siswa);
				}
			});
		}
		set_tb_siswa();
		//set paginatiaon tabel siswa
		function set_pagination_siswa(){
			var url = base_url+"ortuback/pagination_siswa_not_ortu"
			var datas ={records_per_page_siswa:records_per_page_siswa,pageSelek_siswa:pageSelek_siswa,keySearch_siswa:keySearch_siswa};
			$.ajax({
				url:url,
				data:datas,
				dataType:"text",
				type:"post",
				success:function(Data){
					$('.pagination-siswa').empty();
					 pagination_siswa = JSON.parse(Data);
        	$('.pagination-siswa').append(pagination_siswa);
				}
			});
		}
		
		function set_tb_ortu(){
			var url = base_url+"ortuback/ajax_ortu"
			var datas ={records_per_page_ortu:records_per_page_ortu,pageSelek_ortu:pageSelek_ortu,keySearch_ortu:keySearch_ortu};
			$.ajax({
				url:url,
				data:datas,
				dataType:"text",
				type:"post",
				success:function(Data){
					$('#record_daftar_Ortu').empty();
					 tb_ortu = JSON.parse(Data);
        	$('#record_daftar_Ortu').append(tb_ortu);
        	set_pagination_ortu();
				}
			});
		}
		set_tb_ortu();
		function set_pagination_ortu(){
				var url = base_url+"ortuback/pagination_ortu"
			var datas ={records_per_page_ortu:records_per_page_ortu,pageSelek_ortu:pageSelek_ortu,keySearch_ortu:keySearch_ortu};
			$.ajax({
				url:url,
				data:datas,
				dataType:"text",
				type:"post",
				success:function(Data){
					 pagination_ortu = JSON.parse(Data);
					 $('.pagination-ortu').empty();
        			$('.pagination-ortu').append(pagination_ortu);
				}
			});
		}
		
		$("#add-ortu").click(function(){
			$("#panel-ortu").removeClass("hidden");
		});
		$("#hide-tbSiswa").click(function(){
			$("#panel-ortu").addClass("hidden");
		});

		$("[name=records_per_page_siswa]").change(function(){
			records_per_page_siswa=$("[name=records_per_page_siswa]").val();
			set_tb_siswa();
		});

		$("[name=records_per_page_ortu]").change(function(){
			records_per_page_ortu=$("[name=records_per_page_ortu]").val();
			set_tb_ortu();
		});

		// event onclick cari siswa
		$("#cariSiswa").click(function () {
			keySearch_siswa = $("[name=cariSiswa]").val();
			set_tb_siswa();
		});


		// event onclick cari ortu
		$("#cariOrtu").click(function () {
			keySearch_ortu = $("[name=cariOrtu]").val();
			set_tb_ortu();
		});
		// $("[name=cariOrtu]").change(function () {
		// });

	});

	function selectPageSiswa(pageValSiswa='0') {
      page_siswa=pageValSiswa;
  pageSelek_siswa=page_siswa*records_per_page_siswa;
    $('#record_daftar_siswa').empty();
    var url = base_url+"ortuback/ajax_siswa_not_ortu"
    var datas ={records_per_page_siswa:records_per_page_siswa,pageSelek_siswa:pageSelek_siswa,keySearch_siswa:keySearch_siswa};
    $.ajax({
    	url:url,
    	data:datas,
    	dataType:"text",
    	type:"post",
    	success:function(Data){
    		tb_siswa = JSON.parse(Data);
    		$('#record_daftar_siswa').append(tb_siswa);
    	}
    });
     //meridian adalah nilai tengah padination
 $('#pageSiswa-'+meridian_siswa).removeClass('active');
  var newMeridian=page_siswa+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prev-siswa").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian_siswa-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prevSiswa=1;
    nextSiswa=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridian_siswa){
    $("#page-prev-siswa").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridian_siswa;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridian_siswa-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#pageSiswa-'+idPaginationhide;
          showPagination='#pageSiswa-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
                idPaginationshow--;
          idPaginationhide++;
        }
  }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian_siswa-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridian_siswa+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
            idPaginationshow++;
      idPaginationhide--;
    }
  } 
   prev_siswa=newMeridian-2;
   next_siswa=newMeridian;
   meridian_siswa=newMeridian;
   $('#pageSiswa-'+meridian_siswa).addClass('active');
}
function nextPageSiswa() {
  selectPageSiswa(next_siswa);
}
// prev page
function prevPageSiswa() {
  selectPageSiswa(prev_siswa);
}
function nextPageOrtu() {
  selectPageOrtu(next_ortu);
}
// prev page
function prevPageOrtu() {
  selectPageOrtu(prev_ortu);
}

function selectPageOrtu(pageValOrtu='0') {
  page_ortu=pageValOrtu;
  pageSelek_ortu=page_ortu*records_per_page_ortu;
  $('#record_daftar_Ortu').empty();
  var url = base_url+"ortuback/ajax_ortu"
  var datas ={records_per_page_ortu:records_per_page_ortu,pageSelek_ortu:pageSelek_ortu,keySearch_ortu:keySearch_ortu};
		$.ajax({
			url:url,
			data:datas,
			dataType:"text",
			type:"post",
			success:function(Data){
				tb_ortu = JSON.parse(Data);
    		$('#record_daftar_Ortu').append(tb_ortu);
    	
			}
		});
     //meridian adalah nilai tengah padination
  $('#pageSiswa-'+meridian_ortu).removeClass('active');
  var newMeridian=page_ortu+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prev-ortu").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian_ortu-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prev_ortu=1;
    next_ortu=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageOrtu-'+idPaginationhide;
      showPagination='#pageOrtu-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridian_ortu){
    $("#page-prev-ortu").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridian_ortu;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridian_ortu-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#pageOrtu-'+idPaginationhide;
          showPagination='#pageOrtu-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
                idPaginationshow--;
          idPaginationhide++;
        }
  }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian_ortu-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridian_ortu+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageOrtu-'+idPaginationhide;
      showPagination='#pageOrtu-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
            idPaginationshow++;
      	idPaginationhide--;
    }
  } 
   prev_ortu=newMeridian-2;
   next_ortu=newMeridian;
   meridian_ortu=newMeridian;
   $('#pageOrtu-'+meridian_ortu).addClass('active');
}

function add_ortu(){
	id_siswa = [];
	$('.daftarsiswa tbody td :checkbox:checked').each(function(i){
     id_siswa[i] = $(this).val();
   }); 
	var jumlah_siswa=id_siswa.length;
	if (jumlah_siswa==0) {
		sweetAlert("Oops","Silahkan pilih siswa","error");
	} else if(jumlah_siswa>0) {
		var url = base_url+"ortuback/set_ortu";
			$.ajax({
			url:url,
			data:{id_siswa:id_siswa},
			dataType:"text",
			type:"post",
			success:function(Data){
				selectPageSiswa(pageValSiswa='0');
				selectPageOrtu(pageValOrtu='0');
				
				sweetAlert("OK","Data Orang Tua Berhasil Ditambahkan.","success");
			},
			error:function(){

			}
		});
	}
}

//reset katasandi pengguna ortu
function reset_pswd_ortu(id,namaPengguna){
	 swal({
        title: "Yakin akan me-reset katasandi "+namaPengguna+"?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap me-reset katasandi!",
        closeOnConfirm: false
      },
      function(){
      	var url = base_url+"ortuback/reset_kataSandi_ortu";
      	$.ajax({
      		url:url,
      		data:{id:id,namaPengguna:namaPengguna},
      		dataType:"text",
      		type:"post",
      		success:function(Data){
      		swal("kata sandi baru : [namaPengguna]+[tgl sekarang] !", "Katasandi Baru = "+Data, "success");
      		},
      		error:function(){

      		}
      	});
      });
	
}

function del_ortu(id,namaPengguna){

	swal({
		title: "Yakin akan menghapus "+namaPengguna+"?",
		text: "Anda tidak dapat membatalkan ini.",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var url = base_url+"ortuback/del_pengguna_ortu";
		$.ajax({
			url:url,
			data:{id:id},
			dataType:"text",
			type:"post",
			success:function(){
				 selectPageOrtu(pageValOrtu='0');
				sweetAlert("Data berhasil di hapus","","success");
			},
			error:function(){

			}
		});
	});
	
}


	$('[name="checkall_siswa"]:checkbox').click(function () {
	 if($(this).attr("checked")){
	  $('table.daftarsiswa tbody input:checkbox').prop( "checked", true );
		} else{ 
		  $('table.daftarsiswa tbody input:checkbox').prop( "checked", false );
		}
	});
</script>