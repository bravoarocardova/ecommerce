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
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInsertBarangServis">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah Barang
          </button>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataServis">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Kerusakan</th>
                <th>Kelengkapan</th>
                <th>Jumlah</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($barang_servis as $b) : ?>
                <tr>
                  <td><?= $b['nama_barang_servis'] ?></td>
                  <td><?= $b['kerusakan'] ?></td>
                  <td><?= $b['kelengkapan'] ?></td>
                  <td><?= $b['jumlah'] ?></td>
                  <td>
                    <button class="btn btn-warning" onclick="buttonEditClick(this)" data-bs-toggle="modal" data-bs-target="#modalUpdateBarangServis" data-kd_barang_servis="<?= $b['kd_barang_servis'] ?>" data-nama_barang_servis="<?= $b['nama_barang_servis'] ?>" data-kerusakan="<?= $b['kerusakan'] ?>" data-kelengkapan="<?= $b['kelengkapan'] ?>" data-jumlah="<?= $b['jumlah'] ?>">
                      <i class="align-middle" data-feather="edit-3"></i> Edit
                    </button>
                    |
                    <form action="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang/' . $b['kd_barang_servis'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
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

<!-- Modal insert-->
<div class="modal fade" id="modalInsertBarangServis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Barang Servis</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="nama_barang_servis" class="form-label">Nama Barang</label>
            <input type="text" class="form-control <?= validation_show_error('nama_barang_servis') ? 'is-invalid' : '' ?>" id="nama_barang_servis" name="nama_barang_servis" value="<?= old('nama_barang_servis', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('nama_barang_servis') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="kelengkapan" class="form-label">Kelengkapan</label>
            <input type="text" class="form-control <?= validation_show_error('kelengkapan') ? 'is-invalid' : '' ?>" name="kelengkapan" id="kelengkapan" value="<?= old('kelengkapan', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('kelengkapan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="kerusakan" class="form-label">Kerusakan</label>
            <input type="text" class="form-control <?= validation_show_error('kerusakan') ? 'is-invalid' : '' ?>" name="kerusakan" id="kerusakan" value="<?= old('kerusakan', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('kerusakan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control <?= validation_show_error('jumlah') ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah', '1') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('jumlah') ?>
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

<!-- Modal update-->
<div class="modal fade" id="modalUpdateBarangServis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Ubah Barang Servis</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="form-input">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="kd_barang_servis" id="kd_barang_servis_update" value="">
        <div class="modal-body">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="nama_barang_servis_update" class="form-label">Nama Barang</label>
            <input type="text" class="form-control <?= validation_show_error('nama_barang_servis') ? 'is-invalid' : '' ?>" id="nama_barang_servis_update" name="nama_barang_servis" value="<?= old('nama_barang_servis', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('nama_barang_servis') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="kelengkapan_update" class="form-label">Kelengkapan</label>
            <input type="text" class="form-control <?= validation_show_error('kelengkapan') ? 'is-invalid' : '' ?>" name="kelengkapan" id="kelengkapan_update" value="<?= old('kelengkapan', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('kelengkapan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="kerusakan_update" class="form-label">Kerusakan</label>
            <input type="text" class="form-control <?= validation_show_error('kerusakan') ? 'is-invalid' : '' ?>" name="kerusakan" id="kerusakan_update" value="<?= old('kerusakan', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('kerusakan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="jumlah_update" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control <?= validation_show_error('jumlah') ? 'is-invalid' : '' ?>" id="jumlah_update" name="jumlah" value="<?= old('jumlah', '1') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('jumlah') ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning"><i class="align-middle" data-feather="check"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function buttonEditClick(el) {

    const data = el.dataset;
    document.getElementById('kd_barang_servis_update').value = data.kd_barang_servis;
    document.getElementById('nama_barang_servis_update').value = data.nama_barang_servis;
    document.getElementById('kelengkapan_update').value = data.kelengkapan;
    document.getElementById('kerusakan_update').value = data.kerusakan;
    document.getElementById('jumlah_update').value = data.jumlah;

    const form = document.getElementById('form-input');

  }
</script>

<script>
  $(document).ready(function() {
    $('#dataServis').DataTable();
  });
</script>

<?= $this->endSection() ?>