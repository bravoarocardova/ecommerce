<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container p-4">

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
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#alamat" role="tab" aria-selected="false" tabindex="-1">
            Alamat
          </a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab" aria-selected="false" tabindex="-1">
            Password
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
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="edit" value="profil">

                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label class="form-label" for="inputUsername">Username</label>
                      <input type="text" class="form-control <?= validation_show_error('username_pelanggan') ? 'is-invalid' : '' ?>" id="inputUsername" name="username_pelanggan" placeholder="Username" value="<?= $profile['username_pelanggan'] ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('username_pelanggan') ?>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputNama">Nama</label>
                      <input type="text" class="form-control <?= validation_show_error('nama_pelanggan') ? 'is-invalid' : '' ?>" id="inputNama" name="nama_pelanggan" placeholder="Nama" value="<?= $profile['nama_pelanggan'] ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('nama_pelanggan') ?>
                      </div>
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputEmail">Email</label>
                      <input type="text" class="form-control <?= validation_show_error('email_pelanggan') ? 'is-invalid' : '' ?>" id="inputEmail" name="email_pelanggan" placeholder="Email" value="<?= $profile['email_pelanggan'] ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('email_pelanggan') ?>
                      </div>
                    </div>
                    <div class=" mb-3">
                      <label class="form-label" for="inputNoTelp">No Telp</label>
                      <input type="text" class="form-control <?= validation_show_error('telepon_pelanggan') ? 'is-invalid' : '' ?>" id="inputNoTelp" name="telepon_pelanggan" placeholder="No Telp" value="<?= $profile['telepon_pelanggan'] ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('telepon_pelanggan') ?>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="text-center mb-3">
                      <img alt="" src="<?= base_url() . '/img/avatars/' . $profile['foto_pelanggan']  ?>" class="rounded img-responsive mt-2" width="128" height="128" id="img-profile-upload">
                      <div class="mt-2">
                        <label for="foto_pelanggan">
                          <span class="btn btn-primary"><i class="fas fa-upload"></i> Pilih Foto</span>
                        </label>
                        <input type="file" name="foto_pelanggan" id="foto_pelanggan" class="d-none <?= validation_show_error('foto_pelanggan') ? 'is-invalid' : '' ?>" onchange="document.getElementById('img-profile-upload').src = window.URL.createObjectURL(this.files[0])">
                        <div class=" invalid-feedback">
                          <?= validation_show_error('foto_pelanggan') ?>
                        </div>
                      </div>
                      <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputCreated">Created</label>
                      <input type="text" class="form-control" id="inputCreated" readonly disabled value="<?= $profile['created_at'] ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputUpdated">Updated</label>
                      <input type="text" class="form-control" id="inputUpdated" readonly disabled value="<?= $profile['updated_at'] ?>">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>

            </div>
          </div>

        </div>

        <div class="tab-pane fade" id="alamat" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Alamat</h5>
              <div class="mb-3">
                <label class="form-label" for="alamat_lengkap">Alamat Sekarang</label>
                <textarea disabled class="form-control" id="alamat_lengkap" cols="30" rows="2"><?= $profile['alamat_pelanggan'] ?></textarea>

              </div>
              <hr>
              <h5>Ubah Alamat</h5>
              <form action="" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="edit" value="alamat">

                <div class="row">
                  <div class="mb-3">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <select required class="form-select  <?= validation_show_error('provinsi') ? 'is-invalid' : '' ?>" id="provinsi" name="provinsi">
                      <option value="">Pilih Provinsi</option>
                      <?php foreach ($provinsi as $p) : ?>
                        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                      <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                      <?= validation_show_error('provinsi') ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="kabkot" class="form-label">Kabupaten/Kota</label>
                    <select required class="form-select  <?= validation_show_error('kabkot') ? 'is-invalid' : '' ?>" id="kabkot" name="kabkot">
                      <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    <div class="invalid-feedback">
                      <?= validation_show_error('kabkot') ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="alamat_pelanggan" class="form-label">Alamat</label>
                    <input type="hidden" name="alamat_lengkap2" id="alamat_lengkap2" value="<?= old('alamat_lengkap2') ?>">
                    <textarea required name="alamat_pelanggan" class="form-control <?= validation_show_error('alamat_pelanggan') ? 'is-invalid' : '' ?>" id="alamat_pelanggan" cols="30" rows="2"><?= old('alamat_pelanggan') ?></textarea>
                    <div class="invalid-feedback">
                      <?= validation_show_error('alamat_pelanggan') ?>
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

              <form action="" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="edit" value="password">
                <?php //if (isAdmininstrator() && session()->get('admin')['id_pelanggan'] !//= $profile['id_pelanggan']) : 
                ?>
                <input type="hidden" name="id_pelanggan" value="<? //= $profile['id_pelanggan'] 
                                                                ?>">
                <?php //endif 
                ?>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordCurrent">Current password</label>
                  <input type="password" class="form-control <?= validation_show_error('old_password') ? 'is-invalid' : '' ?>" id="inputPasswordCurrent" name="old_password">
                  <div class=" invalid-feedback">
                    <?= validation_show_error('old_password') ?>
                  </div>
                  <!-- <small><a href="#">Forgot your password?</a></small> -->
                </div>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordNew">New password</label>
                  <input type="password" class="form-control <?= validation_show_error('new_password') ? 'is-invalid' : '' ?>" id="inputPasswordNew" name="new_password">
                  <div class=" invalid-feedback">
                    <?= validation_show_error('new_password') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="inputPasswordNew2">Verify password</label>
                  <input type="password" class="form-control <?= validation_show_error('password_verify') ? 'is-invalid' : '' ?>" id="inputPasswordNew2" name="password_verify">
                  <div class=" invalid-feedback">
                    <?= validation_show_error('password_verify') ?>
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

<?= $this->section('script') ?>

<script>
  $('document').ready(function() {
    let ongkir = 0;

    $('#provinsi').on('change', function() {
      $('#kabkot').empty();
      $('#service').empty();
      const province_id = $(this).val();
      $.ajax({
        url: "<?= base_url() . '/rajaongkir/getCity' ?>",
        type: "GET",
        data: {
          'province_id': province_id
        },
        dataType: 'json',
        success: function(data) {
          const result = data['rajaongkir']['results'];
          $('#kabkot').append($('<option>', {
            text: "Pilih Kabupaten/Kota"
          }));
          $('#service').append($('<option>', {
            text: "Pilih Service"
          }));
          for (const res of result) {
            $('#kabkot').append($('<option>', {
              value: res.city_id,
              text: res.city_name
            }));
          }
        }
      })
    });


    $('#alamat_pelanggan').on('change', function() {
      var provinsi = $('#provinsi option:selected').text();
      var kabkot = $('#kabkot option:selected').text();
      var alamat = $(this).val();
      var alamat_pelanggan = `${alamat}, ${kabkot}, Provinsi ${provinsi}`;
      $('#alamat_lengkap2').val(alamat_pelanggan);
    });

  });
</script>

<?= $this->endSection() ?>