<main>

  <section class="fullwidth-background bg-2">

    <div class="grid-row">

      <div class="login-block" style="min-width: 35%">

        <div class="logo">


          <!--<h4>Login</h4>-->

        </div>

        <div class="">

          <div class="page-header-section">

            <h4 class="title font-alt text-center">Silahkan Login</h4>

          </div>

        </div>


        <div class="clear-both"></div>


        <?php if ($this->session->flashdata('notif') != '') {

          ?>

          <div class="alert alert-warning">

            <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

          </div>

          <?php } else { ?>

          <div class="alert alert-warning">

            Siap berpetualang? Isi form, tekan Login!

          </div>

          <?php }; ?>

          <hr>

          <br>

          <form class="login-form" action = "<?= base_url('index.php/login/validasiLogin'); ?>" method = "post">

            <div class="form-group">

              <input type="text" name="username" class="login-input" placeholder="Username, UserID atau Email" required>

              <span class="input-icon">

                <i class="fa fa-user"></i>

              </span>

            </div>

            <div class="form-group">

              <input name="password" type="password" class="login-input" placeholder="Password" required>

              <span class="input-icon" id="look_pswd">

                <i class="fa fa-eye"></i>

              </span>

            </div>



            <div class="form-group">

              <div class="" style="float: left;">

                <p class="small">

                  <a href="<?= base_url('index.php/register/lupapassword'); ?>">Lupa Password?</a>

                </p>

              </div>

              <div class="text-right">

                <p class="small">

                  <a href="<?= base_url('index.php/register'); ?>">Belum punya akun?</a>

                            </p><!--

                          --></div>

                          <div class="clear-both"></div>

                        </div>

                        <div class="form-group nm">

                          <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Login</span></button>

                        </div>

                      </form>
                    </div>

    </div>
      <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
  </section>
</main>
<script type="text/javascript">
  $(document).ready(function(){
    var type_input_pswd = 'password';

    //event look pswd
    $("#look_pswd").click(function(){  
      // pengecekan type input password
      type_input_pswd = $("input[name=password]").get(0).type;
      console.log(type_input_pswd);
      if (type_input_pswd == "password") {
        // jika type password di ubah ke text
        $("input[name=password]").get(0).type = 'text';
        $("#look_pswd i").removeClass("fa-eye");
        $("#look_pswd i").addClass("fa-lock");
        type_input_pswd='text';
      } else {
         // jika type text di ubah ke password
        $("input[name=password]").get(0).type = 'password';
        type_input_pswd='password';
        $("#look_pswd i").removeClass("fa-lock");
        $("#look_pswd i").addClass("fa-eye");
      }

    });
  });
</script>

