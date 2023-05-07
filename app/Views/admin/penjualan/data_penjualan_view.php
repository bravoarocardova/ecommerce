<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>


  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <h3>Data Penjualan</h3>
          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah Penjualan
          </button> -->
        </div>
        <div class="card-body">
          <nav class="mb-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active text-info" id="nav-data_masuk-tab" data-bs-toggle="tab" data-bs-target="#nav-dikemas" type="button" role="tab" aria-controls="nav-dikemas" aria-selected="true">Dikemas <span class="badge bg-danger"><?= count($dikemas) ?></span></button>
              <button class="nav-link text-warning" id="nav-data_proses-tab" data-bs-toggle="tab" data-bs-target="#nav-dikirim" type="button" role="tab" aria-controls="nav-dikirim" aria-selected="false">Dikirim <span class="badge bg-danger"><?= count($dikirim) ?></span></button>
              <button class="nav-link text-success" id="nav-data_selesai-tab" data-bs-toggle="tab" data-bs-target="#nav-selesai" type="button" role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai</button>
              <button class="nav-link text-danger" id="nav-data_dibatalkan-tab" data-bs-toggle="tab" data-bs-target="#nav-data_dibatalkan" type="button" role="tab" aria-controls="nav-data_dibatalkan" aria-selected="false">Dibatalkan</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-dikemas" role="tabpanel" aria-labelledby="nav-dikemas-tab">
              <table class="table table-hover my-0" id="dataPenjualan">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal dibuat</th>
                    <th>Tujuan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dikemas as $d) : ?>
                    <tr>
                      <td><?= $d['id_pembelian'] ?></td>
                      <td><?= ucwords($d['nama_pelanggan']) ?></td>
                      <td><?= $d['created_at'] ?></td>
                      <td style="width:20%"><?= $d['tujuan'] ?></td>
                      <td>Rp. <?= number_format($d['ongkir'] + $d['total_pembelian']) ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/admin/penjualan/' . $d['id_pembelian'] ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <!-- <div class="col">
                            <form action="<? //= base_url() . '/admin/servis/' . $d['no_transaksi'] 
                                          ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          </div> -->
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="nav-dikirim" role="tabpanel" aria-labelledby="nav-dikirim-tab">
              <table class="table table-hover my-0" id="dataPenjualan2">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal dibuat</th>
                    <th>Tujuan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dikirim as $d) : ?>
                    <tr>
                      <td><?= $d['id_pembelian'] ?></td>
                      <td><?= ucwords($d['nama_pelanggan']) ?></td>
                      <td><?= $d['created_at'] ?></td>
                      <td style="width:20%"><?= $d['tujuan'] ?></td>
                      <td>Rp. <?= number_format($d['ongkir'] + $d['total_pembelian']) ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/admin/penjualan/' . $d['id_pembelian'] ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <!-- <div class="col">
                            <form action="<? //= base_url() . '/admin/servis/' . $d['no_transaksi'] 
                                          ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          </div> -->
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
              <table class="table table-hover my-0" id="dataPenjualan3">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal dibuat</th>
                    <th>Tujuan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($selesai as $d) : ?>
                    <tr>
                      <td><?= $d['id_pembelian'] ?></td>
                      <td><?= ucwords($d['nama_pelanggan']) ?></td>
                      <td><?= $d['created_at'] ?></td>
                      <td style="width:20%"><?= $d['tujuan'] ?></td>
                      <td>Rp. <?= number_format($d['ongkir'] + $d['total_pembelian']) ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/admin/penjualan/' . $d['id_pembelian'] ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <!-- <div class="col">
                            <form action="<? //= base_url() . '/admin/servis/' . $d['no_transaksi'] 
                                          ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          </div> -->
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="nav-data_dibatalkan" role="tabpanel" aria-labelledby="nav-data_dibatalkan-tab">

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('#dataPenjualan').DataTable();
    $('#dataPenjualan2').DataTable();
    $('#dataPenjualan3').DataTable();
    $('#dataPenjualan4').DataTable();
  });
</script>
<?= $this->endSection() ?>