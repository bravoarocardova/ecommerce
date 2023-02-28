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
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab" aria-selected="false" tabindex="-1">
            Password
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab" aria-selected="false" tabindex="-1">
            Delete account
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
              <form>
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label class="form-label" for="inputUsername">Username</label>
                      <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?= $profile_admin['username'] ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputNama">Nama</label>
                      <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama" value="<?= $profile_admin['nama'] ?>">
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputEmail">Email</label>
                      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= $profile_admin['email'] ?>">
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputNoTelp">No Telp</label>
                      <input type="text" class="form-control" id="inputNoTelp" name="no_telp" placeholder="No Telp" value="<?= $profile_admin['no_telp'] ?>">
                    </div>
                    <div class=" row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputRole">Role</label>
                          <select name="role" id="inputRole" class="form-control">
                            <option value="admin" <?php if ($profile_admin['role'] == 'admin') echo 'selected' ?>>Administrator</option>
                            <option value="kasir " <?php if ($profile_admin['role'] == 'kasir') echo 'selected' ?>>Kasir</option>
                            <option value="teknisi" <?php if ($profile_admin['role'] == 'teknisi') echo 'selected' ?>>Teknisi</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputStatus">Status</label>
                          <select name="status" id="inputStatus" class="form-control">
                            <option value="1" <?php if ($profile_admin['is_active'] == '1') echo 'selected' ?>>Aktif</option>
                            <option value="0 " <?php if ($profile_admin['is_active'] == '0') echo 'selected' ?>>Tidak Aktif</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="text-center mb-3">
                      <img alt="" src="<?= base_url() . '/img/avatars/' . $profile_admin['foto'] ?>" class="rounded img-responsive mt-2" width="128" height="128">
                      <div class="mt-2">
                        <label for="foto">
                          <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                        </label>
                        <input type="file" name="foto" id="foto" class="d-none">
                      </div>
                      <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputCreated">Created</label>
                      <input type="text" class="form-control" id="inputCreated" readonly disabled value="<?= $profile_admin['created_at'] ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputUpdated">Updated</label>
                      <input type="text" class="form-control" id="inputUpdated" readonly disabled value="<?= $profile_admin['updated_at'] ?>">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>

            </div>
          </div>

        </div>
        <div class="tab-pane fade" id="password" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Password</h5>

              <form>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordCurrent">Current password</label>
                  <input type="password" class="form-control" id="inputPasswordCurrent">
                  <small><a href="#">Forgot your password?</a></small>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordNew">New password</label>
                  <input type="password" class="form-control" id="inputPasswordNew">
                </div>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordNew2">Verify password</label>
                  <input type="password" class="form-control" id="inputPasswordNew2">
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