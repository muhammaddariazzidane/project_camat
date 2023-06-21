<div class="wrapper">
  <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col mx-auto">
          <div class="mb-4 text-center">
            <h2> Login</h2>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="p-4 rounded">
                <div class="form-body">
                  <?= form_open('welcome/tes', ['class' => 'row g-3']) ?>
                  <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address" name="email">
                  </div>
                  <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                    <div class="input-group" id="show_hide_password">
                      <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                    </div>
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