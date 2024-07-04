<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Surat Tanah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('tambah_surat') ?>
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat Tanah</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="001 / 2022" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                        <?= form_error('nomor_surat') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_surat" class="form-label">Nama surat</label>
                    <input type="text" class="form-control" id="nama_surat" name="nama_surat" placeholder="nama surat" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                        <?= form_error('nama_surat') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required></textarea>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                        <?= form_error('keterangan') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pemilik" class="form-label">Nama pemilik</label>
                    <input type="text" class="form-control" id="pemilik" name="pemilik" placeholder="Nama pemilik" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback d-block">
                        <?= form_error('pemilik') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="file_surat" class="form-label">File</label>
                    <input type="file" name="file_surat" id="file_surat" class="form-control" accept="application/pdf,application/vnd.ms-excel" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>