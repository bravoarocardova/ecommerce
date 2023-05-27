<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="bg-light mb-4">
  <div class="container">
    <form action="<?= base_url() . '/produk' ?>" method="get">
      <div class="row d-flex justify-content-center mb-n4">
        <div class="col-6 p-4">
          <div class="input-group ">
            <input class="form-control border-end-0 border rounded" type="text" value="<?= $pencarian == 'Produk' ? '' : $pencarian ?>" required placeholder="Pencarian" name="cari" id="example-search-input">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary bg-white border-start-0 border rounded ms-1" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>
      </div>
    </form>
    <div class="row text-center">
      <h3><?= $pencarian ?> </h3>
    </div>
  </div>
</div>
<div class="container p-0">
  <div class="row">
    <?php foreach ($produk as $row) : ?>
      <div class="col-3 mb-2">
        <div class="card card-produk">
          <img src="<?= base_url() . '/img/produk/' . $row['foto_produk'] ?>" class="card-img-top" alt="...">
          <div class="card-body text-center">
            <h5 class="card-title text-truncate" title="<?= $row['nama_produk'] ?>">
              <a href="<?= base_url() . '/produk/' . $row['id_produk'] ?>" class="text-dark text-decoration-none ">
                <?= $row['nama_produk'] ?>
              </a>
            </h5>
            <div class="row">
              <div class="col-8">
                <?php if ($row['diskon'] != 0) : ?>
                  <strike>
                    <p class="card-text text-danger position-relative">Rp. <?= number_format($row['harga_produk']) ?>
                      <span class="badge bg-danger position-absolute"><?= $row['diskon'] ?>%</span>
                    </p>
                  </strike>
                  <p>Rp. <?= number_format($row['harga_produk'] - ($row['harga_produk'] * ($row['diskon'] / 100))) ?>
                  </p>

                <?php else : ?>
                  <p class="card-text text-danger">Rp. <?= number_format($row['harga_produk']) ?></p>
                <?php endif ?>
              </div>
              <div class="col-4">
                <p class="card-text text-secondary">Stok <?= number_format($row['stok_produk']) ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<?= $this->endSection() ?>