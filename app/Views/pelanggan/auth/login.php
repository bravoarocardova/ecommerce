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
                <li class="nav-item">
                  <a class="nav-link me-2" href="<?= base_url('admin/auth/login') ?>">
                    <i class="fas fa-user-lock opacity-6 text-dark me-1"></i>
                    Admin
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
  <main class="main-content ">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-primary text-gradient">Selamat Datang</h3>
                  <p class="mb-0">Silahkan masukkan username dan password kamu untuk masuk</p>
                  <?php echo session()->get('msg') ?>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="<?= base_url('auth/proseslogin') ?>">
                    <label>Username</label>
                    <div class="mb-3">
                      <input type="text" name="username_pelanggan" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <!-- <div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="rememberMe" checked="">
											<label class="form-check-label" for="rememberMe">Remember me</label>
										</div> -->
                    <div class="text-center">
                      <button type="submit" name="login" class="btn bg-primary w-100 mt-4 mb-0 text-light">Masuk</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Belum punya akun?
                    <a href="<?= base_url('auth/register') ?>" class="text-primary text-gradient font-weight-bold">Daftar disini</a>
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