<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->include('pelanggan/layout/_partials/head') ?>
</head>

<body <?= (strtolower('$this->uri->segment(1)' ?? "") == '') ? 'data-bs-spy="scroll" data-bs-target="#navbarscrl" data-bs-offset="0" class="scrollspy-example" tabindex="0"' : '' ?>>
  <div class="wrapper">

    <div class="main">
      <?= $this->include('pelanggan/layout/_partials/navbar') ?>

      <main class="content">
        <?= $this->renderSection('content') ?>
      </main>

      <footer class="footer">
        <?= $this->include('pelanggan/layout/_partials/footer') ?>
      </footer>
    </div>
  </div>

  <?= $this->include('pelanggan/layout/_partials/js') ?>

</body>

</html>