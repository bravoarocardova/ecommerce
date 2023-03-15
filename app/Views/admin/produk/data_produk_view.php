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
              <h3>Data Produk</h3>

              <a href="<?= base_url() . '/admin/produk/tambah' ?>" class="btn btn-primary">
                <i class="align-middle" data-feather="plus-circle"></i>
                Tambah Produk
              </a>

            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataProduk">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto Produk</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Kondisi</th>
                <th>Stok</th>
                <th>Berat (g)</th>
                <th>Deskripsi</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data_produk as $r) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <img src="<?= base_url() . '/img/produk/' . $r['foto_produk'] ?>" class="avatar img-fluid rounded me-1" />
                  </td>
                  <td><?= $r['nama_produk'] ?></td>
                  <td>Rp. <?= number_format($r['harga_produk']) ?></td>
                  <td><?= $r['kondisi_produk'] ?></td>
                  <td><?= $r['stok_produk'] ?></td>
                  <td><?= $r['berat_produk'] ?></td>
                  <td class="w-25"><?= substr($r['deskripsi_produk'], 0, 50) ?>....</td>
                  <td class="d-print-none">
                    <a href="<?= base_url() . '/admin/produk/' . $r['id_produk'] ?>" class="btn btn-warning" title="Edit">
                      <i class="align-middle" data-feather="edit-3"></i>
                      <!-- Edit -->
                    </a>
                    |
                    <form action="<?= base_url() . '/admin/produk/' . $r['id_produk'] ?>" method="POST" class="d-inline">
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