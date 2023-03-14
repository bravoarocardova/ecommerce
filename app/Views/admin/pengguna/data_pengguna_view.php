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
          <a href="<?= base_url() . '/admin/pengguna/tambah' ?>" class="btn btn-primary">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah Pengguna
          </a>
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
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pengguna_admin as $r) : ?>
                    <?php
                    if (!in_array($r['role'], ['admin'])) {
                      continue;
                    }
                    if ($r['id_admin'] == session()->get('admin')['id_admin']) {
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
                        <a class="btn btn-info" href="<?= base_url() . '/admin/pengguna/' . $r['id_admin']  ?>">
                          <i class="align-middle" data-feather="eye"></i> Lihat
                        </a>
                      </td>
                      <td>
                        <form action="<?= base_url() . '/admin/pengguna/' . $r['id_admin'] ?>" method="POST" class="d-inline">
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
            <div class="tab-pane fade" id="nav-kasir" role="tabpanel" aria-labelledby="nav-kasir-tab">
              <table class="table table-hover my-0" id="dataKasir">
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pengguna_admin as $r) : ?>
                    <?php
                    if (!in_array($r['role'], ['kasir'])) {
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
                        <a class="btn btn-info" href="<?= base_url() . '/admin/pengguna/' . $r['id_admin']  ?>">
                          <i class="align-middle" data-feather="eye"></i> Lihat
                        </a>
                      </td>
                      <td>
                        <form action="<?= base_url() . '/admin/pengguna/' . $r['id_admin'] ?>" method="POST" class="d-inline">
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
            <div class="tab-pane fade" id="nav-teknisi" role="tabpanel" aria-labelledby="nav-teknisi-tab">
              <table class="table table-hover my-0" id="dataTeknisi">
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pengguna_admin as $r) : ?>
                    <?php
                    if (!in_array($r['role'], ['teknisi'])) {
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
                        <a class="btn btn-info" href="<?= base_url() . '/admin/pengguna/' . $r['id_admin']  ?>">
                          <i class="align-middle" data-feather="eye"></i> Lihat
                        </a>
                      </td>
                      <td>
                        <form action="<?= base_url() . '/admin/pengguna/' . $r['id_admin'] ?>" method="POST" class="d-inline">
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

  </div>

</div>

<script>
  $(document).ready(function() {
    $('#dataAdministrator').DataTable();
    $('#dataKasir').DataTable();
    $('#dataTeknisi').DataTable();
  });
</script>

<?= $this->endSection() ?>