<script>
var topikID = <?=$this->uri->segment(3);?>;
var url = base_url+"learningline/ajax_list_get_step/"+topikID;
console.log(url);
$(document).ready(function(){
		dataTableLearning = $('.daftarstep ').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"bDestroy": true,

	});
});

function play(data){
	kelas = '.video-'+data;
	meta = $(kelas).data('todo');
	console.log(meta);
	// $('.detail_video').modal('show');
	// judul = " <h4 class='modal-title' style='display: inline'>Preview Video "+meta.judulVideo;
	// if (meta.namaFile==null) {
	// 	console.log(meta.link);
	// 	video = '<iframe width="100%" height="400"'+
	// 	'src="'+meta.link+'">'+
	// 	'</iframe>';
	// 	$('.detail_video .modal-body').html(video);
	// }else{
	// 	file = base_url+"assets/video/"+meta.namaFile;
	// 	video = '<video width="320" height="240" controls>'+
	// 	'<source src="'+file+'" type="video/mp4">'+
	// 	'<source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.'+
	// 	'</video>';
	// 	$('.detail_video .modal-body').html(video);
	// }
	// $('.detail_video .modal-header').html(judul);
}
</script>