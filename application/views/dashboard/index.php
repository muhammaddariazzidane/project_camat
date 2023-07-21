<!-- Modal -->
<?php
$role_id = $this->session->role_id;
?>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah dokumen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('tambah_dokumen') ?>
        <div class="mb-3">
          <label for="nomor_dokumen" class="form-label">Nomor dokumen</label>
          <input type="number" class="form-control" id="nomor_dokumen" name="nomor_dokumen" placeholder="001">
          <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
            <?= form_error('nomor_dokumen') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="nama_dokumen" class="form-label">Nama dokumen</label>
          <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="nama dokumen">
          <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
            <?= form_error('nama_dokumen') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>
          <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
            <?= form_error('keterangan') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="file_dokumen" class="form-label">File</label>
          <input type="file" name="file_dokumen" id="file_dokumen" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <?= form_close() ?>

      </div>
    </div>
  </div>
</div>
<?php if ($role_id == 1) : ?>
  <div class="row row-cols-2  row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-primary border-start border-0 border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0">Dokumen</p>
              <h4 class="my-1 text-primary"><?= $jml_dokumen ?></h4>
            </div>
            <div class="text-primary ms-auto font-35"><i class="bx bxs-file-archive"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-dark border-start border-0 border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0">Users</p>
              <h4 class="my-1 text-dark"><?= $jml_users ?></h4>
            </div>
            <div class="text-dark ms-auto font-35"><i class="bx bx-group"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-success border-start border-0 border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0">Pengajuan berhasil</p>
              <h4 class="my-1 text-success"><?= $jml_pengajuan_sukses ?></h4>
            </div>
            <div class="text-success ms-auto font-35"><i class="bx bx-select-multiple"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-danger border-start border-0 border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="overflow-">
              <p class="mb-0">Pengajuan Gagal</p>
              <h4 class="my-1 text-danger "><?= $jml_pengajuan_gagal ?></h4>
            </div>
            <div class="text-danger ms-auto font-35"><i class="bx bx-x-circle"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif ?>



<script>
  const dokId = document.getElementById('dokumen_id');

  function myf(id) {
    dokId.value = id;
    console.log(dokId.value);
  }
</script>