<footer>    <div class="grid-row">        <div class="grid-col-row clear-fix">            <section class="grid-col grid-col-4 footer-about">                <h2 class="corner-radius">Mengenai Neon</h2>                <div>                    <h3>Sed aliquet dui auctor blandit ipsum tincidunt</h3>                    <p>Quis rhoncus lorem dolor eu sem. Aenean enim risus, convallis id ultrices eget.</p>                </div>                <address>                    <p></p>	                    <a href="tel:(0274) 450300" class="phone-number">(0274) 450300</a>                    <br />                    <a href="mailto: info@Neon-ny.com" class="email"> info@Neon-ny.com</a>                    <br />                    <a href="www.Neon-ny.com" class="site">www.Neon-ny.com</a>                    <br />                    <a href="" class="address">Jl. Taman Siswa, Wirogunan, Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151, Indonesia</a>                </address>                <div class="footer-social"><!--                     <a href="" class="fa fa-twitter"></a>                    <a href="" class="fa fa-skype"></a>                    <a href="" class="fa fa-google-plus"></a>                    <a href="" class="fa fa-rss"></a>                    <a href="" class="fa fa-youtube"></a>                </div> -->            </section>            <section class="grid-col grid-col-4 footer-latest">                <h2 class="corner-radius">Video Terbaru</h2>                <?php foreach ($last_video as $last_video_item): ?>                <article>                    <img src="http://placehold.it/83x83" data-at2x="http://placehold.it/83x83" alt>                   <a href="<?=base_url('video/seevideo') ."/".$last_video_item['id']?>/"> <h3><?=$last_video_item['judulVideo'] ?></h3></a>                    <div class="course-date">                        <div>10<sup>00</sup></div>                        <div>23.02.15</div>                    </div>                    <p><?=$last_video_item['deskripsi'] ?></p>                </article>                <?php endforeach ?>            </section>            <section class="grid-col grid-col-4 footer-contact-form" id="pesan">                <h2 class="corner-radius">Kirim Kami Pesan</h2>                <div class="email_server_responce"></div>                <form action="<?= base_url('index.php/Homepage/addpesan') ?>" class="login-form" method="post">                    <div class="form-group">                        <input type="text" name="namalengkap" class="form-control" placeholder="Nama Lengkap" required="true" value="" required>                    </div>                    <div class="form-group">                        <input type="text" name="telepon" class="form-control" value="" size="40" placeholder="Telepon" aria-invalid="false" required>                    </div>                    <div class="form-group">                        <input type="email" name="email" class="form-control" value="" size="40" placeholder="Email" aria-invalid="false" required>                    </div>                    <div class="form-group">                        <textarea name="pesan" class="form-control" placeholder="Pesan" cols="40" rows="5" aria-invalid="false" required></textarea>                    </div>                    <button type="submit" class="cws-button bt-color-3 border-radius alt icon-right">Kirim <i class="fa fa-angle-right"></i></button>                </form>            </section>        </div>    </div>    <div class="footer-bottom">        <div class="grid-row clear-fix">            <div class="copyright">neonjogja.com<span></span> 2016</div>            <nav class="footer-nav">                <ul class="clear-fix">                    <li>                        <a href="index.html">Home</a>                    </li>                </ul>            </nav>        </div>    </div></footer><script type="">$.ajax({         type: "POST",         dataType:"JSON",         url: "<?= base_url() ?>video/ajax_get_last_video",         success: function (data,i) {            // console.log(data.data[0]);                $('#video_last').append(data.data[0]);                $('#video_last').append(data.data[1]);            // console.log(data);        }    });    function kunjungivideo(data){        document.location = base_url+"video/seevideo/"+data;    }            </script><!-- / footer -->