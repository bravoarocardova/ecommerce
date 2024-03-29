<nav class="navbar navbar-expand navbar-light navbar-bg">
  <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
  </a>

  <div class="navbar-collapse collapse">
    <ul class="navbar-nav navbar-align">
      <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
          <i class="align-middle" data-feather="settings"></i>
        </a>
        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url() . '/img/avatars/' . session()->get('admin')['foto'] ?>" class="avatar img-fluid rounded me-1" alt="<?= session()->get('admin')['nama'] ?>" /> <span class="text-dark"><?= session()->get('admin')['nama'] ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="<?= base_url() . '/admin/pengguna/profile' ?>"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
          <a class="dropdown-item" href="<?= base_url() . '/admin' ?>"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
          <div class="dropdown-divider"></div>
          <!-- <a class="dropdown-item" href="<?= base_url() ?>"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a> -->
          <!-- <a class="dropdown-item" href="<?= base_url() ?>"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url() . '/admin/auth/logout' ?>">Log out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>