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
          <h3>Data Pengguna</h3>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah Pengguna
          </button>
        </div>
        <div class="card-body">
          <nav class="mb-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active text-info" id="nav-admininstrator-tab" data-bs-toggle="tab" data-bs-target="#nav-admininstrator" type="button" role="tab" aria-controls="nav-admininstrator" aria-selected="true">Administrator</button>
              <button class="nav-link text-warning" id="nav-kasir-tab" data-bs-toggle="tab" data-bs-target="#nav-kasir" type="button" role="tab" aria-controls="nav-kasir" aria-selected="false">Kasir </button>
              <button class="nav-link text-success" id="nav-teknisi-tab" data-bs-toggle="tab" data-bs-target="#nav-teknisi" type="button" role="tab" aria-controls="nav-teknisi" aria-selected="false">Teknisi</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-admininstrator" role="tabpanel" aria-labelledby="nav-admininstrator-tab">
              <table class="table table-hover my-0" id="dataAdministrator">
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pengguna_admin as $r) : ?>
                    <?php
                    if (!in_array($r['role'], ['admin'])) {
                      continue;
                    }
                    ?>
                    <tr>
                      <td>
                        <img src="<?= base_url() . '/img/avatars/' . $r['foto'] ?>" alt="" class="avatar img-fluid rounded">
                      </td>
                      <td><?= $r['username'] ?></td>
                      <td><?= $r['nama'] ?></td>
                      <td><?= $r['email'] ?></td>
                      <td><?= $r['no_telp'] ?></td>
                      <td>
                        <a href="<?= base_url() . '/admin/pengguna/status/' . $r['id_admin'] ?>">
                          <?php if ($r['is_active']) : ?>
                            <span class="badge bg-success">Aktif</span>
                          <?php else : ?>
                            <span class="badge bg-danger">Tidak Aktif</span>
                          <?php endif ?>
                        </a>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a class="btn btn-info" href="<?= base_url() . '/admin/pengguna/' . $r['id_admin']  ?>">
                              <i class="align-middle" data-feather="eye"></i> Lihat
                            </a>
                          </div>
                          <div class="col">
                            <form action="<?= base_url() . '/admin/pengguna/' . $r['id_admin'] ?>" method="POST" class="d-inline">
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
            <div class="tab-pane fade" id="nav-kasir" role="tabpanel" aria-labelledby="nav-kasir-tab">
              ....
            </div>
            <div class="tab-pane fade" id="nav-teknisi" role="tabpanel" aria-labelledby="nav-teknisi-tab">
              ....
            </div>
            <div class="tab-pane fade" id="nav-data_dibatalkan" role="tabpanel" aria-labelledby="nav-data_dibatalkan-tab">
              ....
            </div>
          </div>

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
            <label for="id_admin" class="form-label">No Transaksi</label>
            <input type="text" class="form-control <?= validation_show_error('id_admin') ? 'is-invalid' : '' ?>" id="id_admin" name="id_admin" value="1" placeholder="" required readonly>
            <div class="invalid-feedback">
              <?= validation_show_error('id_admin') ?>
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
    $('#dataAdmininstrator').DataTable();
    $('#dataServis2').DataTable();
    $('#dataServis3').DataTable();
  });
</script>

<?= $this->endSection() ?>