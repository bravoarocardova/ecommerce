<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">
  <?php if (session()->has('msg')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('msg') ?>
    </div>
    <h1 class="h3 mb-3"><strong>Jasa</strong> Servis</h1>
  <?php endif ?>

  <div class="row">
    <div class="col-12 col-md-8 col-xl-8 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="align-middle" data-feather="plus-square"></i>
            Tambah Jasa Servis
          </button>

        </div>
        <div class="card-body">
          <table class="table table-hover my-0">
            <thead>
              <tr>
                <th>Jasa Servis</th>
                <th>Kategori</th>
                <th>Biaya</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($jasa_servis as $j) : ?>
                <tr>
                  <td><?= $j['nama_jasa'] ?></td>
                  <td><?= $j['kategori'] ?></td>
                  <td><?= $j['biaya_jasa'] ?></td>
                  <td>Edit|Hapus</td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4 col-xl-4 d-flex order-1 order-md-2">
      <div class="card flex-fill">
        <div class="card-header">
          <h3>Tambah Jasa Servis</h3>

        </div>
        <div class="card-body">

          <form action="" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="nama_jasa" class="form-label">Nama Jasa Servis</label>
              <input type="text" class="form-control <?= validation_show_error('nama_jasa') ? 'is-invalid' : '' ?>" id="nama_jasa" name="nama_jasa" value="<?= old('nama_jasa', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('nama_jasa') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select  <?= validation_show_error('kategori') ? 'is-invalid' : '' ?>" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Laptop" <?php if (old('kategori', '') == 'Laptop') echo 'selected' ?>>Laptop</option>
                <option value="Komputer" <?php if (old('kategori', '') == 'Komputer') echo 'selected' ?>>Komputer</option>
              </select>
              <div class="invalid-feedback">
                <?= validation_show_error('kategori') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="biaya_jasa" class="form-label">Biaya</label>
              <input type="number" class="form-control <?= validation_show_error('biaya_jasa') ? 'is-invalid' : '' ?>" id="biaya_jasa" name="biaya_jasa" value="<?= old('biaya_jasa', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('biaya_jasa') ?>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>