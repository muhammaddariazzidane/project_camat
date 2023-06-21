<div class="wrapper">
  <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col mx-auto">
          <div class="mb-4 text-center">
            <h2> Login</h2>
          </div>
          <?php if ($this->session->success) : ?>
            <div class="alert alert-success mx-4 alert-dismissible fade show" role="alert">
              <?= $this->session->success ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif ?>
          <?php if ($this->session->error) : ?>
            <div class="alert alert-danger mx-4 alert-dismissible fade show" role="alert">
              <?= $this->session->error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif ?>
          <div class="card">
            <div class="card-body">
              <div class="p-4 rounded">
                <div class="form-body">
                  <?= form_open('login', ['class' => 'row g-3']) ?>
                  <div class="col-12">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email">
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group" id="show_hide_password">
                      <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                    </div>
                  </div>
                  <div class="d-flex">
                    Belum puya akun?
                    <a href="<?= base_url('register') ?>" class="text-decoration-underline ms-1">Register disini</a>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </div>
                  <?= form_close() ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
  </div>
</div>