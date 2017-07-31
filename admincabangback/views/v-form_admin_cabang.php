<section>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<!-- Form horizontal layout bordered -->
			<form class="panel" name="form-register" action="javascript:void(0)">
				<ul class="list-table pa15">
					<li>
						<!-- Alert message -->
						<div class="alert alert-warning nm">
							<span class="semibold">Catatan :</span>&nbsp;&nbsp;Tolong disi data dibawah ini dengan benar dan terurut.
						</div>
						<!--/ Alert message -->
					</li>
					<li class="text-right" style="width:20px;"><a href="javascript:void(0);"><i class="ico-question-sign fsize16"></i></a></li>
				</ul>
				<hr class="nm">
				<div class="panel-body">
					<div class="form-group" id="namaPengguna">
						<label class="control-label">Nama Pengguna</label>
						<div class="input-group">
							<div class="has-icon pull-left">
								<input type="text" class="form-control" name="username" data-parsley-required="">
								<i class="ico-user2 form-control-icon"></i>
							</div>
							<span class="input-group-addon btn" id="cekNamaPengguna" ><i class="ico-ok"></i></span>
						</div>
						<span class="hidden" style="color:red;" id="error-msg-username">*Namapengguna minimal 8 karakter</span>
						<span class="hidden" style="color:#41CC54;" id="success-msg-username">*Namapengguna dapat dipakai</span>
					</div>
					<div class="form-group" id="pass">
						<label class="control-label">Katasandi</label>
						<div class="has-icon pull-left">
							<input type="password" class="form-control" name="password" data-parsley-required="" disabled="true">
							<i class="ico-key2 form-control-icon"></i>
						</div>
							<span class="hidden" style="color:red;" id="error-msg-pass">*katasandi minimal 8 karakter</span>
					</div>
					<div class="form-group" id="re-pass">
						<label class="control-label">Ulangi Katasandi</label>
						<div class="has-icon pull-left">
							<input type="password" class="form-control" name="retype-password" data-parsley-equalto="input[name=password]" disabled="true">
							<i class="ico-asterisk form-control-icon"></i>
						</div>
						<span class="hidden" style="color:red;" id="error-msg-repass">*katasandi tidak sama</span>
					</div>
					<div class="form-group">
						<label class="control-label">Cabang</label>
						<div class="has-icon pull-left">
							<i class="ico-asterisk form-control-icon"></i>
							<select name="cabang" class="form-control">
								<option value="">Select cabang</option>
								<?=$cabang;?>
							</select>
						</div>
					</div>
<!-- 					<div class="form-group">
						<label class="control-label">Email</label>
						<div class="has-icon pull-left">
							<input type="email" class="form-control" name="email" data-parsley-equalto="input[name=password]" disabled="true">
							<i class="ico-mail form-control-icon"></i>
						</div>
					</div> -->
					<div class="form-group" id="email">
						<label class="control-label">Email</label>
						<div class="input-group">
							<div class="has-icon pull-left">
								<input type="email" class="form-control" name="email" data-parsley-required="" disabled="true">
								<i class="ico-mail form-control-icon"></i>
							</div>
							<span class="input-group-addon btn" id="cekEmail" ><i class="ico-ok"></i></span>
						</div>
						<span class="hidden" style="color:#41CC54;" id="success-msg-email">*Email dapat dipakai</span>
						<span class="hidden" style="color:red;" id="error-msg-email">*Email sudah dipakai</span>
					</div>

				</div>
				<!-- end panel body -->
<!-- 				<hr class="nm">
				<div class="panel-body">
					<p class="semibold text-muted">To confirm and activate your new account, we will need to send the activation code to your e-mail.</p>
					<div class="form-group">
						<label class="control-label">Email</label>
						<div class="has-icon pull-left">
							<input type="email" class="form-control" name="email" placeholder="you@mail.com">
							<i class="ico-envelop form-control-icon"></i>
						</div>
					</div>

				</div> -->
				<div class="panel-footer">
					<button class="btn btn-block btn-success" disabled="true"><span class="semibold">Simpan</span></button> 
				</div>
			</form>
			<!--/ Form horizontal layout bordered -->
		</div>

	</div>
