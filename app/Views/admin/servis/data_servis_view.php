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
          <h3>Data Servis</h3>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah Servis
          </button>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataServis">
            <thead>
              <tr>
                <th>No Transaksi</th>
                <th>Status</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_servis as $d) : ?>
                <tr>
                  <td><?= $d['no_transaksi'] ?></td>
                  <td><?= ucwords($d['status']) ?></td>
                  <td><?= $d['nama_pelanggan'] ?></td>
                  <td><?= $d['created_at'] ?></td>
                  <td>
                    <button class="btn btn-info">
                      <i class="align-middle" data-feather="eye"></i> Lihat
                    </button>
                    |
                    <form action="<?= base_url() . '/admin/servis/' . $d['no_transaksi'] ?>" method="POST" class="d-inline">
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Servis Baru</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="form-input">
        <div class="modal-body">
          <?= csrf_field() ?>
          <!-- <div class="mb-3">
            <label for="no_transaksi" class="form-label">No Transaksi</label>
            <input type="text" class="form-control <?= validation_show_error('no_transaksi') ? 'is-invalid' : '' ?>" id="no_transaksi" name="no_transaksi" value="1" placeholder="" required readonly>
            <div class="invalid-feedback">
              <?= validation_show_error('no_transaksi') ?>
            </div>
          </div> -->
          <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control <?= validation_show_error('nama_pelanggan') ? 'is-invalid' : '' ?>" id="nama_pelanggan" name="nama_pelanggan" value="<?= old('nama_pelanggan', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('nama_pelanggan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
            <textarea name="alamat_pelanggan" id="alamat_pelanggan" cols="1" rows="2" class="form-control <?= validation_show_error('alamat_pelanggan') ? 'is-invalid' : '' ?>" required><?= old('alamat_pelanggan', '') ?></textarea>
            <div class="invalid-feedback">
              <?= validation_show_error('alamat_pelanggan') ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="no_telp_pelanggan" class="form-label">No Telpon Pelanggan</label>
            <div class="input-group">
              <span class="input-group-text">+62</span>
              <input type="tel" maxlength="15" class="form-control <?= validation_show_error('no_telp_pelanggan') ? 'is-invalid' : '' ?>" id="no_telp_pelanggan" name="no_telp_pelanggan" value="<?= old('no_telp_pelanggan', '') ?>" placeholder="" required>
              <div class="invalid-feedback">
                <?= validation_show_error('no_telp_pelanggan') ?>
              </div>
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
  $(document).ready(function() {
    $('#dataServis').DataTable();
  });
</script>

<?= $this->endSection() ?>