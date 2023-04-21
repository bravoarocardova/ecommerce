<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="bg-light mb-4">
  <div class="container">
    <form action="<?= base_url() . '/cekservis' ?>" method="post">
      <div class="row d-flex justify-content-center mb-n4">
        <div class="col-6 p-4">
          <div class="input-group ">
            <input class="form-control border-end-0 border rounded" type="text" value="<?= $no_transaksi ?>" required placeholder="Masukkan No Transaksi untuk Cek Servis" name="no_transaksi" id="example-search-input">
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
      <h3><?= $no_transaksi ?> </h3>
    </div>
  </div>
</div>

<?php if ($no_transaksi !== null) : ?>
  <div class="container p-0">
    <div class="row">
      <div class="col-6 col-md-6 col-xl-6 col-xxl-6 d-flex order-2 order-md-1">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h3>Detail Transaksi</h3>
              </div>
              <div class="col d-flex justify-content-end">

              </div>
            </div>
            <h4>No Transaksi : <?= $detail_servis['no_transaksi']
                                ?></h4>
            <h5>Tanggal Transaksi : <?= $detail_servis['created_at']
                                    ?></h5>
            <h6>Status : <?= ucwords($detail_servis['status']) . ' ( ' . $detail_servis['updated_at'] . ' ) '
                          ?> </h6>
            <h6>Teknisi : <?= $detail_servis['nama']
                          ?></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <h5>Nama Pelanggan</h5>
                  <p><?= $detail_servis['nama_pelanggan']
                      ?></p>
                </div>
              </div>

              <div class="col">
                <div class="mb-3">
                  <h5>No Telp Pelanggan</h5>
                  <p>**** **** <?= substr($detail_servis['no_telp_pelanggan'], -4) ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-6 col-xl-6 col-xxl-6 d-flex order-1 order-md-1">
        <div class="card flex-fill">
          <div class="card-header">
            <?php $total = 0 ?>
          </div>
          <div class="card-body">
            <ol>
              <?php foreach ($barang_servis as $b) :
              ?>
                <h4>
                  <li><?= $b['nama_barang_servis'] . ' - ' . $b['kerusakan']
                      ?></li>
                </h4>
                <?php if (!empty($b['servis'])) :
                ?>
                  <table class="table table-hover my-0 mb-3" id="dataServiss">
                    <thead>
                      <tr>
                        <th class="col-8">Jasa Servis</th>
                        <th class="col-4">Biaya Servis</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($b['servis'] as $bservis) :
                      ?>
                        <?php $total += $bservis['biaya_servis']
                        ?>
                        <tr>
                          <td><?= $bservis['nama_jasa'] . ' - ' . $bservis['kategori']
                              ?></td>
                          <td>Rp. <?= number_format($bservis['biaya_servis'])
                                  ?></td>
                        </tr>
                      <?php endforeach
                      ?>
                    </tbody>
                  </table>
                <?php else :
                ?>
                  <p class="text-danger">Tidak Ada Perbaikan</p>
                <?php endif
                ?>
              <?php endforeach
              ?>
            </ol>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h3>Total Biaya</h3>
                    </div>
                    <div class="col-4">
                      <h3>Rp. <?= number_format($total) ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
<?php endif ?>

<?= $this->endSection() ?>