</section>
<script type="text/javascript">
var password;
var retype_password;
	$(document).ready(function(){
	 	$(".btn-success").click(function(){
	 		// admin_cabang
	 		
	 		var username = $("[name=username]").val();
	 		var password = $("[name=password]").val();
	 		var cabang = $("[name=cabang]").val();
	 		var email = $("[name=email]").val();
	 		var datas = {username:username,cabang:cabang,email:email,password:password};
	 		if (username!='' && username!=' ' && cabang!='' && cabang!=' ' && email!='' && email!=' ' && password!=' ' && password!='') {
	 					sendData(datas);
	 		} else {
	 			 sweetAlert("Oops...", "Tolong data diisi semua!", "error");
	 		}
	 		
	 	});

	 	function sendData(datas){
	 		var url=base_url+"admincabangback/add_admincabang";
	 		console.log("inininini");
	 		$.ajax({
	 			url:url,
	 			data:datas, 
	 			dataType:"text",
	 			type:"post",
	 			success:function()
	 			{
	 			$(location).attr('href', base_url+'admincabangback/list_admincabang');
	 			},
	 			error:function(){

	 			}
	 		});
	 	}
	 	 	$('#cekEmail').click(function(e){	
	 	 		var email = $("[name=email]").val();
	 	 		var url=base_url+"admincabangback/cek_email";
	 			// ajax untuk cek namaPengguna
	 			$.ajax({
	 				url:url,
	 				data:{email:email},
	 				type:"post",
	 				dataType:"text",
	 				success:function(Data){
	 					var cek_email = JSON.parse(Data);
	 					if (cek_email=="true") {
	 						// jika namaPengguna belum terpakai 
	 						$('#email').removeClass("has-error");
	 						$('#email').addClass("has-success");
	 						$("#success-msg-email").removeClass("hidden");
	 						$("#error-msg-email").addClass("hidden");
	 						$('.btn-success').prop('disabled', false);
	 					} else {
	 						// jika namaPengguna sudah terpakai
	 						$('#email').removeClass("has-success");
	 						$('#email').addClass("has-error");
	 						$("#success-msg-email").addClass("hidden");
	 						$("#error-msg-email").removeClass("hidden");
	 						$('.btn-success').prop('disabled', true);
	 					}
	 				},

	 			});
	 	});
	 	$('#cekNamaPengguna').click(function(e){	
	 		var jumlah_karakter=cekKarakter();
	 			if (jumlah_karakter=="true") {
	 				cekNamapengguna();
	 			}
	 	});
	 	function cekNamapengguna(){
	 		var username = $("[name=username]").val();
	 			var url=base_url+"admincabangback/cek_namaPengguna";
	 			// ajax untuk cek namaPengguna
	 			$.ajax({
	 				url:url,
	 				data:{username:username},
	 				type:"post",
	 				dataType:"text",
	 				success:function(Data){
	 					var cek_namaPengguna = JSON.parse(Data);
	 					if (cek_namaPengguna=="true") {
	 						// jika namaPengguna belum terpakai 
	 						$('#namaPengguna').removeClass("has-error");
	 						$('#namaPengguna').addClass("has-success");
	 						$("#success-msg-username").removeClass("hidden");
	 						$("#error-msg-username").addClass("hidden");
	 						$('[name=password]').prop('disabled', false);
	 					} else {
	 						// jika namaPengguna sudah terpakai
	 						$('#namaPengguna').removeClass("has-success");
	 						$('#namaPengguna').addClass("has-error");
	 						$("#success-msg-username").addClass("hidden");
	 						$("#error-msg-username").removeClass("hidden");
	 						$('[name=password]').prop('disabled', true);
	 					}
	 				},

	 			});
	 	}
	 	// even cek panjang karakter nama pengguna
	 	$('[name=username]').on('keyup',function(e){	
	 		cekKarakter();
	 		
	 	});
	 	function cekKarakter(){
	 		var pass=$('[name=username]').val();
	 		var lengthCahar=pass.length;
	 		if (lengthCahar>7) {
	 			// jika karakter lebih dari 7
	 			$('#namaPengguna').removeClass("has-error");
	 			$("#error-msg-username").addClass("hidden");
	 			return("true");
	 		} else {
	 			// jika karakter kurang dari 7
	 			$('#namaPengguna').addClass("has-error");
	 			$("#error-msg-username").removeClass("hidden");
	 			return("false");
	 		}
	 	}
	 	$('[name=password]').on('keyup',function(e){	
	 		var pass=$('[name=password]').val();
	 		var lengthCahar=pass.length;
	 		if (lengthCahar>7) {
	 			$('#pass').removeClass("has-error");
	 			$('#pass').addClass("has-success");
	 			$("#error-msg-pass").addClass("hidden");
	 			$('[name=retype-password]').prop('disabled', false);
	 		} else {
	 			$('#pass').removeClass("has-success");
	 			$('#pass').addClass("has-error");
	 			$("#error-msg-pass").removeClass("hidden");
	 			$('[name=retype-password]').prop('disabled', true);
	 		}
	 	});
	 	$('[name=retype-password]').on('keyup',function(e){
	 		pass=$('[name=password]').val();
	 		re_pass=$('[name=retype-password]').val();
	 		if (pass==re_pass) {
	 			$("#error-msg-repass").addClass("hidden");
	 			$('#re-pass').removeClass("has-error");
	 			$('#re-pass').addClass("has-success");
	 			$("[name=email]").prop('disabled', false);
	 		} else {
	 			console.log("salah");
	 			// parsley-error
	 			$('#re-pass').addClass("has-error");
	 			$("#re-pass").removeClass("has-success");
	 			$("#error-msg-repass").removeClass("hidden");
	 			$("[name=email]").prop('disabled', true);
	 		}
 				
  	});

	});
</script>