<style type="text/css">
	.komen {
		width:80%;
		margin-left: 120px;
	}
	.komen li{
		margin: 0;
		padding: 0;
		line-height:1.5;
	}
</style>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>


<main class="container">
	<div class="page-content">
		<div class="grid-col col-md-11">
                    <div class="hover-effect"></div>
                    <h3 class="center"><strong>Konsultasi Online Sedang dipersiapkan</strong></h3>              
                </div>
</div>
</main>
<script type="text/javascript">
	$(document).ready(function() {  

		$('#search1').autocomplete({
			source:  base_url +"konsultasi/search_all",
			select: function (event, ui) {
				window.location = ui.item.url;
			}
		});

		$('#search2').autocomplete({
			source: base_url +"konsultasi/search_tingkat",
			select: function (event, ui) {
				window.location = ui.item.url;
			}
		});

		$('#search3').autocomplete({
			source: base_url +"konsultasi/search_mine",
			select: function (event, ui) {
				window.location = ui.item.url;
			}
		});
	});
	function showmodal(){
		$('#myModal').modal('show');
	}
</script>