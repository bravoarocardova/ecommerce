<?= $this->sectiono('content') ?>

<div class="bg-light p-4 mt-5" id="produk">
  <div class="container">
    <div class="row text-center">
      <h4 class="fw-bold text-primary text-gradient">PEMBAYARAN</h4>
    </div>
    <div class="row mt-4">
      <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>kirim bukti pembayaran anda di sini</p>
        <div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($peminjaman->total_peminjaman + $peminjaman->ongkir) ?></strong></div>

        <form method="post" action="<?= base_url('produk/pembayaran_proses') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_peminjaman" value="<?= $peminjaman->id_peminjaman ?>">
          <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" class="form-control" value="" name="nama" required>
          </div>
          <div class="form-group">
            <label>Bank</label>
            <input type="text" class="form-control" value="" name="bank" required>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="<?= $peminjaman->total_peminjaman + $peminjaman->ongkir ?>" required>
          </div>
          <div class="form-group">
            <label>Foto Bukti</label>
            <input type="file" class="form-control" name="bukti" required>
            <p class="text-danger">foto harus JPG maksimal 2MB</p>
          </div>
          <button class="btn btn-success btn_1" name="bayar">Kirim</button>
        </form>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>