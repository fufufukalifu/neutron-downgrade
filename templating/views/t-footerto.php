﻿<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js'); ?>"></script>
<!--/ Library script -->
<!-- App and page level script -->
<script>
  var base_url = "<?=base_url() ?>";
// DISABLE F 4
function disableF5(e) {
  if ((e.which || e.keyCode) == 116)
    e.preventDefault();
}

$(document).on("keydown", disableF5);
$(document).bind("contextmenu", function (e) {
  e.preventDefault();
});
// DISABLE F 5    
</script>

<script>
// KALO HALAMAN DI RELOAD
window.onbeforeunload = function (e) {
  e = e || window.event;

    // For IE and Firefox prior to version 4
    if (e) {
      e.returnValue = 'A search is in progress, do you really want to stop the search and close the tab?';
    }

    // For Safari
    return 'A search is in progress, do you really want to stop the search and close the tab?';
  };
// KALO HALAMAN DI RELOAD
</script>

<script>
// TIMER COUNTDOWN
function countdown(minutes, stat) {
  var seconds = 60;
  var mins = minutes;
  if (getCookie("minutes") && getCookie("seconds") && stat)
  {
    var seconds = getCookie("seconds");
    var mins = getCookie("minutes");
  }
// TIMER COUNTDOWN



function tick() {
  var counter = document.getElementById("timer");
  setCookie("minutes", mins, 10);
  setCookie("seconds", seconds, 10);
  var current_minutes = mins - 1

  seconds--;
  counter.innerHTML = current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
 //save the time in cookie
 if (seconds > 0) {
  setTimeout(tick, 1000);
} else {
  if (mins > 1) {
    setTimeout(function () {
      countdown(parseInt(mins) - 1, false);
    }, 1000);
  } else {
    $('#pesan_habis').modal('show');
  }
}

}
tick();
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ')
      c = c.substring(1);
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

countdown(<?php foreach ($paket as $row) {echo $row['durasi']; } ?>, true);

function deleteAllCookies(seconds, mins) {
  document.cookie = seconds + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
  document.cookie = mins + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}

</script>



<script type="text/javascript">
  function deleteAllCookies() {
    setCookie('minutes', '', -1);
    setCookie('seconds', '', -1);
  }
</script>



<script>
  function statusPengisian(status) {
    var id = status;
    var x = document.getElementById(id);
    x.classList.remove("btn-danger");
    x.className += " bg-primary";
  }

  function kirimHasil(){
    jenis_penilaian = $('.jenis_penilaian').text();
    
    if (jenis_penilaian=="SBMPTN") {
          swal({
      title: "Yakin selesai mengerjakan?",
      text: "kamu tidak akan bisa kembali ke sini lagi!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya, saya yakin!",
      cancelButtonText: "Tidak, batalkan!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        window.onbeforeunload = null;
        $.ajax({
          type: "POST",
          dataType: "TEXT",
          url: base_url+"tryout/cekjawaban",
          data: $('#hasil').serialize(),
          success: function(data){
            deleteAllCookies('seconds', 'minutes');
            window.localStorage.clear();
            window.location.href = base_url+"tryout/selesaitryout";
          },error:function(data){
            swal('Gagal mengirimkan jawaban, koneksi anda sedang lemah. Silahkan ulangi beberapa saat lagi..');
              console.log(data);
          }
        });
      } else {
        swal("Dibatalkan", "Pengiriman LJK dibatalkan", "error");
      }
    });
      // 
    }else{
      jumlah_soal = $(".ljk a").length;
      jumlah_dijawab = $("input[type=radio]:checked").length;

    // jika tidak ada jawaban yang dikirim
    if (jumlah_soal!=jumlah_dijawab) {
    // tidak ada jawaban yg di kirim
    swal("Dibatalkan", "Maaf, terdapat soal ragu-ragu atau belum dijawab!", "error");
  }else{
    // ada jawaban yang dikirim
    window.onbeforeunload = null;

    swal({
      title: "Yakin selesai mengerjakan?",
      text: "kamu tidak akan bisa kembali ke sini lagi!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya, saya yakin!",
      cancelButtonText: "Tidak, batalkan!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        window.onbeforeunload = null;
        $.ajax({
          type: "POST",
          dataType: "TEXT",
          url: base_url+"tryout/cekjawaban",
          data: $('#hasil').serialize(),
          success: function(data){
            deleteAllCookies('seconds', 'minutes');
            window.localStorage.clear();
            window.location.href = base_url+"tryout/selesaitryout";
          },error:function(){
            swal('Gagal mengirimkan jawaban, koneksi anda sedang lemah. Silahkan ulangi beberapa saat lagi..')
          }
        });
      } else {
        swal("Dibatalkan", "Pengiriman LJK dibatalkan", "error");
      }
    });
  }
}
    /*
    */
  }

  function kirim_hasil_habis(){
    $.ajax({
      type: "POST",
      dataType: "TEXT",
      url: base_url+"tryout/cekjawaban",
      data: $('#hasil').serialize(),
      success: function(){
        deleteAllCookies('seconds', 'minutes');
        window.localStorage.clear();
        window.location.href = base_url+"tryout/selesaitryout";
      },error:function(){
        swal('Gagal menghubungkan ke server')
      }
    });
  }
</script>

<script type="text/javascript" src="<?= base_url('assets/plugins/owl/js/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/pages/frontend/home.js'); ?>"></script>


<!-- Start Math jax --> 
<script type="text/x-mathjax-config"> 
  MathJax.Hub.Config({ 
  tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]} 
}); 
</script> 
<script type="text/javascript" async 
src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>">
</script> 
<!-- end Math jax -->
</body>