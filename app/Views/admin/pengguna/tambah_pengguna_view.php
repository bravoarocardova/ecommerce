<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>

  <div class="row">
    <div class="col-md-3 col-xl-2">

      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Profile Settings</h5>
        </div>

        <div class="list-group list-group-flush" role="tablist">
          <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
            Account
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-9 col-xl-10">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="account" role="tabpanel">

          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Public info</h5>
            </div>
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label class="form-label" for="inputUsername">Username</label>
                      <input type="text" class="form-control <?= validation_show_error('username') ? 'is-invalid' : '' ?>" id="inputUsername" name="username" placeholder="Username" value="<?= old('username') ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('username') ?>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputNama">Nama</label>
                      <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" id="inputNama" name="nama" placeholder="Nama" value="<?= old('nama') ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('nama') ?>
                      </div>
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputEmail">Email</label>
                      <input type="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" id="inputEmail" name="email" placeholder="Email" value="<?= old('email') ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('email') ?>
                      </div>
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputNoTelp">No Telp</label>
                      <input type="text" class="form-control <?= validation_show_error('no_telp') ? 'is-invalid' : '' ?>" id="inputNoTelp" name="no_telp" placeholder="No Telp" value="<?= old('no_telp') ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('no_telp') ?>
                      </div>
                    </div>
                    <div class=" row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputRole">Role</label>
                          <select name="role" id="inputRole" class="form-control <?= validation_show_error('role') ? 'is-invalid' : '' ?>">
                            <option value=""></option>
                            <option value="admin" <?php if (old('role') == 'admin') echo 'selected' ?>>Administrator</option>
                            <option value="kasir" <?php if (old('role') == 'kasir') echo 'selected' ?>>Kasir</option>
                            <option value="teknisi" <?php if (old('role') == 'teknisi') echo 'selected' ?>>Teknisi</option>
                          </select>
                          <div class="invalid-feedback">
                            <?= validation_show_error('role') ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputStatus">Status</label>
                          <select name="status" id="inputStatus" class="form-control <?= validation_show_error('status') ? 'is-invalid' : '' ?>">
                            <option value="1" <?php if (old('is_active') == '1') echo 'selected' ?>>Aktif</option>
                            <option value="0" <?php if (old('is_active') == '0') echo 'selected' ?>>Tidak Aktif</option>
                          </select>
                          <div class="invalid-feedback">
                            <?= validation_show_error('status') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputPasswordNew">New password</label>
                          <input type="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : '' ?>" name="password" id="inputPasswordNew">
                          <div class="invalid-feedback">
                            <?= validation_show_error('password') ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputPasswordNew2">Verify password</label>
                          <input type="password" class="form-control <?= validation_show_error('password_verify') ? 'is-invalid' : '' ?>" name="password_verify" id="inputPasswordNew2">
                          <div class="invalid-feedback">
                            <?= validation_show_error('password_verify') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center mb-3">
                      <img alt="" src="" class="rounded img-responsive mt-2" width="128" height="128" id="img-profile-upload">
                      <div class="mt-2">
                        <label for="foto">
                          <span class="btn btn-primary"><i class="fas fa-upload"></i> Pilih Foto</span>
                        </label>
                        <input type="file" name="foto" id="foto" class="d-none <?= validation_show_error('foto') ? 'is-invalid' : '' ?>" onchange="document.getElementById('img-profile-upload').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback">
                          <?= validation_show_error('foto') ?>
                        </div>
                      </div>
                      <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>