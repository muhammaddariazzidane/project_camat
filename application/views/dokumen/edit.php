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
          <input type="file" id="pdfFileInput" name="file_dokumen" class="form-control" accept="application/pdf">
          <div class="mt-3" id="pdfPreviewContainer"></div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>



<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
  const pdfFileInput = document.getElementById('pdfFileInput');
  const pdfPreviewContainer = document.getElementById('pdfPreviewContainer');

  pdfFileInput.addEventListener('change', () => {
    const file = pdfFileInput.files[0];
    const fileReader = new FileReader();

    fileReader.onload = function() {
      const typedarray = new Uint8Array(this.result);
      const loadingTask = pdfjsLib.getDocument({
        data: typedarray
      });

      loadingTask.promise.then(function(pdf) {
        const pageNumber = 1;
        const scale = 0.5; // Ubah skala sesuai kebutuhan Anda

        pdf.getPage(pageNumber).then(function(page) {
          const viewport = page.getViewport({
            scale
          });
          const canvas = document.createElement('canvas');
          const context = canvas.getContext('2d');
          const renderContext = {
            canvasContext: context,
            viewport: viewport
          };

          const outputWidth = 300; // Lebar gambar preview yang diinginkan
          canvas.width = outputWidth;
          canvas.height = (viewport.height / viewport.width) * outputWidth;

          page.render(renderContext).promise.then(function() {
            const image = new Image();
            image.src = canvas.toDataURL();
            pdfPreviewContainer.innerHTML = '';
            pdfPreviewContainer.appendChild(image);
          });
        });
      });
    };

    fileReader.readAsArrayBuffer(file);
  });
</script>
<!-- 
<script>
  const pdfFileInput = document.getElementById('pdfFileInput');
  const pdfPreviewContainer = document.getElementById('pdfPreviewContainer');

  pdfFileInput.addEventListener('change', () => {
    const file = pdfFileInput.files[0];
    const fileReader = new FileReader();

    fileReader.onload = function() {
      const typedarray = new Uint8Array(this.result);
      const loadingTask = pdfjsLib.getDocument({
        data: typedarray
      });

      loadingTask.promise.then(function(pdf) {
        const pageNumber = 1;
        const scale = 0.5; // Ubah skala sesuai kebutuhan Anda

        pdf.getPage(pageNumber).then(function(page) {
          const viewport = page.getViewport({
            scale
          });
          const canvas = document.createElement('canvas');
          const context = canvas.getContext('2d');
          const renderContext = {
            canvasContext: context,
            viewport: viewport
          };

          const outputWidth = 300; // Lebar gambar preview yang diinginkan
          const outputHeight = (viewport.height / viewport.width) * outputWidth;

          canvas.width = outputWidth;
          canvas.height = outputHeight;

          // Render latar belakang pada canvas
          context.fillStyle = 'lightgray'; // Ubah warna latar belakang
          context.fillRect(0, 0, canvas.width, canvas.height);

          page.render(renderContext).promise.then(function() {
            const imageData = canvas.toDataURL();
            const image = new Image();

            image.onload = function() {
              context.drawImage(image, 0, 0, outputWidth, outputHeight);
              const finalImage = new Image();
              finalImage.src = canvas.toDataURL();
              pdfPreviewContainer.innerHTML = '';
              pdfPreviewContainer.appendChild(finalImage);
            };

            image.src = imageData;
          });
        });
      });
    };

    fileReader.readAsArrayBuffer(file);
  });
</script> -->