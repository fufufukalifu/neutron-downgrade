  <!-- get data siswa unutk di tampilkan di form -->
  <?php 
  foreach ($siswa as $row) {
  	$namaDepan = $row['namaDepan'];
  	$namaBelakang = $row['namaBelakang'];
  	$alamat = $row['alamat'];
  	$noKontak = $row['noKontak'];
  	$biografi = $row['biografi'];
  	$namaSekolah = $row['namaSekolah'];
  	$alamatSekolah  = $row['alamatSekolah']; 
  	$photo=base_url().'assets/image/photo/siswa/'.$row['photo'];
  } 
  ?>           

  <section id="main" role="main">
	<div class="container-fluid">
		<div class="col-xs-12">
  <div class="widget panel">
    <div class="thumbnail">
      <div class="media">
        <div class="indicator"><span class="spinner"></span></div>
        <div class="meta bottom text-center">
         <img class="img-circle img-bordered-teal mb10" src="<?=$photo ?>" alt="" width="120px" height="120px">
         <h4 class="semibold nm" style="color:black"><span class="iconmoon-location-6"><?= $namaDepan." ".$namaBelakang ?></span></h4>
         <h6 class="nm" style="color:black"><i><span class="iconmoon-location-6"><b>About me :</b><br><?php echo $biografi ?></i></span></h6>
       </div>
       <img data-toggle="unveil" src="<?=$photo ?>" alt="Cover" height="30%"/>
     </div>
   </div>

   <!-- meta user -->
   <div class="panel-body">
     <ul class="nav nav-section nav-justified">
       <li>
         <div class="section">
           <p class="nm text-muted">Jumlah Video Ditonton</p>
           <h4 class="nm">100</h4>
         </div>
       </li>
       <li>
         <div class="section">
           <p class="nm text-muted">Jumlah Komentar</p>
           <h4 class="nm">10</h4>
         </div>
       </li>
       <li>
         <div class="section">
           <p class="nm text-muted">Rank</p>
           <h4 class="nm">10</h4>
         </div>
       </li>

     </ul>
     <!--/ Nav section -->
   </div>
   <!--/ panel body -->
 </div>
 <!--/ END Widget Panel -->
</div>
	</div>
  </section>