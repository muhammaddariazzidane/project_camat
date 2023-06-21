<div class="wrapper">
  <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col mx-auto">
          <div class="mb-4 text-center">
            <h2>Register</h2>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="p-4 rounded">
                <div class="form-body">
                  <?= form_open('register', ['class' => 'row g-3']) ?>
                  <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Nama</label>
                    <input required type="text" value="<?= set_value('nama') ?>" class="form-control" id="nama" placeholder="John doe" name="nama" autocomplete="off">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                      <?= form_error('nama') ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                    <input required type="email" value="<?= set_value('email') ?>" class="form-control" id="inputEmailAddress" placeholder="Email Address" name="email" autocomplete="off">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                      <?= form_error('email') ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Password</label>
                    <div class="input-group" id="show_hide_password">
                      <input required type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                      <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                        <?= form_error('password') ?>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex">
                    Sudah puya akun?
                    <a href="<?= base_url('login') ?>" class="text-decoration-underline ms-1">Login disini</a>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Register</button>
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