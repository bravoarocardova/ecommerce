<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->include('admin/layout/_partials/head') ?>
</head>

<body>
  <div class="wrapper">
    <?= $this->include('admin/layout/_partials/sidebar') ?>

    <div class="main">
      <?= $this->include('admin/layout/_partials/navbar') ?>

      <main class="content">
        <?= $this->renderSection('content') ?>
      </main>

      <footer class="footer">
        <?= $this->include('admin/layout/_partials/footer') ?>
      </footer>
    </div>
  </div>

  <?= $this->include('admin/layout/_partials/js') ?>

</body>

</html>