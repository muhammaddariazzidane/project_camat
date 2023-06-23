<!-- Modal -->
<?php
$role_id = $this->session->role_id;
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah dokumen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('dokumen/store') ?>
        <div class="mb-3">
          <label for="nomor_dokumen" class="form-label">Nomor dokumen</label>
          <input type="text" class="form-control" id="nomor_dokumen" name="nomor_dokumen" placeholder="001">
          <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
            <?= form_error('nomor_dokumen') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="nama_dokumen" class="form-label">Nama dokumen</label>
          <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="nama dokumen">
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>
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

<h3 class="mb-3">Data Dokumen</h3>
<?php if ($role_id != 3) : ?>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah dokumen
  </button>
<?php endif ?>
<?php if ($this->session->success) : ?>
  <div class="alert alert-success" role="alert">
    <?= $this->session->success ?>
  </div>
<?php endif ?>
<?php if ($this->session->info) : ?>
  <div class="alert alert-info" role="alert">
    <?= $this->session->info ?>
  </div>
<?php endif ?>
<?php if (validation_errors()) : ?>
  <div class="alert alert-danger" role="alert">
    <?= $this->session->flashdata('error') ?>
  </div>
<?php endif ?>
<div class="card radius-10">
  <div class="card-body">

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Nomor dokumen</th>
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
            <tr>
              <td><?= $d->nomor_dokumen ?></td>
              <td><?= $d->nama_dokumen ?></td>
              <td><?= $d->keterangan ?></td>
              <td><?= dateindo($d->tgl_dibuat) ?></td>
              <?php if ($role_id == 3) : ?>
                <td><a onclick="return confirm('ingin mengajukan melihat dokumen?')" href="<?= base_url('pengajuan/store/') . $d->nomor_dokumen . '/' . $this->session->id ?>" class="badge py-2 px-4 text-bg-primary">Ajukan ingin lihat</a></td>
              <?php else : ?>
                <td><a href="<?= base_url('assets/upload/') . $d->file_dokumen ?>" class="badge py-2 px-4 text-bg-primary">Lihat</a></td>
              <?php endif ?>
              <?php if ($role_id != 3) : ?>
                <td class="d-flex gap-1 justify-content-center">
                  <a href="<?= base_url('edit_dokumen/') . $d->id ?> " class="btn btn-sm btn-primary"><i class='bx bxs-edit mx-auto'></i></a>
                  <a href="<?= base_url('delete_dokumen/' . $d->id) ?>" onclick="return confirm('yakin mau hapus dokumen?')" class="btn btn-sm btn-danger"><i class='bx bxs-trash mx-auto'></i></a>
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