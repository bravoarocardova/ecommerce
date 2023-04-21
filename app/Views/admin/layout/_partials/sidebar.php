<?php $uri = service('uri'); ?>

<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.html">
      <span class="align-middle">SmartComp</span>
    </a>

    <ul class="sidebar-nav">

      <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'dashboard') echo 'active' ?>">
        <a class="sidebar-link" href="<?= base_url('admin/dashboard') ?>">
          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <?php if (isKasir() || isAdmininstrator()) : ?>

        <li class="sidebar-header">
          Penjualan
        </li>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'penjualan') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/penjualan') ?>">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Penjualan</span>
          </a>
        </li>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'produk') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/produk') ?>">
            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Data Produk</span>
          </a>
        </li>

      <?php endif ?>

      <!-- <li class="sidebar-item">
        <a class="sidebar-link" href="pages-sign-up.html">
          <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="pages-blank.html">
          <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
        </a>
      </li> -->

      <?php if (isTeknisi() || isAdmininstrator()) : ?>

        <li class="sidebar-header">
          Servis
        </li>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'servis') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/servis') ?>">
            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Data Servis <span class="badge bg-danger" id="badgeDataServis"></span></span>
          </a>
        </li>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'jasa_servis') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/jasa_servis') ?>">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Jasa Servis</span>
          </a>
        </li>
      <?php endif ?>
      <!-- <li class="sidebar-item">
        <a class="sidebar-link" href="ui-cards.html">
          <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="ui-typography.html">
          <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="icons-feather.html">
          <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
        </a>
      </li> -->

      <li class="sidebar-header">
        Laporan
      </li>
      <?php if (isKasir() || isAdmininstrator()) : ?>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(3) == 'penjualan') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/laporan/penjualan') ?>">
            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Penjualan</span>
          </a>
        </li>
      <?php endif ?>

      <?php if (isTeknisi() || isAdmininstrator()) : ?>
        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(3) == 'servis') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/laporan/servis') ?>">
            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Servis</span>
          </a>
        </li>
      <?php endif ?>

      <?php if (isAdmininstrator()) : ?>
        <li class="sidebar-header">
          Pengaturan
        </li>

        <li class="sidebar-item <?php if (!empty($uri->getSegments()) && $uri->getSegment(2) == 'pengguna') echo 'active' ?>">
          <a class="sidebar-link" href="<?= base_url('admin/pengguna') ?>">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Pengguna</span>
          </a>
        </li>

        <!-- <li class="sidebar-item">
        <a class="sidebar-link" href="maps-google.html">
          <i class="align-middle" data-feather="map"></i> <span class="align-middle">Servis</span>
        </a>
      </li> -->
      <?php endif ?>

    </ul>

    <div class="sidebar-cta">
      <div class="sidebar-cta-content">
        <!-- <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
        <div class="mb-3 text-sm">
          Are you looking for more components? Check out our premium version.
        </div>
        <div class="d-grid">
          <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
        </div> -->
      </div>
    </div>
  </div>
</nav>