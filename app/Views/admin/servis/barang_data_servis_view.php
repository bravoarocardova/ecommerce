<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0" id="printArea">

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
          <div class="row">
            <div class="col">
              <h3>Detail Data Barang</h3>
            </div>
            <div class="col d-flex justify-content-end">
              <?php if ($barang_servis) : ?>
                <button class=" btn btn-info d-print-none" onclick="printDiv('printArea')">
                  <i class="align-middle" data-feather="printer"></i>
                  Cetak
                </button>
              <?php endif ?>
            </div>
          </div>
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
            <button type="button" class="btn btn-primary d-print-none" data-bs-toggle="modal" data-bs-target="#modalInsertBarangServis">
              <i class="align-middle" data-feather="plus-circle"></i> Tambah Barang
            </button>
            <?php if ($barang_servis) : ?>
              <a href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] ?>" class="btn btn-success d-print-none">
                <i class="align-middle" data-feather="settings"></i>
                Lanjut Servis
              </a>
            <?php endif ?>
          <?php endif ?>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataServis">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Kerusakan</th>
                <th>Kelengkapan</th>
                <th class="d-print-none"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($barang_servis as $b) : ?>
                <tr>
                  <td><?= $b['nama_barang_servis'] ?></td>
                  <td><?= $b['kerusakan'] ?></td>
                  <td><?= $b['kelengkapan'] ?></td>
                  <td class="d-print-none">
                    <?php if (is_null($detail_servis['status']) || $detail_servis['status'] == 'menunggu konfirmasi') : ?>
                      <button class="btn btn-warning" onclick="buttonEditClick(this)" data-bs-toggle="modal" data-bs-target="#modalUpdateBarangServis" data-kd_barang_servis="<?= $b['kd_barang_servis'] ?>" data-nama_barang_servis="<?= $b['nama_barang_servis'] ?>" data-kerusakan="<?= $b['kerusakan'] ?>" data-kelengkapan="<?= $b['kelengkapan'] ?>">
                        <i class="align-middle" data-feather="edit-3"></i> Edit
                      </button>
                      |
                      <form action="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang/' . $b['kd_barang_servis'] ?>" method="POST" class="d-inline">
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

    const form = document.getElementById('form-input');

  }

  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>

<script>
  $(document).ready(function() {
    $('#dataServis').DataTable();
  });
</script>


<?= $this->endSection() ?>