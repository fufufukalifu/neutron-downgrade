<section id="main">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h3 class="panel-title">Export Data Excl</h3>
					<!-- dropdown cabang -->
					<div class="panel-toolbar text-right">
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-default">Template Excel</button>
						</div>
					</div>
					<!-- / dropdown cabang -->
				</div>
				<div class="panel-body">
					<div>
						<!-- div form input file excel -->
						<div class="col-md-12">
							<form class="form">
								<div class="form-group">
									<div class="input-group">
										<!-- <button type="button" class="btn btn-sm btn-default">Pilih Cabang</button> -->
										<!-- <input  class="form-control" type="file" name="dat_excel" id="xlf"> -->
										<div class="col-sm-2  mt10	">
											<select  class="form-control" name="cabangID" id="op_cabang">
												<!-- <option value="10" selected="true">records per page</option> -->
												<option >Pilih Cabang</option>
											</select>
										</div>
										<div class="col-sm-6 mt10">
											<label for="xlf" class="btn btn-sm btn-default">
												Upload File Excel
											</label>
											<input id="xlf" style="display:none;" type="file" name="dat_excel" >
											<label class="btn btn-sm btn-danger hide" onclick="rest_file()" id="reset_file">Reset File Excel</label>
										</div>
									</div>
								</div>
							</form>

						</div>
						<!-- div priview data exporter-->
						<!-- div tabel priview data excel -->
						<div class="col-md-12">
							<h3 class="" id="name_tb"></h3>
							<table class="table table-striped display responsive nowrap" style="font-size: 13px" width=100% id="record_priview">
								<thead>
									<tr>
										<th>No</th>
										<th>No Induk neutron</th>
										<th>Nama Depan</th>
										<th>Nama Belakang</th>
										<th>Alamat</th>
										<th>Tanggal Lahr</th>
										<th>Email</th>
										<th>No Kontak</th>
										<th>Nama Sekolah</th>
										<th>Alamat Sekolah</th>
										<th>No Kontak Sekolah</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							<tfoot>
								<tr>
										<th>No</th>
										<th>No Induk neutron</th>
										<th>Nama Depan</th>
										<th>Nama Belakang</th>
										<th>Alamat</th>
										<th>Tanggal Lahr</th>
										<th>Email</th>
										<th>No Kontak</th>
										<th>Nama Sekolah</th>
										<th>Alamat Sekolah</th>
										<th>No Kontak Sekolah</th>
									</tr>
							</tfoot>
							</table>
						</div>
						<!-- div tabel priview data excel -->
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-sm btn-primary" id="btn-import">Import Data</button>
				</div>
			</div>
		</div>
	</div>
</section>
	<script type="text/javascript" src="<?=base_url()?>assets/library/jquery/js/xlsx.full.min.js"></script>
	<!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<!-- /Script ajax upload -->
<script type="text/javascript">
	var datImport;
	var cabangID='';
$(document).ready(function(){
	$("#xlf").change(function(){
		$name_xlsx=$("#xlf")[0].files[0]['name'];
		$("#name_tb").html($name_xlsx);
		upload_data_xlsx();
	});

	$("#btn-import").click(function(){
		if (cabangID != '' && cabangID != ' ') {
			// post_export_user();
			swal("bbb","Siss", "success");
		}else{
			swal("Oops","Silahkan Pilih Cabang", "error");
		}
		
	});

	$("select[name=cabangID]").change(function(){
		cabangID=$("select[name=cabangID]").val();
	});

	set_op_cabang();
});

// set cabang option
function set_op_cabang(){
	var url_cabang=base_url+"import_user/get_cabang";
	$.ajax({
			url:url_cabang,
			type:"post",
			dataType:"text",
			success:function(Data){
				var ob_data = JSON.parse(Data);
				var sc = '';
    $.each(ob_data, function (key, val) {
        sc += '<option value="' + val.id + '">' + val.namaCabang + '</option>';
    });
    $("#op_cabang option").remove();
    $("#op_cabang").append(sc);
			},
			error:function(){
				console.log("ada kesalahan");
			}
		});
}


function upload_data_xlsx(){
	var url_upload=base_url+"import_user/upload_xlsx";
	// var dat_excel = $("input[name=dat_excel]").val();
	// var datas = {dat_excel:dat_excel};
	$.ajaxFileUpload({
		url : url_upload,
		type: "post",
		// data: datas,
		fileElementId :"xlf",
		dataType: "text",
		success:function(Data){
			var ob_data=JSON.parse(Data);
			console.log(ob_data);
			 read_data_xlsx(ob_data);
		},
		error:function(){
			console.log("ada kesalahan");
		}
	});
}

	//  function export excel
	function read_data_xlsx(xlsx) {
		/* set up XMLHttpRequest */
		// var url_file =$("input[name=dat_excel]").val();
		var url_file =base_url+"assets/excel/"+xlsx;
		var oReq = new XMLHttpRequest();
		oReq.open("GET", url_file, true);
		oReq.responseType = "arraybuffer";

		oReq.onload = function(e) {
					var arraybuffer = oReq.response;
		console.log(arraybuffer);
			/* convert data to binary string */
			var data = new Uint8Array(arraybuffer);
			var arr = new Array();
			for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
				var bstr = arr.join("");

			/* Call XLSX */
			var workbook = XLSX.read(bstr, {type:"binary"});

			/* DO SOMETHING WITH workbook HERE */
			var first_sheet_name = workbook.SheetNames[0];
			/* Get worksheet */
			var worksheet = workbook.Sheets[first_sheet_name];
			// console.log(XLSX.utils.sheet_to_json(worksheet));
			// data json hasil exp
			this.datArr=XLSX.utils.sheet_to_json(worksheet);
	
			preview_import(this.datArr);

		}
		oReq.send();	
	}


	function preview_import(datArr){
		datImport=datArr;
			var records_tb = [];
			var no=1;
			var i =0;
			  $.each(datImport, function (key, val) {
        records_tb [i] = [no,val.noIndukNeutron,val.namaDepan,val.namaBelakang,val.alamat,val.tgl_lahir,val.eMail,val.noKontak,val.namaSekolah,val.alamatSekolah,val.noKontakSekolah];
        no++;
         i++;
    		});
			 $('#record_priview').DataTable( {
        data: records_tb
   		 });
	}

	function post_export_user(){
		var url=base_url+"import_user/set_siswa_batch";
		var datas={datImport:datImport,cabangID:cabangID};
		$.ajax({
			url:url,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(Data){
				var ob_data=JSON.parse(Data);
				console.log(ob_data);
				swal("berhasil!",ob_data, "success");
			},
			error:function(){
				console.log("ada kesalahan");
			}
		});
	}
	// End function export excel
</script>