<section>
	<div class="row">
		<div class="col-md-12">
			<!-- div panel -->
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h3 class="panel-title">Daftar Admincabang</h3>
					<div class="panel-toolbar text-right">
              	<a href="<?=base_url()?>admincabangback/tambah_admincabang" class="btn btn-success" title="Tambah Admincabang"><i class="ico-plus"></i></a>
              </div>
				</div>
				<div class="panel-body">
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
					<table class="daftarAdmin table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pengguna</th>
								<th>Mail</th>
								<th>Cabang</th>
								<th>Tanggal Terdaftar</th>
								<th>Aksi</th>
							</tr>
						</thead>

						<tbody id="record_daftar_admin">

						</tbody>
					</table>
					  <!-- div pagination daftar token -->
					  <div class="col-md-12">
					  	<ul class="pagination pagination-admincabang">

					  	</ul>
					  </div>
   					<!-- div pagination daftar token -->
				</div>
			</div>
			<!-- div panel -->
		</div>
	</div>
</section>


<script type="text/javascript">
	
	var url = base_url+"admincabangback/ajax_list_admincabang";
	var urlPagination = base_url+"admincabangback/pagination_admincabang";
	//pp table pagination
	var tb_admincabang = "belim masuk";
	var pagination_admincabang;
	var meridian = 4;
	var prev=1;
  	var next=2;
  	var records_per_page=10;
    var page=0;
  	var pageVal;
  	var keySearch='';
   	var pageSelek=0;


	$(document).ready(function(){

		function set_tb_admincabang(){
			datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
			$.ajax({
				url:url,
				data:datas,
				dataType:"text",
				type:"post",
				 success:function(Data)
        		{
        	// set emty tabel 
        	$('#record_daftar_admin').empty();
          tb_admincabang = JSON.parse(Data);
          //set tabel
          $('#record_daftar_admin').append(tb_admincabang);
        },
        error:function(){

        },
			});	
		}
		set_tb_admincabang();
		function set_pagination(){
			datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
			$.ajax({
				url:urlPagination,
				data:datas,
				dataType:"text",
				type:"post",
				success:function(Data)
				{
					$(".pagination-admincabang").empty();
					pagination_admincabang = JSON.parse(Data);
					$(".pagination-admincabang").append(pagination_admincabang);
				},
				error:function(){

				},
			});
			
		}
		set_pagination();

		// even record per page
		$("[name=records_per_page]").change(function(){
			 meridian = 4;
			 prev=1;
			 next=2;
			 page=0;
			 keySearch='';
			 pageSelek=0;
			records_per_page=$("[name=records_per_page]").val();
			set_tb_admincabang();
			set_pagination();
		});

		//even tombol pencarian
		$("#cariDat").click(function(){
			
			keySearch=$("[name=cariDat]").val();
			set_tb_admincabang();
			set_pagination();
		});
	});

	function restKatasandi(id_pengguna='',namaPengguna=''){
		swal({
			title: "Yakin akan mereset katasandi Akun "+namaPengguna+" ?",
			text: "Anda tidak dapat membatalkan ini.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya,Tetap Reset!",
			closeOnConfirm: false
		},
		function(){
			var urlReset=base_url+"admincabangback/reset_katasandid_admincabang";
			var datasReset={id_pengguna:id_pengguna,namaPengguna:namaPengguna};
			// ajax hapus akun admincabang
			$.ajax({
				url:urlReset,
				data:datasReset,
				type:"post",
				dataType:"text",
				success:function(Data){
					var newPassword = JSON.parse(Data);
					            swal("kata sandi baru : [namaPengguna]+[tgl sekarang] !", "Katasandi Baru = "+newPassword, "success");
				},
				error:function(){
					  sweetAlert("Oops...", "Data gagal t6ereset!", "error");
				}
			});
		});
	}

	function hapusAkun(id_pengguna='',idCabang=''){
		swal({
			title: "Yakin akan hapus Akun ini?",
			text: "Anda tidak dapat membatalkan ini.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya,Tetap hapus!",
			closeOnConfirm: false
		},
		function(){
			var urlHapus=base_url+"admincabangback/del_admincabang";
			// ajax hapus akun admincabang
			$.ajax({
				url:urlHapus,
				data:{id_pengguna:id_pengguna,idCabang:idCabang},
				type:"post",
				dataType:"text",
				success:function(Data){
					selectPage();
					swal("Terhapus!", "Akun berhasil dihapus.", "success");
				},
				error:function(){
					  sweetAlert("Oops...", "Data gagal terhapus!", "error");
				}
			});
			 
		});
	}

	// next page
	function nextPage() {
		selectPage(next);
	}
	// prev page
	function prevPage() {
		selectPage(prev);
	}

	function selectPage(pageVal='0'){
		page=pageVal;
	  	pageSelek=page*records_per_page;

	  	datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
				$.ajax({
					url:url,
					data:datas,
					dataType:"text",
					type:"post",
					 success:function(Data)
	        {
	        	// set emty tabel 
	        	$('#record_daftar_admin').empty();
	          tb_admincabang = JSON.parse(Data);
	          //set tabel
	          $('#record_daftar_admin').append(tb_admincabang);
	        },
	        error:function(){

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
</script>
