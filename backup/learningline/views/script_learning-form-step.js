<script>
var value;
$('select[name=select_jenis]').change(function(){
	value = $('select[name=select_jenis]').val();
	if (value==1) {
		load_video();
	}else if(value==2){
		load_materi();
		// $('.jenis').html("<h4 class='text-center animation animating pulse'>Materi</h4>");
	}else if(value==3){
		load_soal();	
	}else{
		$('.jenis').html("<h4 class='text-center animation animating pulse'>Error</h4>");
	}
});


$('.simpan_step').click(function(){
	alert('masuk');
	var form = {
		urutan:$('input[name=urutan]').val(),
		namastep:$('input[name=namastep]').val(),
		select_jenis:$('select[name=select_jenis]').val()
	};
	var url = base_url+"learningline/ajax_insert_line_step/";
	var data;
	<?php 
	$latihanIDSess;
	if (empty($_POST['action'])) {
		$latihanIDSess = 'null';
	} else {
		$latihanIDSess = $this->session->userdata('id_latihan');
	}
	?>
	var latihanIDSess = <?=$latihanIDSess?>;
	if (value==1) {
		data = {
			videoID:$('input[name=video]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			topikID:<?=$this->uri->segment(3)?>
		};
	}else if(value==2){
		data = {
			materiID:$('input[name=materi]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			topikID:<?=$this->uri->segment(3)?>
		};
	}else if(value==3){
		data = {
			materiID:$('input[name=materi]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			latihanID:latihanIDSess,
			topikID:<?=$this->uri->segment(3)?>
		};
	}else{
	}

	if (data.urutan=="" || data.namastep=="" || data.select_jenist) {
		swal('Silahkan lengkapi data');
	}else{
		$.ajax({
			data:data,
			datatType:"text",
			url:url,
			type:"POST",
			success:function(){
				swal('Step berhasil ditambahkan');
				$('.form-line')[0].reset();
				swal({
					title: "Step berhasil ditambahkan!",
					text: "Tambahkan baru, atau selesai?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Selesai",
					cancelButtonText: "Tambah",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal("selesai", "Anda akan dialihkan ke daftar step", "success");
						window.location.href = base_url+"learningline/step/"+data.topikID;
					} else {
						swal("Tambah Data", "silahkan ambahkan data");
						$('.jenis').html("<h4 class='text-center animation animating pulse'>Pilih Jenis Terlebih Dahulu</h4>");	
					}
				});

			},
			error:function(){
				sweetAlert('Data gagal disimpan','error');
			}
		});
	}
});
//biar inputin number aja
$('input[name=urutan]').keyup(function () {
	if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	}
});

//# ketika tombol di klik
function detail(id){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('id');
	var links;

	$('h3.semibold').html(data.judulMateri);
		// links = '<?=base_url();?>assets/video/' + data.namaFile;
		$('#isicontent').html(data.isiMateri); 
		$('.detail_materi').modal('show');


	}
//##

// load video pada saat dipilih jenis video
function load_video(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Video</h4>");
	$('.jenis').append('<div class="panel panel-default">'+
		'<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Video</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id video</th>'+
		'<th>Judul Sub Bab</th>'+

		'<th>Judul Video</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+

		'</div>');

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_video/"+babID;

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
}
// load video pada saat dipilih jenis video

// load video pada saat dipilih jenis video
function load_materi(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Materi</h4>");
	$('.jenis').append('<div class="panel panel-default">'+
		'<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Materi</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id Materi</th>'+
		'<th>Judul Materi</th>'+
		'<th>Isi Materi</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+

		'</div>');

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_materi/"+babID;

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
}

function load_soal(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Soal</h4>");
	$('.jenis').append('<div class="panel panel-default">'+
		'<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Soal</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarsoal table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th></th>'+
		'<th>Judul Soal</th>'+
		'<th>Sumber</th>'+
		'<th width="10%">Soal</th>'+
		'<th width="10%">Kesulitan</th>'+
		'<th width="5%">Aksi</th>'+

		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'<div class="panel-footer">'+
		'<div class="form-group no-border">'+
		'<label class="col-sm-1 control-label"></label>'+
		'<div class="col-sm-9">'+
		'<a onclick="tambahkan_soal()" class="btn btn-primary tambahkan">Tambahkan</a>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+

		'</div>'
		


		);

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"paketsoal/ajax_get_soal_byid/"+babID;
	tabel = $('.daftarsoal').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"pageLength": 5,
	});
}

function tambahkan_soal(){
	var idsoal = [];

	$(':checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	var idsoal = [];
	babID = $('input[name=babID]').val();
	$(':checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	data=[bab=babID,
	id_soal=idsoal]

	if (idsoal.length > 0) {
		var url = base_url+"index.php/latihan/tambah_latihan_ajax_bab_step";
		$.ajax({
			url : url,
			type: "POST",
			dataType:'text',
			data: {bab:babID,
				id_soal:idsoal},
				success: function(data,respone)
				{   
					swal('Berhasil menambahkan soal');
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal('Error adding / update data');
				}
			});
	} else {
		swal('error');
	}
}
// load video pada saat dipilih jenis video



// FUNGSI MELIHAT VIDEO
function play(data){
	kelas = '.video-'+data;
	meta = $(kelas).data('todo');
	$('.detail_video').modal('show');
	judul = " <h4 class='modal-title' style='display: inline'>Preview Video "+meta.judulVideo;
	if (meta.namaFile==null) {
		console.log(meta.link);
		video = '<iframe width="100%" height="400"'+
		'src="'+meta.link+'">'+
		'</iframe>';
		$('.detail_video .modal-body').html(video);
	}else{
		file = base_url+"assets/video/"+meta.namaFile;
		video = '<video width="100%" height="400" controls>'+
		'<source src="'+file+'" type="video/mp4">'+
		'<source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.'+
		'</video>';
		$('.detail_video .modal-body').html(video);
	}
	$('.detail_video .modal-header').html(judul);
}

// dESTROY KETIKA MODAL DICLOSE
$('.detail_video').on('hide.bs.modal', function(e) {    
	var $if = $(e.delegateTarget).find('iframe');
	var src = $if.attr("src");
	$if.attr("src", '/empty.html');
	$if.attr("src", src);
});

function detail_soal(data){
	console.log(data);
	kelas = '.soal-'+data;
	meta = $(kelas).data('todo');
	$('.mdetailsoal').modal('show');
        $('.mdetailsoal h3.semibold').html(meta.judul_soal);

        $('.mdetailsoal p#dsoal').html(meta.soal);
        $('.mdetailsoal p#djawaban').html(meta.jawaban);
}
</script>