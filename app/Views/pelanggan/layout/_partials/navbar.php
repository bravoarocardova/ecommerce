<?php $uri = service('uri'); ?>
<nav id="navbarscrl" class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= base_url() ?>">SmartComp Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto">
        <a class="nav-link fw-bold <?= (strtolower($uri->getSegment(1) ?? "") == 'produk') ? 'active' : '' ?>" href="<?= base_url('produk') ?>">Produk</a>
        <!-- <a class="nav-link fw-bold" href="<? //= (strtolower('$this->uri->segment(1)' ?? "") == 'produk') ? base_url('#galeri') : '#galeri' 
                                                ?>">Galeri</a> -->
        <!-- <a class="nav-link fw-bold" href="<?= (strtolower('$this->uri->segment(1)' ?? "") == '') ? '#lokasi' : base_url('#lokasi') ?>">Lokasi</a> -->
        <a class="nav-link fw-bold <?= (strtolower($uri->getSegment(1) ?? "") == 'cekservis') ? 'active' : '' ?>" href="<?= base_url('cekservis') ?>">Cek Servis</a>

      </div>
      <div class="mt-sm-0 mt-2 me-md-0 me-sm-4">
        <ul class="navbar-nav ms-auto justify-content-end">
          <?php if (session()->get('pelanggan') == null && session()->get('admin') == null) : ?>
            <li class="nav-item d-flex align-items-center">
              <a href="<?= base_url('auth/login') ?>" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-sign-in me-sm-1 text-white"></i>
                <span class="text-white">Login</span>
              </a>
            </li>

          <?php elseif (session()->get('admin') != null) : ?>
            <li class="nav-item d-flex align-items-center">
              <a href="<?= base_url('admin/dashboard') ?>" class="nav-link text-body font-weight-bold px-0">
                <!-- <i class="fa fa-user me-sm-1 text-white"></i> -->
                <span class="text-white">Dashboard</span>
              </a>
            </li>

          <?php else : ?>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                <i class="fa fa-user me-sm-1 text-white"></i>
                <span class="d-sm-inline text-white d-none"><?= session()->get('pelanggan')['nama'] ?? session()->get('admin')['nama'] ?></span>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-3 py-3 me-sm-n0" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?= base_url('profile/') ?>">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?= base_url() . '/img/avatars/' . session()->get('pelanggan')['foto'] ?>" class="avatar avatar-sm  me-3">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold"><?= session()->get('pelanggan')['nama'] ?></span>
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-briefcase me-1"></i>
                          <?= session()->get('pelanggan')['role'] ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md " href="<?= base_url('dashboard/') ?>">
                    Dashboard
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md " href="<?= base_url('pesanan/') ?>">
                    Pesanan Saya
                    <span class=" badge rounded-pill bg-danger">2</span>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md " href="<?= base_url('profile/') ?>">
                    Profile
                  </a>
                </li>
                <li class="d-flex justify-content-end">
                  <a href="<?= base_url('auth/logout') ?>" class="w-100 btn btn-danger"><i class="fa fa-sign-out opacity-10"></i> Logout</a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center ms-4">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0 position-relative" id="dropdownMenuButton" data-bs-toggle="dropdown">
                <i class="fa fa-shopping-cart me-sm-1 text-white"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </div>
</nav>