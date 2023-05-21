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
              <h3>Profil Aplikasi</h3>

            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id_setting" value="<?= $setting['id_setting'] ?>">
            <div class="row">
              <div class="col-md-8">

                <div class="mb-3">
                  <label class="form-label" for="nama_aplikasi">Nama Aplikasi</label>
                  <input type="text" class="form-control <?= validation_show_error('nama_aplikasi') ? 'is-invalid' : '' ?>" id="nama_aplikasi" name="nama_aplikasi" placeholder="Nama Aplikasi" value="<?= old('nama_aplikasi', $setting['nama_aplikasi'] ?? '') ?>">
                  <div class="invalid-feedback">
                    <?= validation_show_error('nama_aplikasi') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="alamat">Alamat</label>
                  <textarea name="alamat" id="alamat" cols="30" rows="2" placeholder="Alamat" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : '' ?>"><?= old('alamat', $setting['alamat'] ?? '') ?></textarea>
                  <div class="invalid-feedback">
                    <?= validation_show_error('alamat') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="telepon">Telepon</label>
                  <input type="text" class="form-control <?= validation_show_error('telepon') ? 'is-invalid' : '' ?>" id="telepon" name="telepon" placeholder="Telepon" value="<?= old('telepon', $setting['telepon'] ?? '') ?>">
                  <div class="invalid-feedback">
                    <?= validation_show_error('telepon') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Email" value="<?= old('email', $setting['email'] ?? '') ?>">
                  <div class="invalid-feedback">
                    <?= validation_show_error('email') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="lokasi">Lokasi</label>
                  <input type="text" class="form-control <?= validation_show_error('lokasi') ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi" placeholder="Lokasi (latitude , longitude)" value="<?= old('lokasi', $setting['lokasi'] ?? '') ?>">
                  <div class="invalid-feedback">
                    <?= validation_show_error('lokasi') ?>
                  </div>
                  <small>Embed map src by google maps</small>
                </div>
              </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>