<h3>Edit Dokumen</h3>
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <?= form_open_multipart('dokumen/update/' . $dokumen->id) ?>
        <div class="mb-3">
          <label for="nomor_dokumen" class="form-label">Nomor dokumen</label>
          <input type="text" class="form-control" value="<?= $dokumen->nomor_dokumen ?>" id="nomor_dokumen" name="nomor_dokumen" placeholder="001" readonly>
        </div>
        <div class="mb-3">
          <label for="nama_dokumen" class="form-label">Nama dokumen</label>
          <input type="text" class="form-control" value="<?= $dokumen->nama_dokumen ?>" id="nama_dokumen" name="nama_dokumen" placeholder="nama dokumen">
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" id="keterangan" rows="3"><?= $dokumen->keterangan ?></textarea>
        </div>
        <div class="mb-3">
          <label for="file_dokumen" class="form-label">File</label>
          <input type="file" id="pdfFileInput" onchange="handlePrev()" name="file_dokumen" class="form-control" accept="application/pdf">
          <div class="ratio ratio-16x9 mt-3 ">
            <embed type="application/pdf" id="doc-preview" src="<?= base_url('assets/upload/' . $dokumen->file_dokumen) ?>"></embed>
          </div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="mt-3" id="pdfPreviewContainer"></div>

<script>
  function handlePrev() {
    const docPreview = document.getElementById('doc-preview');
    const pdfFileInput = document.getElementById('pdfFileInput');
    if (pdfFileInput.files.length > 0) {
      const filePrev = new FileReader();
      filePrev.readAsDataURL(pdfFileInput.files[0]);
      const maxFileSize = 1000000; // 1 MB
      const fileSize = pdfFileInput.files[0].size;
      filePrev.onload = function(e) {
        console.log(fileSize);
        if (fileSize > maxFileSize) {
          return alert('Ukuran file terlalu besar. Ukuran file tidak boleh melebihi 1 MB.');
        } else {
          docPreview.src = e.target.result;
        }
      };
    }
  }
</script>