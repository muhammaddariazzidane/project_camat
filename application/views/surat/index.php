<?php
$role_id = $this->session->role_id;
?>
<h3 class="mb-3">Data Surat Tanah</h3>

<?php $this->load->view('components/elements/modal/modal_tambah_surat') ?>
<?php if ($role_id != 3) : ?>
    <div class="row d-flex justify-content-between">
        <div class="col-lg-5">

            <button type="button" class="btn btn-primary mb-3 w-auto " data-bs-toggle="modal" data-bs-target="#exampleModal3">
                Tambah Surat Tanah
            </button>
        </div>
        <div class="col-lg-5">
            <form method="GET" action="<?= base_url('surat') ?>" class="input-group mb-3">
                <input type="text" autocomplete="off" class="form-control" name="keyword" value="<?= $keyword ?>" placeholder="Cari surat tanah..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="input-group-text" id="basic-addon2" type="submit">Cari</button>
            </form>
        </div>
    </div>
<?php endif ?>


<div class="flash-data-success" data-flashdata="<?= $this->session->success ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->info ?>"></div>
<div class="flash-data-error_doc" data-flashdata="<?= $this->session->error_doc ?>"></div>

<?php if (validation_errors()) : ?>
    <div class="flash-data-error" data-flashdata="<?= validation_errors() ?>"></div>
<?php endif ?>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Nomor surat tanah</th>
                        <th>Nama surat tanah</th>
                        <th>Pemilik</th>
                        <th>Keterangan</th>
                        <th>Tanggal dibuat</th>
                        <th>File surat tanah</th>
                        <?php if ($role_id != 3) : ?>
                            <th class="text-center">Aksi</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($surat)) : ?>
                        <?php foreach ($surat as $d) : ?>
                            <tr class="text-center">
                                <td><?= $d->nomor_surat ?></td>
                                <td><?= $d->nama_surat ?></td>
                                <td><?= $d->keterangan ?></td>
                                <td><?= $d->pemilik ?></td>
                                <td><?= dateindo($d->tgl_dibuat) ?></td>
                                <?php if ($role_id == 3) : ?>
                                    <td><button type="button" class="badge  btn py-2 px-4 text-bg-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajukan ingin lihat</button></td>
                                    <?php $this->load->view('components/elements/modal/modal_pengajuan', ['id' => $d->id]); ?>
                                <?php else : ?>
                                    <td><a href="<?= base_url('assets/upload/') . $d->file_surat ?>" class="badge py-2 px-4 text-bg-primary">Lihat</a></td>
                                <?php endif ?>
                                <?php if ($role_id != 3) : ?>
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="<?= base_url('edit_surat/') . $d->id ?> " class="btn btn-sm btn-primary"><i class='bx bxs-edit mx-auto'></i></a>
                                        <a href="<?= base_url('delete_surat/' . $d->id) ?>" class="btn btn-sm btn-danger hapus"><i class='bx bxs-trash mx-auto'></i></a>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <td colspan="10">
                            <div class="alert alert-warning text-center " role="alert">
                                <h1 class="fs-4"> Surat Tidak Ditemukan!</h1>
                            </div>
                        </td>
                    <?php endif ?>
                </tbody>

            </table>
        </div>
    </div>
    <?= $this->pagination->create_links(); ?>
</div>