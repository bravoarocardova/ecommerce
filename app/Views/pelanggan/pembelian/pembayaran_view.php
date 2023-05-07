<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="bg-light p-4" id="produk">
  <div class="container">
    <div class="row text-center">
      <h4 class="fw-bold text-primary text-gradient">PEMBAYARAN</h4>
    </div>
    <div class="row mt-4">
      <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>kirim bukti pembayaran anda di sini</p>
        <div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($pembelian['total_pembelian'] + $pembelian['ongkir']) ?></strong></div>

        <form method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="id_pembelian" value="<?= $pembelian['id_pembelian'] ?>">
          <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" value="" name="nama">
            <div class="invalid-feedback">
              <?= validation_show_error('nama') ?>
            </div>
          </div>
          <div class="form-group">
            <label>Bank</label>
            <input type="text" class="form-control <?= validation_show_error('bank') ? 'is-invalid' : '' ?>" value="" name="bank">
            <div class="invalid-feedback">
              <?= validation_show_error('bank') ?>
            </div>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control <?= validation_show_error('jumlah') ? 'is-invalid' : '' ?>" name="jumlah" min="<?= $pembelian['total_pembelian'] + $pembelian['ongkir'] ?>">
            <div class="invalid-feedback">
              <?= validation_show_error('jumlah') ?>
            </div>
          </div>
          <div class="form-group">
            <label>Foto Bukti</label>
            <input type="file" class="form-control <?= validation_show_error('bukti') ? 'is-invalid' : '' ?>"" name=" bukti">
            <div class="invalid-feedback">
              <?= validation_show_error('bukti') ?>
            </div>
            <p class="text-danger">foto harus JPG maksimal 2MB</p>
          </div>
          <button class="btn btn-success btn_1" name="bayar">Kirim</button>
        </form>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>