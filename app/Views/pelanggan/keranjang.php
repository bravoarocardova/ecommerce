<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container p-0 mt-4">
  <div class="container " id="produk">

    <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-arrow-left opacity-10"></i> Kembali</a>

    <?php if (session()->has('msg')) : ?>
      <?= session()->getFlashdata('msg') ?>
    <?php endif ?>

    <div class="row my-3">
      <div class="card">
        <div class="card-header">
          <h3>
            <i class="fa fa-shopping-cart me-sm-1 text-dark"></i>
            Keranjang
          </h3>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Kondisi</th>
                <th>Berat</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart->contents() as $produk) : ?>
                <tr>
                  <td class="w-25"><input type="text" value="<?= $produk['qty'] ?>" class="form-control"></td>
                  <td><img src="<?= base_url() . '/img/produk/' . $produk['options']['foto'] ?>" class="img-fluid rounded-start avatar" alt="Cover"></td>
                  <td><?= $produk['name'] ?></td>
                  <td><?= $produk['options']['kondisi'] ?></td>
                  <td><?= $produk['options']['berat'] ?> g</td>
                  <td>Rp. <?= number_format($produk['price'] ?? 0) ?></td>
                  <td>
                    <form action="<?= base_url() . '/keranjang/' . $produk['rowid'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5">
                  <h4>
                    Total
                  </h4>
                </td>
                <td>
                  <h4>
                    Rp. <?= number_format($cart->total()) ?>
                  </h4>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>

  </div>
</div>
<!-- 
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
</div> -->


<?= $this->endSection() ?>