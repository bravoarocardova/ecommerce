<?php
$uri = service('uri');
?>

<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.html">
      <span class="align-middle">AdminKit</span>
    </a>

    <ul class="sidebar-nav">

      <li class="sidebar-item <?php if ($uri->getSegment(2) == 'dashboard') echo 'active' ?>">
        <a class="sidebar-link" href="<?= base_url('admin/dashboard') ?>">
          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <li class="sidebar-header">
        Penjualan
      </li>

      <li class="sidebar-item <?php if ($uri->getSegment(2) == 'penjualan') echo 'active' ?>">
        <a class="sidebar-link" href="<?= base_url('admin/penjualan') ?>">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Penjualan</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="pages-sign-in.html">
          <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Data Produk</span>
        </a>
      </li>

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

      <li class="sidebar-header">
        Servis
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="ui-buttons.html">
          <i class="align-middle" data-feather="square"></i> <span class="align-middle">Data Servis</span>
        </a>
      </li>

      <li class="sidebar-item <?php if ($uri->getSegment(2) == 'jasa_servis') echo 'active' ?>">
        <a class="sidebar-link" href="<?= base_url('admin/jasa_servis') ?>">
          <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Jasa Servis</span>
        </a>
      </li>

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

      <li class="sidebar-item">
        <a class="sidebar-link" href="charts-chartjs.html">
          <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Penjualan</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="maps-google.html">
          <i class="align-middle" data-feather="map"></i> <span class="align-middle">Servis</span>
        </a>
      </li>

      <li class="sidebar-header">
        Pengaturan
      </li>

      <!-- <li class="sidebar-item">
        <a class="sidebar-link" href="charts-chartjs.html">
          <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Penjualan</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="maps-google.html">
          <i class="align-middle" data-feather="map"></i> <span class="align-middle">Servis</span>
        </a>
      </li> -->

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