<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <!-- <link rel="icon" href="<?= base_url() ?>/assets/images/favicon-32x32.png" type="image/png" /> -->
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
  <title>Website Pengelolaan dokumen</title>
</head>

<body>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    <?php $this->load->view('components/sidebar') ?>
    <!--end sidebar wrapper -->
    <!--start header -->

    <?php $this->load->view('components/topbar') ?>
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
      <div class="page-content">
        <?= $content ?>
      </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
      <p class="mb-0">Copyright © 2023. All right reserved.</p>
    </footer>
  </div>
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
  <script src="<?= base_url() ?>/assets/js/app.js"></script>
  <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
  <script>
    // JavaScript
    $('.lihat').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary mx-2',
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: 'Perhatian',
          text: 'Dokumen hanya bisa dilihat satu kali',
          icon: 'warning',
          confirmButtonText: 'Lihat',
        })
        .then((result) => {
          if (result.value) {
            // Buka halaman dengan file dokumen di tab baru
            window.open(href, '_blank');

            // Lakukan refresh pada halaman sebelumnya
            setTimeout(function() {
              location.reload();
            }, 200);
          }
        });
    });

    // $('.lihat').on('click', function(e) {
    //   e.preventDefault()
    //   const href = $(this).attr('href');

    //   const swalWithBootstrapButtons = Swal.mixin({
    //     customClass: {
    //       confirmButton: 'btn btn-primary mx-2',
    //     },
    //     buttonsStyling: false
    //   })

    //   swalWithBootstrapButtons.fire({
    //     title: 'Perhatian',
    //     text: 'Dokumen hanya bisa dilihat satu kali',
    //     icon: 'warning',
    //     confirmButtonText: 'Lihat',
    //   }).then((result) => {
    //     if (result.value) {
    //       document.location.href = href
    //       $(document).ready(function() {
    //         setTimeout(function() {
    //           location.reload();
    //         }, 500);
    //       })
    //     }
    //   })
    //   // document.location.href = '<?= base_url('pengajuan') ?>'
    // })

    const flashDataSuccess = $('.flash-data-success').data('flashdata')
    const flashDataInfo = $('.flash-data-info').data('flashdata')
    const flashDataError = $('.flash-data-error').data('flashdata')

    if (flashDataError) {
      Swal.fire({
        icon: 'error',
        title: 'Periksa kembali inputan',
        timer: 5000,
        timerProgressBar: true,

      })
    }
    if (flashDataInfo) {
      Swal.fire({
        icon: 'info',
        title: flashDataInfo,
        timer: 5000,
        timerProgressBar: true,

      })
    }
    if (flashDataSuccess) {
      Swal.fire({
        icon: 'success',
        title: flashDataSuccess,
        timer: 5000,
        timerProgressBar: true,

      })
    }
    $('.hapus').on('click', function(e) {
      e.preventDefault()
      const href = $(this).attr('href');

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary mx-2',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Yakin mau hapus dokumen??',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.value) {
          document.location.href = href
        }
      })
    })



    // var myModal = document.getElementById('exampleModal');
    // myModal.addEventListener('show.bs.modal', function(event) {
    //   var button = event.relatedTarget;
    //   var id = button.getAttribute('data-id');
    //   var form = myModal.querySelector('form');
    //   form.action = '<?= base_url("pengajuan/tolak/") ?>' + id;
    // });
  </script>
</body>

</html>