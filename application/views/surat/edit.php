<h1 class="fs-3 mb-3">Edit Surat Tanah</h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <?= form_open_multipart('surat/update/' . $surat->id) ?>
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor surat</label>
                    <input type="text" class="form-control" value="<?= $surat->nomor_surat ?>" id="nomor_surat" name="nomor_surat" placeholder="001">
                </div>
                <div class="mb-3">
                    <label for="nama_surat" class="form-label">Nama surat</label>
                    <input type="text" class="form-control" value="<?= $surat->nama_surat ?>" id="nama_surat" name="nama_surat" placeholder="nama surat">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3"><?= $surat->keterangan ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="pemilik" class="form-label">Nama pemilik</label>
                    <input type="text" class="form-control" value="<?= $surat->pemilik ?>" id="pemilik" name="pemilik" placeholder="nama pemilik">
                </div>
                <div class="mb-3">
                    <label for="file_surat" class="form-label">File</label>
                    <input type="file" id="pdfFileInput" onchange="handlePrev()" name="file_surat" class="form-control" accept="application/pdf">
                    <div class="ratio ratio-16x9 mt-3 ">
                        <embed type="application/pdf" id="doc-preview" src="<?= base_url('assets/upload/' . $surat->file_surat) ?>"></embed>
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