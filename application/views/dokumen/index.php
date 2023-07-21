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


<h3 class="mb-3">Data Dokumen</h3>
<?php if ($role_id != 3) : ?>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal3">
    Tambah dokumen
  </button>
<?php endif ?>

<div class="flash-data-success" data-flashdata="<?= $this->session->success ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->info ?>"></div>

<?php if (validation_errors()) : ?>
  <div class="flash-data-error" data-flashdata="<?= validation_errors() ?>"></div>
<?php endif ?>
<div class="card radius-10">
  <div class="card-body">

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-center">
            <?php if ($role_id == 1 || $role_id == 2) : ?>
              <th>Nomor dokumen</th>
            <?php endif ?>
            <th>Nama dokumen</th>
            <th>Keterangan</th>
            <th>Tanggal dibuat</th>
            <th>File dokumen</th>
            <?php if ($role_id != 3) : ?>
              <th class="text-center">Aksi</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dokumen as $d) : ?>
            <tr class="text-center">
              <?php if ($role_id == 1 || $role_id == 2) : ?>
                <td><?= $d->nomor_dokumen ?></td>
              <?php endif ?>
              <td><?= $d->nama_dokumen ?></td>
              <td><?= $d->keterangan ?></td>
              <td><?= dateindo($d->tgl_dibuat) ?></td>
              <?php if ($role_id == 3) : ?>
                <!-- <td><a href="<?= base_url('tambah_pengajuan/') . $d->nomor_dokumen . '/' . $this->session->id  ?>" class="badge py-2 px-4 text-bg-primary konfirmasi">Ajukan ingin lihat</a></td> -->
                <td><button type="button" class="badge  btn py-2 px-4 text-bg-primary " onclick="myf(<?= $d->id ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajukan ingin lihat</button></td>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Alasan ingin lihat dokumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <?= form_open('tambah_pengajuan')  ?>
                      <div class="modal-body text-start">
                        <label for="keterangan" class="form-label">Alasan </label>
                        <input type="text" name="alasan" id="alasan" class="form-control" required />
                      </div>
                      <input type="hidden" name="dokumen_id" id="dokumen_id" value="<?= $d->id ?>" class="form-control" />
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ajukan">Ajukan</button>
                      </div>
                      <?= form_close() ?>
                    </div>
                  </div>
                </div>
              <?php else : ?>
                <td><a href="<?= base_url('assets/upload/') . $d->file_dokumen ?>" class="badge py-2 px-4 text-bg-primary">Lihat</a></td>
              <?php endif ?>
              <?php if ($role_id != 3) : ?>
                <td class="d-flex gap-1 justify-content-center">
                  <a href="<?= base_url('edit_dokumen/') . $d->id ?> " class="btn btn-sm btn-primary"><i class='bx bxs-edit mx-auto'></i></a>
                  <a href="<?= base_url('delete_dokumen/' . $d->id) ?>" class="btn btn-sm btn-danger hapus"><i class='bx bxs-trash mx-auto'></i></a>
                </td>
              <?php endif ?>

            </tr>

          <?php endforeach ?>
        </tbody>

      </table>
    </div>
  </div>
  <?= $this->pagination->create_links(); ?>
</div>
<script>
  const dokId = document.getElementById('dokumen_id');

  function myf(id) {
    dokId.value = id;
    console.log(dokId.value);
  }
</script>