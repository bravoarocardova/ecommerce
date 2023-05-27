<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container p-0 mt-4">
  <div class="container" id="produk">

    <!-- <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-arrow-left opacity-10"></i> Kembali</a> -->

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
          <form action="" method="post">
            <input type="hidden" name="_method" value="PUT">
            <table class="table">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Kondisi</th>
                  <th>Berat</th>
                  <th>Garansi</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_berat = 0;
                $total = 0;
                ?>
                <?php foreach ($cart as $produk) : ?>
                  <?php
                  $max = $produk['detail']['stok_produk'];
                  ?>
                  <tr>
                    <td width="15%">
                      <?php if ($max > 0) : ?>
                        <?php if ($produk['qty'] <= $max) : ?>
                          <input type="number" value="<?= $produk['qty'] ?>" min='1' max="<?= $max ?>" class="form-control" name="qty[<?= $produk['rowid'] ?>]">
                        <?php else : ?>
                          <input type="number" value="<?= $produk['qty'] ?>" min='1' max="<?= $max ?>" class="form-control text-danger" name="qty[<?= $produk['rowid'] ?>]">
                          <span class="text-danger">Stok tidak mencukupi,</span>
                        <?php endif ?>
                      <?php else : ?>
                        <input type="text" value="STOK HABIS" class="form-control" disabled>
                      <?php endif ?>
                      <span class="text-danger">Stok tersisa : <?= $max ?></span>
                    </td>
                    <td><img src="<?= base_url() . '/img/produk/' . $produk['detail']['foto_produk'] ?>" class="img-fluid rounded-start avatar" alt="Cover"></td>
                    <td width="25%"><?= $produk['detail']['nama_produk'] ?></td>
                    <td><?= $produk['detail']['kondisi_produk'] ?></td>
                    <td><?= $produk['detail']['berat_produk'] * $produk['qty'] ?> g</td>
                    <td><?= $produk['detail']['garansi'] ?></td>
                    <td>
                      <?php

                      $harga = $produk['detail']['harga_produk'];
                      $diskon = $produk['detail']['diskon'];
                      $qty = $produk['qty'];
                      $subtotal = $harga * $qty;
                      ?>
                      <?php
                      if ($diskon != 0) :

                        $harga_diskon = $harga - ($harga * ($diskon / 100));
                        $subtotal_diskon = $harga_diskon * $qty;
                        $total += $subtotal_diskon;
                      ?>
                        <strike>
                          <h6 class="card-text text-danger position-relative">Rp. <?= number_format($subtotal) ?>
                            <span class="badge bg-danger"><?= $diskon ?>%</span>
                          </h6>
                        </strike>
                        <h6>
                          Rp. <?= number_format($subtotal_diskon) ?>
                        </h6>

                      <?php else :
                        $total += $subtotal;
                      ?>
                        <h6>
                          Rp. <?= number_format($subtotal ?? 0) ?>
                        </h6>
                      <?php endif ?>
                    </td>
                    <td>
                      <a href="<?= base_url() . '/keranjang/hapus/' . $produk['rowid'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php $total_berat += $produk['detail']['berat_produk'] * $produk['qty']; ?>
                <?php endforeach ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
            <div class="row mb-4 border-bottom">
              <div class="col-md-6 offset-md-4">
                <div class="d-flex justify-content-between">
                  <h4>
                    Total Berat
                  </h4>
                  <h4>
                    <?= number_format($total_berat) ?> g
                  </h4>
                </div>
                <div class="d-flex justify-content-between">
                  <h4>
                    Total
                  </h4>
                  <h4>
                    Rp. <?= number_format($total ?? 0) ?>
                  </h4>
                </div>
              </div>
            </div>
            <?php if (count($cart) != 0) : ?>
              <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-warning p-3"><i class="fa fa-sync opacity-10 me-2"></i> Update Keranjang</button>
                <a href="<?= base_url() . '/checkout' ?>" class="btn btn-primary p-3"><i class="fa fa-shopping-cart opacity-10 me-2"></i> Checkout</a>
              </div>
            <?php else : ?>
              <script>
                alert('Keranjang kosong')
                window.location.href = '<?= base_url() ?>'
              </script>
            <?php endif ?>
          </form>
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