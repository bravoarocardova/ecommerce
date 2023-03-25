<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="bg-light mb-4">
  <div class="container">
    <form action="<?= base_url() . '/produk' ?>" method="get">
      <div class="row d-flex justify-content-center mb-n4">
        <div class="col-6 p-4">
          <div class="input-group ">
            <input class="form-control border-end-0 border rounded" type="text" value="" required placeholder="Pencarian" name="cari" id="example-search-input">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary bg-white border-start-0 border rounded ms-1" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="container p-0">
  <div class="container " id="produk">

    <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-arrow-left opacity-10"></i> Kembali</a>

    <div class="row my-3">
      <div class="col-md-4">
        <img src="<?= base_url() . '/img/produk/' . $produk['foto_produk'] ?>" class="img-fluid rounded-start" alt="Cover">
      </div>
      <div class="col-md-8 col-12">
        <div class="row">
          <h2><?= $produk['nama_produk'] ?></h2>
          <h5 class="text-danger text-sm">Rp. <?= number_format($produk['harga_produk'] ?? 0) ?></h5>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4 col-4 ">
            <p>Kondisi</p>
          </div>
          <div class="col-md-8 col-8">
            <p class="font-weight-bolder"><?= $produk['kondisi_produk'] ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-4 ">
            <p>Stok</p>
          </div>
          <div class="col-md-8 col-8">
            <p class="font-weight-bolder"><?= $produk['stok_produk'] ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-4 ">
            <p>Berat</p>
          </div>
          <div class="col-md-8 col-8">
            <p class="font-weight-bolder"><?= $produk['berat_produk'] ?> g</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-4">
            <p>Deskripsi</p>
          </div>
          <div class="col-md-8 col-8">
            <p class="font-weight-bolder"><?= $produk['deskripsi_produk'] ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <a href="" class="btn btn-warning">
              <i class="fa fa-cart-plus opacity-10"></i>
              Tambahkan Ke keranjang
            </a>
            <a href="" class="btn btn-primary">
              <i class="fa fa-money-bill opacity-10"></i>
              Beli Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="p-0 mt-5 bg-light">
  <div class="container p-4">
    <div class="row text-center mb-4">
      <h3>Produk Lain</h3>
    </div>
    <div class="row">
      <?php foreach ($produk_lain as $row) : ?>
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
                <div class="col-6">
                  <p class="card-text text-danger">Rp. <?= number_format($row['harga_produk']) ?></p>
                </div>
                <div class="col-6">
                  <p class="card-text text-secondary">Stok <?= number_format($row['stok_produk']) ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>