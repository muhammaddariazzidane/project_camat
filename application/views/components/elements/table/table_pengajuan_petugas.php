<tr>
    <td><?= $d->nama ?></td>
    <td><?= $d->nomor_surat ?></td>
    <td><?= $d->nama_surat ?></td>
    <td><?= dateindo($d->tgl_pengajuan) ?></td>
    <td><?= $d->alasan ?></td>
    <td>
        <?php
        $status = [
            'class' => $d->status == 0 ? 'text-bg-secondary' : ($d->status == 1 ? 'text-bg-primary' : ($d->status == 2 ? 'text-bg-success' : 'text-bg-danger')),
            'text' => $d->status == 0 ? 'Pending' : ($d->status == 1 ? 'Menunggu persetujuan camat' : ($d->status == 2 ? 'Selesai' : 'Ditolak'))
        ];
        $this->load->view('components/elements/badge/badge_status', $status) ?>
    </td>
    <?php if ($d->status == 2) : ?>
        <td><a href="<?= base_url('assets/upload/') . $d->file_surat ?>" download class="badge py-2 px-4 text-bg-primary">unduh surat</a></td>
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