<h3>Riwayat pengajuan</h3>
<div class="card radius-10">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Nama pengaju</th>
            <th>Nomor dokumen</th>
            <th>Nama dokumen</th>
            <th>Tgl pengajuan</th>
            <th>Tgl selesai</th>
            <th>Status</th>
            <th>Keterangan</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $r) : ?>
            <tr>
              <td><?= $r->nama ?></td>
              <td><?= $r->nomor_dokumen ?></td>
              <td><?= $r->nama_dokumen ?></td>
              <td><?= date('d-M-Y', $r->tgl_pengajuan) ?></td>
              <td><?= date('d-M-Y', $r->tgl_selesai) ?></td>
              <td><?= $r->status == 2 ? 'Selesai' : '' ?></td>
              <td class="text-center"><?= $r->keterangan ? $r->keterangan : '-'  ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>