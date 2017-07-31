<!-- ini START Template Footer -->







<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js'); ?>"></script>



<!--/ END Template Footer -->



<!--<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery-migrate.min.js'); ?>"></script>-->



<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js'); ?>"></script>



<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js'); ?>"></script>



<!--/ Library script -->







<!-- App and page level script -->



<!-- ini footer -->

<script src="<?php echo base_url(); ?>assets/js/paginga1.jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/soal_to.js"></script>

<script type="text/javascript">

    window.onbeforeunload = function () {
        return "Data yang dimasukan akan hilang, yakin keluar dari halaman?";
    };

</script>

<script>


    function disableF5(e) {
        if ((e.which || e.keyCode) == 116)
            e.preventDefault();
    }

    ;

    $(document).on("keydown", disableF5);
    $(document).bind("contextmenu", function (e) {
       e.preventDefault();
   });


    function countup(hour, min, second, stat) {

        var seconds = second;

        var mins = min;

        var hours = hour;



        if (getCookie("minutes") && getCookie("seconds") && getCookie("hours") && stat)

        {

            var seconds = getCookie("seconds");

            var mins = getCookie("minutes");

            var hours = getCookie("hours");

        }



        function tick() {

            var counter = document.getElementById("timer");

            setCookie("minutes", mins, 10);

            setCookie("seconds", seconds, 10);

            setCookie("hours", hours, 10);



            seconds++;



            counter.innerHTML = (hours < 10 ? "0" : "") + String(hours) + ":" + (mins < 10 ? "0" : "") + String(mins) + ":" + (seconds < 10 ? "0" : "") + String(seconds);

            document.getElementById("durasi").value = (hours * 60 * 60) + (mins * 60) + seconds;



            //save the time in cookie

            if (seconds < 59) {

                setTimeout(tick, 1000);

            } else {

                if (seconds == 59 && mins == 59) {

                    setTimeout(function () {

                        countup(parseInt(hours) + 1, 0, false);

                    }, 1000);

                } else if (seconds == 59) {

                    setTimeout(function () {

                        countup(parseInt(hours), parseInt(mins) + 1, -1, false);

                    }, 1000);

                }

            }



        }

        tick();

    }



    function setCookie(cname, cvalue, exdays) {

//        var d = new Date();

//        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));

//        var expires = "expires=" + d.toGMTString();

        document.cookie = cname + "=" + cvalue + "; " + exdays;

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



//     deleteAllCookies('hours','seconds', 'minutes');

//        deleteAllCookies();

//    countdown(0, true);

    countup(0, 0, 0, true);





    function deleteAllCookies(seconds, mins, hours) {

        document.cookie = seconds + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';

        document.cookie = mins + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';

        document.cookie = hours + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';

    }

</script>

<script type="text/javascript">

    function deleteAllCookies() {

        setCookie('minutes', '', -1);

        setCookie('seconds', '', -1);

        setCookie('hours', '', -1);

    }

</script>








<script>

    function statusPengisian(status) {

        var id = status;

        var x = document.getElementById(id);

//        x.classList.remove("btn-danger");

        x.className += " btn-primary";

    }

    function kirimHasil(){
        window.onbeforeunload = null;
        swal({
          title: "Yakin selesai mengerjakan?",
          text: "kamu tidak akan bisa kembali ke latihan ini lagi!",
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
            deleteAllCookies('seconds', 'minutes', 'hours');
            document.getElementById("hasil").submit();
          } else {
            swal("Dibatalkan", "Pengiriman LJK dibatalkan", "error");
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