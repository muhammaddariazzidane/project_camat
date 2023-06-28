<h3>Riwayat pengajuan</h3>
<div class="card radius-10">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-center">
            <th>Nama pengaju</th>
            <th>Nomor dokumen</th>
            <th>Nama dokumen</th>
            <th>Tgl pengajuan</th>
            <th>Tgl selesai</th>
            <th>Status</th>
            <!-- <th>Keterangan</th> -->

          </tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $r) : ?>
            <tr class="text-center">
              <td><?= $r->nama ?></td>
              <td><?= $r->nomor_dokumen ?></td>
              <td><?= $r->nama_dokumen ?></td>
              <td><?= dateindo($r->tgl_pengajuan) ?></td>
              <td><?= strlen($r->tgl_selesai > 0) ? dateindo($r->tgl_selesai) : '-' ?></td>
              <td class="text-center <?= $r->status == 2 ? 'text-success' : 'text-danger' ?>"><?= $r->status == 2 ? '<i class="bx bx-check-circle fs-3"></i>' : '<i class="bx bx-x-circle fs-3"></i>' ?></td>
              <!-- <td class="text-center"><?= $r->keterangan ? $r->keterangan : '-'  ?></td> -->
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <?= $this->pagination->create_links(); ?>

</div>