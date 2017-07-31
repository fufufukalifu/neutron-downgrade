<footer>

    <div class="grid-row">

        <div class="grid-col-row clear-fix">

            <section class="grid-col grid-col-4 footer-about">

                <h2 class="corner-radius">Mengenai Neon</h2>

                <div>

                    <h3>Sedikit Bahasan Mengenai Neon</h3>

                    <p>Neon Jogja adalah Singkatan Dari Neutron Online, tempat para siswa-siswa neon belajar menggunakan media pembelajaran online.</p>

                </div>

                <address>

                    <p></p> 

                    <a href="tel:(0274) 450300" class="phone-number">(0274) 450300</a>

                    <br />

                    <a href="mailto: info@neonjogja.com" class="email"> info@neonjogja.com</a>

                    <br />

                    <a href="http://neonjogja.com" class="site">www.neonjogja.com</a>

                    <br />

                    <a href="" class="address">Jl. Taman Siswa, Wirogunan, Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151, Indonesia</a>

                </address>

                <div class="footer-social">
<!-- 
                    <a href="" class="fa fa-twitter"></a>

                    <a href="" class="fa fa-skype"></a>

                    <a href="" class="fa fa-google-plus"></a>

                    <a href="" class="fa fa-rss"></a>

                    <a href="" class="fa fa-youtube"></a>

                </div> -->

            </section>

            <section class="grid-col grid-col-4 footer-latest">
                <h2 class="corner-radius" id="masuk">Video Terbaru</h2>
                <div id="video_last">   

                </div>

            </section>

            <section class="grid-col grid-col-4 footer-contact-form" id="pesan">

                <h2 class="corner-radius">Kirim Kami Pesan</h2>

                <div class="email_server_responce"></div>

                <form action="<?= base_url('index.php/Homepage/addpesan') ?>" class="login-form" method="post">

                    <div class="form-group">
                        <input type="text" name="namalengkap" class="form-control" placeholder="Nama Lengkap" required="true" value="" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="telepon" class="form-control" value="" size="40" placeholder="Telepon" aria-invalid="false" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="mail" class="form-control" size="40" placeholder="Email" aria-invalid="false" required>
                    </div>

                    <div class="form-group">
                        <textarea name="pesan" class="form-control" placeholder="Pesan" cols="40" rows="5" aria-invalid="false" required></textarea>
                    </div>

                    <a onclick="simpan_pesan()" class="cws-button bt-color-3 border-radius alt icon-right">Kirim <i class="fa fa-angle-right"></i></a>

                </form>

            </section>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="grid-row clear-fix">

            <div class="copyright">neonjogja.com<span></span> 2016</div>

            <nav class="footer-nav">

                <ul class="clear-fix">





                </ul>

            </nav>

        </div>

    </div>

</footer>
<script type="">
    $.ajax({
       type: "POST",
       dataType:"JSON",
       url: "<?= base_url() ?>video/ajax_get_last_video",
       success: function (data,i) {
            $('#video_last').append(data.data[0]);
            $('#video_last').append(data.data[1]);
        }
    });




    function kunjungivideo(){
        document.location = "<?=base_url() ?>login";
    }  

    function simpan_pesan(){
        datas = 
        {
            namalengkap:$('input[name=namalengkap]').val(),
            telepon:$('input[name=telepon]').val(),
            email:$('input[name=mail]').val(),
            pesan:$('textarea[name=pesan]').val()
        };
        
        $.ajax({
            url: "<?=base_url() ?>homepage/addpesan",
            dataType:"TEXT",
            type:"POST",
            data:datas,
            success:function(){
                swal("Pesan Terkirim", "silahkan tunggu respon dari kami. Terimakasih");
                $('input[name=namalengkap]').val("");
                $('input[name=telepon]').val("");
                $('input[name=email]').val("");
                $('textarea[name=pesan]').val("");
            },
        });
    }         
</script>
<!-- / footer -->

