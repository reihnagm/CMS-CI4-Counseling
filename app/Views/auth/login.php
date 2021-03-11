<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

  <!--- Running in public --->
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/fonts/iconic/css/material-design-iconic-font.min.css') ?> ">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/animate/animate.css') ?> ">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/animsition/css/animsition.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/select2/select2.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/vendor/daterangepicker/daterangepicker.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/css/util.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/login/css/main.css') ?>">
  <!--- End public --->

  <!-- Running in spark -->
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
  <!-- End -->
</head>

<body>


  <div class="container-login100" style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MzR8fHBlb3BsZSUyMHdvcmt8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
      <form action="<?= base_url('/admin/auth/login'); ?>" class="login100-form validate-form" method="post">
        <img src="<?= base_url('public/assets/img/logo_.jpg'); ?>" alt="" style="width: 200px; padding-bottom: 35px; margin-left: 26px;">
        <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
          <input class="input100" type="text" name="username" placeholder="username">
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
          <input class="input100" type="password" name="password" placeholder="password">
          <span class="focus-input100"></span>
        </div>

        <div class="container-login100-form-btn">
          <button type="submit" class="login100-form-btn">
            Sign In
          </button>
        </div>
      </form>
    </div>
  </div>



  <div id="dropDownSelect1"></div>
  <!--- Running in public --->
  <script src="<?= base_url("public/assets/login/vendor/jquery/jquery-3.2.1.min.js") ?>"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?= base_url("public/assets/login/vendor/animsition/js/animsition.min.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/bootstrap/js/popper.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/bootstrap/js/bootstrap.min.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/select2/select2.min.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/daterangepicker/moment.min.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/daterangepicker/daterangepicker.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/vendor/countdowntime/countdowntime.js") ?>"></script>
  <script src="<?= base_url("public/assets/login/js/main.js") ?>"></script>
  <!--- End public --->
  <script>
    var msg_err = '<?= $msg_error ?? "" ?>';
    if(msg_err !== "") {
      swal("Oops!", msg_err, "error")
    }
  </script>
  <!-- Running in Spark -->
  <!-- <script src="/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="/assets/login/vendor/animsition/js/animsition.min.js"></script>
  <script src="/assets/login/vendor/bootstrap/js/popper.js"></script>
  <script src="/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/login/vendor/select2/select2.min.js"></script>
  <script src="/assets/login/vendor/daterangepicker/moment.min.js"></script>
  <script src="/assets/login/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="/assets/login/vendor/countdowntime/countdowntime.js"></script>
  <script src="/assets/login/js/main.js"></script> -->
  <!-- End -->

</body>

</html>