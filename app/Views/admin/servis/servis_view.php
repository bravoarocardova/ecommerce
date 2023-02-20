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
          <h3>Detail Data Servis</h3>
          <h4><?= $detail_servis['no_transaksi'] ?></h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $detail_servis['nama_pelanggan'] ?>" placeholder="" required disabled>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" cols="1" rows="1" class="form-control" required disabled><?= $detail_servis['alamat_pelanggan'] ?></textarea>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="no_telp_pelanggan" class="form-label">No Telpon Pelanggan</label>
                <input type="tel" maxlength="15" class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan" value="<?= $detail_servis['no_telp_pelanggan'] ?>" placeholder="" required disabled>
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
          <?php if (!$barang_servis) : ?>
            <a href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang' ?>" class="btn btn-primary">
              <i class="align-middle" data-feather="arrow-up-right"></i>
              Tambahkan Barang
            </a>
          <?php endif ?>
        </div>
        <div class="card-body">
          <ol>
            <?php foreach ($barang_servis as $b) : ?>
              <h3>
                <li><?= $b['nama_barang_servis'] . ' - ' . $b['kerusakan'] ?></li>
              </h3>
              <table class="table table-hover my-0" id="dataServiss">
                <thead>
                  <tr>
                    <th>Jasa Servis</th>
                    <th>Biaya Servis</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($b['servis'] as $bservis) : ?>
                    <tr>
                      <td><?= $bservis['nama_jasa'] . ' - ' . $bservis['kategori'] ?></td>
                      <td>Rp. <?= number_format($bservis['biaya_jasa']) ?></td>
                      <td>
                        <form action="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/' . $bservis['kd_barang_servis'] . '/' . $bservis['id_jasa_servis'] ?>" method="POST" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <button class="mb-5 btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInsertServis" data-kd_barang_servis="<?= $b['kd_barang_servis'] ?>" onclick="kd(this)">Tambah Servis</button>
            <?php endforeach ?>
          </ol>


        </div>
      </div>
    </div>

  </div>

</div>

<!-- Modal insert-->
<div class="modal fade" id="modalInsertServis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Servis</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <?= csrf_field() ?>
          <input type="hidden" name="kd_barang_servis" id="kd_barang_servis">
          <div class="mb-3">
            <label for="id_servis" class="form-label">Pilih Servis</label>
            <select name="id_servis" id="id_servis" class="form-control <?= validation_show_error('id_servis') ? 'is-invalid' : '' ?>">
              <option value="">-----</option>
              <?php foreach ($jasa_servis as $j) : ?>
                <option value="<?= $j['id_jasa_servis'] ?>" <?php if (old('id_servis', '') == $j['id_jasa_servis']) echo 'selected' ?> data-biaya_servis="<?= $j['biaya_jasa'] ?>"><?= $j['nama_jasa'] ?></option>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= validation_show_error('id_servis') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="biaya_servis" class="form-label">Biaya Servis</label>
            <input type="text" class="form-control <?= validation_show_error('biaya_servis') ? 'is-invalid' : '' ?>" name="biaya_servis" id="biaya_servis" value="<?= old('biaya_servis', '') ?>" placeholder="" readonly>
            <div class="invalid-feedback">
              <?= validation_show_error('biaya_servis') ?>
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
  const servis = document.getElementById('id_servis');
  servis.addEventListener('change', function() {
    document.getElementById('biaya_servis').value = this.options[this.selectedIndex].dataset.biaya_servis
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