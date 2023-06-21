<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="<?= base_url() ?>/assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="<?= base_url() ?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="<?= base_url() ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?= base_url() ?>/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?= base_url() ?>/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- loader-->
  <link href="<?= base_url() ?>/assets/css/pace.min.css" rel="stylesheet" />
  <script src="<?= base_url() ?>/assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/app.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet">
  <!-- Theme Style CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/semi-dark.css" />
  <title>Rocker - Free Bootstrap 5 Admin Dashboard Template</title>
</head>

<body>
  <!--wrapper-->
  <?= $content ?>
  <!--end wrapper-->

  <!-- Bootstrap JS -->
  <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/chartjs/js/Chart.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/index.js"></script>
  <!--app JS-->
  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bx-hide");
          $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bx-hide");
          $('#show_hide_password i').addClass("bx-show");
        }
      });
    });
  </script>
  <script src="<?= base_url() ?>/assets/js/app.js"></script>
</body>

</html>