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
          <div class="row">
            <div class="col">
              <h3>Barang Masuk</h3>

              <a href="<?= base_url() . '/admin/barang_masuk/tambah' ?>" class="btn btn-primary">
                <i class="align-middle" data-feather="plus-circle"></i>
                Tambah Barang Masuk
              </a>

            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataProduk">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pemasok</th>
                <th>Harga Beli</th>
                <th>Jumlah Beli</th>
                <th>Produk</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data_pemasok as $r) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r['nama_pemasok'] ?></td>
                  <td>Rp. <?= number_format($r['harga_beli']) ?></td>
                  <td><?= number_format($r['jumlah_beli']) ?></td>
                  <td>
                    <?= $r['nama_produk'] ?>
                  </td>
                  <td>Rp. <?= number_format($r['total']) ?></td>
                  <td class="d-print-none">
                    <a href="<?= base_url() . '/admin/barang_masuk/' . $r['id_pemasok'] ?>" class="btn btn-info" title="Lihat">
                      <i class="align-middle" data-feather="eye"></i>
                      <!-- Edit -->
                    </a>
                    |
                    <form action="<?= base_url() . '/admin/barang_masuk/' . $r['id_pemasok'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Apakah anda yakin?')">
                        <i class="align-middle" data-feather="trash-2"></i>
                        <!-- Delete -->
                      </button>
                    </form>
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

<script>
  $(document).ready(function() {
    $('#dataProduk').DataTable();
  });
</script>
<?= $this->endSection() ?>