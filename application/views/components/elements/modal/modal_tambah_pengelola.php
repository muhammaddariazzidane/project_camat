<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah pengelola</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>