<section id="main">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h3 class="panel-title">Export Data Excl</h3>
				</div>
				<div class="panel-body">
					<!-- div form input file excel -->
					<div class="col-md-12">
						<form class="form">
							<input type="file" name="dat_excel">
						</form>
						<button class="btn btn-primary" onclick="get_dat_excel()">Test</button>
						<button class="btn btn-primary" onclick="post_export_user()">Test2</button>
					</div>
					<!-- div priview data exporter-->
					<div class="col-md-12">
						<table class="tabel table-bordered">
							<thead>
								<th>
									
								</th>
							</thead>
						</table>
						<p id="test"> ss</p>
					</div>
				</div>
				<div class="panel-footer">
					
				</div>
			</div>
		</div>
	</div>
</section>
	<script type="text/javascript" src="<?=base_url()?>assets/library/jquery/js/xlsx.full.min.js"></script>
<script type="text/javascript">
	var datArr;
$(document).ready(function(){
	$("input[name=dat_excel]").change(function(){
		console.log("oye");
		// var filePath = $(this).val();
  //           console.log(filePath);
		get_dat_excel();
	});
});
	//  function export excel
	function get_dat_excel() {
		/* set up XMLHttpRequest */
		var url_file =base_url+"assets/test.xlsx";
		var oReq = new XMLHttpRequest();
		oReq.open("GET", url_file, true);
		oReq.responseType = "arraybuffer";

		oReq.onload = function(e) {
					var arraybuffer = oReq.response;

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
			// $("#test").append(datArr);

			// console.log(this.datArr);
				post_export_user(this.datArr);

		}
		oReq.send();	
	}
	function post_export_user(datArr){
		console.log(datArr);
		var url=base_url+"export_user/set_siswa_batch";
		var datas={datArr:datArr};
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