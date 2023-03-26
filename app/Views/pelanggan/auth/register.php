<!--
=========================================================
* Soft UI Dashboard - v1.0.6
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->include('pelanggan/layout/_partials/head') ?>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">

            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto ms-xl-auto">
                <li class="nav-item">
                  <a class="nav-link me-2 text-danger" href="<?= base_url() ?>">
                    <i class="fas fa-arrow-left opacity-6 text-dark me-1"></i>
                    Kembali
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 text-info" href="<?= base_url('auth/register') ?>">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Register
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="<?= base_url('auth/login') ?>">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Login
                  </a>
                </li>
              </ul>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10 mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                  <p class="mb-0">Silahkan lakukan pendaftaran pada form dibawah!</p>
                  <?= session()->get('msg') ?>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="<?= base_url('auth/prosesregister') ?>">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <label>Nama Lengkap</label>
                        <div class="mb-3">
                          <input required type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" aria-label="Nama Lengkap">
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <label>Username</label>
                        <div class="mb-3">
                          <input required type="text" name="username_pelanggan" class="form-control" placeholder="Username" aria-label="Username">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <label>Email</label>
                        <div class="mb-3">
                          <input required type="email" name="email_pelanggan" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <label>No Telepon</label>
                        <div class="mb-3">
                          <input required type="text" name="telepon_pelanggan" class="form-control" placeholder="No Telepon" aria-label="NoTelepon">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-12">
                        <label>Password</label>
                        <div class="mb-3">
                          <input required type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <label>Password Konfirmasi</label>
                        <div class="mb-3">
                          <input required type="password" name="password_konfirmasi" class="form-control" placeholder="Password Konfirmasi" aria-label="Password" aria-describedby="password-addon">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="rememberMe" checked="">
											<label class="form-check-label" for="rememberMe">Remember me</label>
										</div> -->
                    <div class="text-center">
                      <button type="submit" name="register" class="btn bg-info w-100 mt-4 mb-0">Daftar</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Sudah punya akun?
                    <a href="<?= base_url('auth/login') ?>" class="text-info text-gradient font-weight-bold">Masuk disini</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?= $this->include('pelanggan/layout/_partials/js'); ?>
</body>

</html>