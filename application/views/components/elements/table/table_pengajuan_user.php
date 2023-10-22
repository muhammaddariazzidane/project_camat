<tr>
    <td><?= $d->nomor_surat ?></td>
    <td><?= $d->nama_surat ?></td>
    <td class="text-center"><?= dateindo($d->tgl_pengajuan) ?></td>
    <td class="text-center"><?= strlen($d->tgl_selesai > 0) ? dateindo($d->tgl_selesai) : '-'  ?></td>
    <td>
        <?php
        $status = [
            'class' => $d->status == 0 ? 'text-bg-secondary' : ($d->status == 1 ? 'text-bg-primary' : ($d->status == 2 ? 'text-bg-success' : 'text-bg-danger')),
            'text' => $d->status == 0 ? 'Pending' : ($d->status == 1 ? 'Disetujui petugas' : ($d->status == 2 ? 'Selesai' : 'Ditolak'))
        ];
        $this->load->view('components/elements/badge/badge_status', $status) ?>
    </td>
    <?php if ($d->status == 2 && $d->printed == 0) : ?>
        <td>
            <a download="false" href="<?= base_url('pdf/cetak/') . $d->file_surat . '/' . $d->id  ?>" class="badge lihat py-2 mx-5 text-bg-primary d-flex align-items-center justify-content-center"><span>Lihat surat</span> <i class="bx bx-show fs-6"></i></a>
        </td>
    <?php else : ?>
        <?php if ($d->status == 0 | $d->status == 1 && $d->printed == 0) : ?>
            <td class="text-center"><small class="text-muted">Belum bisa melihat surat</small></td>
        <?php else : ?>
            <?php if ($d->status == 3) : ?>
                <td class="text-center"><small class="text-muted">Tidak dapat melihat surat</small></td>
            <?php else : ?>
                <td class="text-center"><small class="text-muted">surat sudah dilihat</small></td>
            <?php endif ?>
        <?php endif ?>
    <?php endif ?>
</tr>