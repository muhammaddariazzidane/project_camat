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
            <th>Nama pengaju</th>
            <?php if ($role_id != 3) : ?>
              <th>Nomor dokumen</th>
            <?php endif ?>
            <th>Nama dokumen</th>
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
              <th class="text-center">file dokumen</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php foreach ($pengajuan as $d) : ?>
            <!-- admin -->
            <?php if ($role_id == 1 && $d->status == 1) : ?>
              <tr>
                <td><?= $d->nama ?></td>
                <td><?= $d->nomor_dokumen ?></td>
                <td><?= $d->nama_dokumen ?></td>
                <td><?= dateindo($d->tgl_pengajuan) ?></td>
                <td><?= $d->alasan ?></td>
                <td>
                  <span class="badge p-2 <?= $d->status == 0 ? 'text-bg-secondary' : ($d->status == 1 ? 'text-bg-primary' : ($d->status == 2 ? 'text-bg-success' : 'text-bg-danger')) ?>">
                    <?= $d->status == 0 ? 'Pending' : ($d->status == 1 ? 'Disetujui petugas' : ($d->status == 2 ? 'Selesai' : 'Ditolak')) ?>
                  </span>
                </td>
                <!-- <td class="text-center"><?= $d->keterangan ? $d->keterangan : '-' ?></td> -->
                <?php if ($d->status == 2) : ?>
                  <td class="d-flex justify-content-center">
                    <button class="btn btn-dark btn-sm" disabled>Selesai</button>
                  </td>
                <?php else : ?>
                  <td class="d-flex gap-1 mx-auto justify-content-center">
                    <?php if ($d->status == 3) : ?>
                      -
                    <?php else : ?>
                      <a href="<?= base_url('ubah_status/') . $d->id ?>" class="btn btn-sm btn-success">Setujui</a>
                      <!-- <a href="<?= base_url('tolak_pengajuan/' . $d->id) ?>" class="btn btn-sm btn-danger">Tolak</a> -->
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalTolakCamat">Tolak</button>
                      <div class="modal fade" id="exampleModalTolakCamat" aria-labelledby="exampleModalTolakCamat" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalTolakCamat">Form Penolakan</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                              <?= form_open('tolak_pengajuan/' . $d->id)  ?>
                              <label for="keterangan" class="form-label">keterangan (Opsional)</label>
                              <input type="text" name="keterangan" id="keterangan" class="form-control" />
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                            <?= form_close() ?>
                          </div>
                        </div>
                      </div>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>

            <?php endif ?>
            <!-- petugas -->
            <?php if ($role_id == 2 && $d->status == 0 | $d->status == 1) : ?>
              <tr>
                <td><?= $d->nama ?></td>
                <td><?= $d->nomor_dokumen ?></td>
                <td><?= $d->nama_dokumen ?></td>
                <td><?= dateindo($d->tgl_pengajuan) ?></td>
                <td><?= $d->alasan ?></td>
                <td>
                  <span class="badge p-2 <?= $d->status == 0 ? 'text-bg-secondary' : ($d->status == 1 ? 'text-bg-primary' : ($d->status == 2 ? 'text-bg-success' : 'text-bg-danger')) ?>">
                    <?= $d->status == 0 ? 'Pending' : ($d->status == 1 ? 'Menunggu persetujuan camat' : ($d->status == 2 ? 'Selesai' : 'Ditolak')) ?>
                  </span>
                </td>
                <!-- <td class="text-center"><?= $d->keterangan ? $d->keterangan : '-' ?></td> -->
                <?php if ($d->status == 2) : ?>
                  <td><a href="<?= base_url('assets/upload/') . $d->file_dokumen ?>" download class="badge py-2 px-4 text-bg-primary">unduh dokumen</a></td>
                  <td>
                    <button class="btn btn-dark btn-sm mx-auto">Selesai</button>
                  </td>
                <?php else : ?>
                  <td class="d-flex gap-1 justify-content-center">
                    <?php if ($d->status == 0) : ?>
                      <a href="<?= base_url('ubah_status/') . $d->id ?>" class="btn btn-sm btn-success">Setujui</a>
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalTolakPetugas">Tolak</button>
                      <div class="modal fade" id="exampleModalTolakPetugas" aria-labelledby="exampleModalTolakPetugas" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalTolakPetugas">Form Penolakan</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                              <?= form_open('tolak_pengajuan/' . $d->id)  ?>
                              <label for="keterangan" class="form-label">keterangan (Opsional)</label>
                              <input type="text" name="keterangan" id="keterangan" class="form-control" />
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                            <?= form_close() ?>
                          </div>
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="text-center">-</div>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>

            <?php endif ?>
            <!--  -->
            <?php if ($role_id == 3) : ?>
              <tr>
                <td><?= $d->nama ?></td>
                <!-- <td><?= $d->nomor_dokumen ?></td> -->
                <td><?= $d->nama_dokumen ?></td>
                <td class="text-center"><?= dateindo($d->tgl_pengajuan) ?></td>
                <td class="text-center"><?= strlen($d->tgl_selesai > 0) ? dateindo($d->tgl_selesai) : '-'  ?></td>
                <td>
                  <span class="badge p-2 <?= $d->status == 0 ? 'text-bg-secondary' : ($d->status == 1 ? 'text-bg-primary' : ($d->status == 2 ? 'text-bg-success' : 'text-bg-danger')) ?>">
                    <?= $d->status == 0 ? 'Pending' : ($d->status == 1 ? 'Disetujui petugas' : ($d->status == 2 ? 'Selesai' : 'Ditolak')) ?>
                  </span>
                </td>
                <!-- <td class="text-center"><?= $d->keterangan ? $d->keterangan : '-' ?></td> -->
                <?php if ($d->status == 2 && $d->printed == 0) : ?>
                  <td>
                    <a download="false" href="<?= base_url('pdf/cetak/') . $d->file_dokumen . '/' . $d->id  ?>" class="badge lihat py-2 mx-5 text-bg-primary d-flex align-items-center justify-content-center"><span>Lihat dokumen</span> <i class="bx bx-show fs-6"></i></a>
                  </td>
                <?php else : ?>
                  <?php if ($d->status == 0 | $d->status == 1 && $d->printed == 0) : ?>
                    <td class="text-center"><small class="text-muted">Belum bisa melihat dokumen</small></td>
                  <?php else : ?>
                    <?php if ($d->status == 3) : ?>
                      <td class="text-center"><small class="text-muted">Tidak dapat melihat dokumen</small></td>

                    <?php else : ?>
                      <td class="text-center"><small class="text-muted">Dokumen sudah dilihat</small></td>
                    <?php endif ?>
                  <?php endif ?>

                <?php endif ?>
                <!-- <td><span class="badge bg-success text-white shadow-sm">Paid</span></td> -->
              </tr>
            <?php endif ?>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
  </div>
  <?= $this->pagination->create_links() ?>
</div>