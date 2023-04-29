<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>

  <div class="row">
    <div class="col-md-3 col-xl-2">

      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Menu</h5>
        </div>

        <div class="list-group list-group-flush" role="tablist">
          <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#belum_bayar" role="tab" aria-selected="true">
            Belum Bayar
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#dikemas" role="tab" aria-selected="false" tabindex="-1">
            Dikemas
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#dikirim" role="tab" aria-selected="false" tabindex="-2">
            Dikirim
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#selesai" role="tab" aria-selected="false" tabindex="-3">
            Selesai
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#dibatalkan" role="tab" aria-selected="false" tabindex="-4">
            Dibatalkan
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-9 col-xl-10">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="belum_bayar" role="tabpanel">

          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Pesanan</h5>
            </div>
            <div class="card-body">
              <table class="table table-hover my-0 " id="dataPembelian">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal dibuat</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($belum_bayar as $d) :
                  ?>
                    <tr>
                      <td><?= $d['id_pembelian'] ?></td>
                      <td><?= ucwords($d['nama_pelanggan']) ?></td>
                      <td><?= $d['created_at'] ?></td>
                      <td><?= ($d['status_pembelian'] == 'Belum Bayar') ? "<span class='text-danger'>Bayar Sebelum (<span class='text-success'>" . date("Y-m-d H:i:s", strtotime($d['created_at']) + 60 * 60) . "</span>)</span>" : $d['status_pembelian'] ?></td>
                      <td>Rp. <?= number_format($d['ongkir'] + $d['total_pembelian']) ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/pembelian/' . $d['id_pembelian'] ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <div class="col">
                            <form action="<? //= base_url() . '/admin/servis/' . $d['no_transaksi'] 
                                          ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>

        <div class="tab-pane fade" id="dikemas" role="tabpanel">
          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Pesanan</h5>
            </div>
            <div class="card-body">


            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="dikirim" role="tabpanel">
          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Pesanan</h5>
            </div>
            <div class="card-body">


            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="selesai" role="tabpanel">
          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Pesanan</h5>
            </div>
            <div class="card-body">


            </div>
          </div>
        </div>

        <div class="tab-pane fade show" id="dibatalkan" role="tabpanel">

          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Pesanan</h5>
            </div>
            <div class="card-body">
              <table class="table table-hover my-0 " id="dataPembelian">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal dibuat</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dibatalkan as $d) :
                  ?>
                    <tr>
                      <td><?= $d['id_pembelian'] ?></td>
                      <td><?= ucwords($d['nama_pelanggan']) ?></td>
                      <td><?= $d['created_at'] ?></td>
                      <td><?= $d['status_pembelian'] ?></td>
                      <td>Rp. <?= number_format($d['ongkir'] + $d['total_pembelian']) ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/pembelian/' . $d['id_pembelian'] ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <div class="col">
                            <form action="<? //= base_url() . '/admin/servis/' . $d['no_transaksi'] 
                                          ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

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
    $('#dataPembelian').DataTable();
    $('#dataPembelian2').DataTable();
    $('#dataPembelian3').DataTable();
    $('#dataPembelian4').DataTable();
  });
</script>
<?= $this->endSection() ?>