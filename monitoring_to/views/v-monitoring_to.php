<section id="main">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<!-- header panel -->
				<div class="panel-heading">
					<h3 class="panel-title"><button onclick="set_sum_page()">test</button></h3>
					
				</div>
				<!-- /panel header -->
				<!-- /body panel -->
				<div class="panel-body">
					<div class="row mb10">
						<!-- seting record per page -->
						<div class="col-md-2">
							<div  class="form-group">
								<select  class="form-control" name="records_per_page">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
						<!-- pencarian berdasarkan no cbt / no induk neutron -->
						<div class="col-md-10">
							<form action="javascript:void(0);">
							<div class="input-group">
								<span class="input-group-addon btn" id="cariSiswa"><i class="ico-search"></i></span>
								<input class="form-control" type="text" name="cariSiswa" placeholder="Cari no CBT">
							</div>
							</form>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>No CBT</th>
								<th>Nama</th>
								<th>Tingkat</th>
								<th>Kurikulum</th>
								<th>Cabang</th>
								<th>Nama Tryout</th>
								<th>Nama Paket</th>
								<th>Status Pengerjaan</th>
							</tr>
						</thead>
						<tbody id="tb-monitoring">
							
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>
									<div  class="form-group">
										<select  class="form-control" name="tingkat_op">   
										</select>
									</div>
								</th>
								<th>
									<div  class="form-group">
										<select  class="form-control" name="kurikulum_op">   
										</select>
									</div>
								</th>
								<th>
									<div  class="form-group">
										<select  class="form-control" name="cabang_op">   
										</select>
									</div>
								</th>
								<th>
									<div  class="form-group">
										<select  class="form-control" name="tryout_op">   
										</select>
									</div>
								</th>
								<th> 
									<div  class="form-group">
										<select  class="form-control" name="paket_op">   
										</select>
									</div>
								</th>
								<th>
									<div  class="form-group">
										<div class="btn-group">
											<button class="btn btn-sm btn-danger active" onclick="ch_status(0)"><i class=" ico-exclamation-sign"></i></button>
											<button class="btn btn-sm btn-success" onclick="ch_status(1)"><i class=" ico-ok-sign"></i></button>
										</div>
									</div>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- body panel -->
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var kurikulum = "all";
	var tingkat = "all";
	var cabang = "all";
	var tryout = "all";
	var paket = "all";
	var status_pengerjaan = 0;
	var per_page = 10;
	var keysearch = null;

	//page 0 = page halaman pertama
	var page = 0;
	$(document).ready(function () {
		//set option filtering
		set_monitoring();
		set_op_tingkat();
		set_op_kurikulum();
		set_op_cabang();
		set_sum_page();
		sum_page();

		//event filter by kurikulum
		$("select[name=kurikulum_op]").change(function(){
			kurikulum=$("select[name=kurikulum_op]").val();
			$("#tb-monitoring").empty();
			//relode tb monitoring
			set_monitoring();
		});
		// event filter by tingkat
		$("select[name=tingkat_op]").change(function(){
			tingkat=$("select[name=tingkat_op]").val();
			$("#tb-monitoring").empty();
			//relode tb monitoring
			set_monitoring();
		});
		//event filter by cabang
		$("select[name=cabang_op]").change(function(){
			cabang=$("select[name=cabang_op]").val();
			$("#tb-monitoring").empty();
			 relode_to();
			//relode tb monitoring
			set_monitoring();
		});
		//event filter by tryout
		$("select[name=tryout_op]").change(function(){
			tryout=$("select[name=tryout_op]").val();
			$("#tb-monitoring").empty();
			// emty option paket
			$("select[name=paket_op]").empty();
			// set option paket
			set_op_paket();
			//relode tb monitoring
			set_monitoring();
		});
		//event filter by paket
		$("select[name=paket_op]").change(function(){
			paket=$("select[name=paket_op]").val();
			$("#tb-monitoring").empty();
			//relode tb monitoring
			set_monitoring();
		});
		//event untuk menngubah  jumlah record per halaman
		$("select[name=records_per_page]").change(function(){
			per_page=$("select[name=records_per_page]").val();
			$("#tb-monitoring").empty();
				set_monitoring();
		});
		//event pencarian siswa berdasarkan no cbt / no induk neutron
		$("#cariSiswa").click(function(){
			keysearch=$("input[name=cariSiswa]").val();
			$("#tb-monitoring").empty();
				set_monitoring();
		});
		$('input[name = cariSiswa]').click(function(){
			console.log("enter");
		});
	});
	// filter siswa berdasarkan status pengerjaan
	function ch_status(dat){
		status_pengerjaan = dat;
		$("#tb-monitoring").empty();
		set_monitoring();
	}
	function relode_to(){
		tryout = "all";
		paket = "all";
		$("select[name=tryout_op]").empty();
		$("select[name=paket_op]").empty();
		status_pengerjaan = 0;
		set_op_tryout();
	}
	// set tabel monitoring siswa
	function set_monitoring() {
		var url_post = base_url+"monitoring_to/ajax_siswa_to";
		var datas = {kurikulum:kurikulum,tingkat:tingkat,cabang:cabang,tryout:tryout,paket:paket,status_pengerjaan:status_pengerjaan,per_page:per_page,page:page,keysearch:keysearch};
		$.ajax({
			url:url_post,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				// console.log(dat_retrun);
				var ob_data = JSON.parse(dat_retrun);
					$("#tb-monitoring").append(ob_data);
			},
		});
	}

	function set_op_tingkat(){
		var url_post = base_url+"monitoring_to/op_tingkat";
		$.ajax({
			url:url_post,
			// data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				// console.log(dat_retrun);
				var ob_data = JSON.parse(dat_retrun);
					$("select[name=tingkat_op]").append(ob_data);
			},
		});
	}

	function set_op_kurikulum(){
		var url_post = base_url+"monitoring_to/op_kurikulum";
		$.ajax({
			url:url_post,
			// data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				// console.log(dat_retrun);
				var ob_data = JSON.parse(dat_retrun);
					$("select[name=kurikulum_op]").append(ob_data);
			},
		});
	}

	function set_op_cabang(){
		var url_post = base_url+"monitoring_to/op_cabang";
		$.ajax({
			url:url_post,
			// data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				var ob_data = JSON.parse(dat_retrun);
					$("select[name=cabang_op]").append(ob_data);
			},
		});
	}

	function set_op_tryout(){
		var url_post = base_url+"monitoring_to/op_tryout";
		var datas = {cabang:cabang};
		$.ajax({
			url:url_post,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				// console.log(dat_retrun);
				var ob_data = JSON.parse(dat_retrun);
					$("select[name=tryout_op]").append(ob_data);
			},
		});
	}
function set_op_paket(){
		var url_post = base_url+"monitoring_to/op_paket";
		$.ajax({
			url:url_post,
			data:{tryout:tryout},
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				var ob_data = JSON.parse(dat_retrun);
					$("select[name=paket_op]").append(ob_data);
			},
		});
	}
function set_sum_page(){
	var url_post = base_url+"monitoring_to/sum_page_monitoring";
			var datas = {kurikulum:kurikulum,tingkat:tingkat,cabang:cabang,tryout:tryout,paket:paket,status_pengerjaan:status_pengerjaan,per_page:per_page,page:page,keysearch:keysearch};
		$.ajax({
			url:url_post,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(dat_retrun){
				var ob_data = JSON.parse(dat_retrun);
				sum_page = ob_data;
			},
		});
}

function pagination(){

	
}


</script>