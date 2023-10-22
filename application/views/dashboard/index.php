<?php
$role_id = $this->session->role_id;
?>

<div class="flash-data-success" data-flashdata="<?= $this->session->success ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->info ?>"></div>

<?php if (validation_errors()) : ?>
  <div class="flash-data-error" data-flashdata="<?= validation_errors() ?>"></div>
<?php endif ?>

<?php if ($role_id !== 3) : ?>
  <div class="row row-cols-2 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-primary border-start border-0 border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0">Surat Tanah</p>
              <h4 class="my-1 text-primary"><?= $jml_surat ?></h4>
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
              <p class="mb-0">Pengelola</p>
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
  <div class="row">
    <div class="col-lg-4">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah pengelola
      </button>
      <?php $this->load->view('components/elements/modal/modal_tambah_pengelola') ?>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="table-responsive">

        <table class="table table-hover ">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($pengelola as $p) : ?>
              <tr>
                <td><?= $i++ ?> </td>
                <td><?= $p->nama ?></td>
                <td><?= $p->email ?></td>
                <td class="d-flex gap-1 ">
                  <a href="<?= base_url('edit_pengelola/') . $p->id ?> " class="btn btn-sm btn-primary"><i class='bx bxs-edit mx-auto'></i></a>
                  <a href="<?= base_url('delete_pengelola/' . $p->id) ?>" class="btn btn-sm btn-danger hapus-pengelola"><i class='bx bxs-trash mx-auto'></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endif ?>