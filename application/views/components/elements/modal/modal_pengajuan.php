<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alasan ingin lihat Surat Tanah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('tambah_pengajuan')  ?>
            <div class="modal-body text-start">
                <label for="keterangan" class="form-label">Alasan </label>
                <input type="text" name="alasan" id="alasan" class="form-control" placeholder="keperluan audit" required />
            </div>
            <input type="hidden" name="surat_id" id="surat_id" value="<?= $id ?>" class="form-control" />
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ajukan">Ajukan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>