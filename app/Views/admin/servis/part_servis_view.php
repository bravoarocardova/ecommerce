<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <div class="d-print-none">
    <?php if (session()->has('msg')) : ?>
      <?= session()->getFlashdata('msg') ?>
    <?php endif ?>
  </div>

  <div class="card d-print-none">
    <div class="card-body">
      <a class="btn btn-danger" href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/detail' ?>">
        <i class="align-middle" data-feather="arrow-left"></i> Kembali ke Detail
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <h3>Detail Part Servis</h3>
          <h4>No Transaksi : <?= $detail_servis['no_transaksi'] ?></h4>
          <h5>Tanggal Transaksi : <?= $detail_servis['created_at'] ?></h5>
          <h6>Status : <?= ucwords($detail_servis['status']) . ' ( ' . $detail_servis['updated_at'] . ' ) ' ?> </h6>
          <h6>Estimasi Servis : <?= $detail_servis['estimasi_servis'] ?></h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <h5>Nama Pelanggan</h5>
                <p><?= $detail_servis['nama_pelanggan'] ?></p>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <h5>Alamat Pelanggan</h5>
                <p><?= $detail_servis['alamat_pelanggan'] ?></p>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <h5>Nama Pelanggan</h5>
                <p><?= $detail_servis['no_telp_pelanggan'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <?php if (is_null($detail_servis['status']) || $detail_servis['status'] == 'menunggu konfirmasi') : ?>
            <?php if (!$barang_servis) : ?>
              <a href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang' ?>" class="btn btn-primary">
                <i class="align-middle" data-feather="arrow-up-right"></i>
                Tambahkan Barang
              </a>
            <?php endif ?>
          <?php endif ?>
        </div>
        <div class="card-body">
          <ol>
            <?php foreach ($barang_servis as $b) : ?>
              <h4>
                <li><?= $b['nama_barang_servis'] . ' - ' . $b['kerusakan'] ?></li>
              </h4>
              <?php if (!empty($b['servis'])) : ?>

                <table class="table table-hover my-0 mb-3" id="dataServiss">
                  <thead>
                    <tr>
                      <th class="col-6">Jasa Servis</th>
                      <th class="col-3">Biaya Servis</th>
                      <th class="col-3"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($b['servis'] as $bservis) : ?>
                      <tr>
                        <td><?= $bservis['nama_jasa'] . ' - ' . $bservis['kategori'] ?></td>
                        <td>Rp. <?= number_format($bservis['biaya_servis']) ?></td>
                        <td>

                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else : ?>
                <p class="text-danger">Tidak Ada Perbaikan</p>
              <?php endif ?>

              <?php if (!empty($b['part'])) : ?>

                <table class="table table-hover my-0 mb-3" id="dataServiss">
                  <thead>
                    <tr>
                      <th class="col-6">Part Produk</th>
                      <th class="col-3">Biaya Part</th>
                      <th class="col-3"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($b['part'] as $pservis) : ?>
                      <tr>
                        <td><?= $pservis['nama_part'] . ' - ' . $pservis['kategori'] ?></td>
                        <td>Rp. <?= number_format($pservis['biaya_part_servis']) ?></td>
                        <td>
                          <?php if (is_null($detail_servis['status']) || $detail_servis['status'] == 'menunggu konfirmasi') : ?>

                            <form action="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/' . $pservis['kd_barang_servis'] . '/' . $pservis['id_part_produk'] . '/part' ?>" method="POST" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                            </form>
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else : ?>
                <p class="text-danger">Tidak Ada Part Tambahan</p>
              <?php endif ?>

              <?php if (is_null($detail_servis['status']) || $detail_servis['status'] == 'menunggu konfirmasi') : ?>
                <button class="mb-5 btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInsertPartServis" data-kd_barang_servis="<?= $b['kd_barang_servis'] ?>" onclick="kd(this)">Tambah Part</button>
              <?php endif ?>
            <?php endforeach ?>
          </ol>


        </div>
      </div>
    </div>

  </div>

</div>

<!-- Modal insert-->
<div class="modal fade" id="modalInsertPartServis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Part Produk</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <?= csrf_field() ?>
          <input type="hidden" name="kd_barang_servis" id="kd_barang_servis">
          <div class="mb-3">
            <label for="id_part_produk" class="form-label">Pilih Part Produk</label>
            <select name="id_part_produk" id="id_part_produk" class="form-control <?= validation_show_error('id_part_produk') ? 'is-invalid' : '' ?>">
              <option value="">-----</option>
              <?php foreach ($part_produk as $j) : ?>
                <option value="<?= $j['id_part_produk'] ?>" <?php if (old('id_part_produk', '') == $j['id_part_produk']) echo 'selected' ?> data-biaya_part="<?= $j['biaya_part'] ?>"><?= $j['nama_part'] ?></option>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= validation_show_error('id_part_produk') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="biaya_part" class="form-label">Biaya Part</label>
            <input type="text" class="form-control <?= validation_show_error('biaya_part') ? 'is-invalid' : '' ?>" name="biaya_part" id="biaya_part" value="<?= old('biaya_part', '') ?>" placeholder="" readonly>
            <div class="invalid-feedback">
              <?= validation_show_error('biaya_part') ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success"><i class="align-middle" data-feather="check"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const servis = document.getElementById('id_part_produk');
  servis.addEventListener('change', function() {
    document.getElementById('biaya_part').value = this.options[this.selectedIndex].dataset.biaya_part
  })

  function kd(e) {
    document.getElementById('kd_barang_servis').value = e.dataset.kd_barang_servis;
  }
</script>

<script>
  $(document).ready(function() {
    $('#dataServis').DataTable();
  });
</script>

<?= $this->endSection() ?>