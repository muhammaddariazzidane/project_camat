<h3>Riwayat pengajuan</h3>
<div class="card radius-10">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-center">
            <th>Nama pengaju</th>
            <th>Nomor surat</th>
            <th>Nama surat</th>
            <th>Tgl pengajuan</th>
            <th>Tgl selesai</th>
            <th>Keterangan</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($riwayat)) : ?>
            <?php foreach ($riwayat as $r) : ?>
              <tr class="text-center">
                <td><?= $r->nama ?></td>
                <td><?= $r->nomor_surat ?></td>
                <td><?= $r->nama_surat ?></td>
                <td><?= dateindo($r->tgl_pengajuan) ?></td>
                <td><?= strlen($r->tgl_selesai > 0) ? dateindo($r->tgl_selesai) : '-' ?></td>
                <td class="text-center"><?= $r->keterangan ? $r->keterangan : '-'  ?></td>
                <td class="text-center <?= $r->status == 2 ? 'text-success' : 'text-danger' ?>"><?= $r->status == 2 ? '<i class="bx bx-check-circle fs-3"></i>' : '<i class="bx bx-x-circle fs-3"></i>' ?></td>
              </tr>
            <?php endforeach ?>
          <?php else : ?>
            <td colspan="10">
              <div class="alert alert-warning text-center " role="alert">
                <h1 class="fs-4"> Belum ada riwayat pengajuan!</h1>
              </div>
            </td>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
  <?= $this->pagination->create_links(); ?>
</div>