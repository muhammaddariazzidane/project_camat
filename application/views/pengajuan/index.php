<h3>Data Pengajuan</h3>
<?php
$role_id = $this->session->role_id;
?>
<div class="flash-data-success" data-flashdata="<?= $this->session->success ?>"></div>

<div class="card radius-10">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-center">
            <?php if ($role_id != 3) : ?>
              <th>Nama pengaju</th>
            <?php endif ?>
            <th>Nomor surat</th>
            <th>Nama surat</th>
            <th>Tanggal pengajuan</th>
            <?php if ($role_id != 3) : ?>
              <th>Alasan</th>
            <?php endif ?>
            <?php if ($role_id == 3) : ?>
              <th>Tanggal selesai</th>
            <?php endif ?>
            <th>Status</th>
            <!-- <th>Keterangan</th> -->
            <?php if ($role_id != 3) : ?>
              <th class="text-center">Ubah status</th>
            <?php endif ?>
            <?php if ($role_id == 3) : ?>
              <th class="text-center">file surat</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (!empty($pengajuan)) : ?>
            <?php foreach ($pengajuan as $d) : ?>
              <!-- admin -->
              <?php if ($role_id == 1 && $d->status == 1) : ?>
                <?php $this->load->view('components/elements/table/table_pengajuan_camat', ['d' => $d]) ?>
              <?php endif ?>
              <!-- petugas -->
              <?php if ($role_id == 2 && $d->status == 0 | $d->status == 1) : ?>
                <?php $this->load->view('components/elements/table/table_pengajuan_petugas', ['d' => $d]) ?>
              <?php endif ?>
              <!-- user -->
              <?php if ($role_id == 3) : ?>
                <?php $this->load->view('components/elements/table/table_pengajuan_user', ['d' => $d]) ?>
              <?php endif ?>
            <?php endforeach ?>
          <?php else : ?>
            <td colspan="10">
              <div class="alert alert-warning text-center " role="alert">
                <h1 class="fs-4">Surat Tidak Ditemukan!</h1>
              </div>
            </td>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
  <?= $this->pagination->create_links() ?>
</div>