<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="bg-light">
  <div class="container">

    <div class="row pt-4 pb-4">
      <h3>Biaya Servis</h3>
      <table class="table table-hover my-0" id="jasaServis">
        <thead>
          <tr>
            <th>Jasa Servis</th>
            <th>Kategori</th>
            <th>Biaya</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($jasa_servis as $j) : ?>
            <tr>
              <td><?= $j['nama_jasa'] ?></td>
              <td><?= $j['kategori'] ?></td>
              <td>Rp. <?= number_format($j['biaya_jasa']) ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>


  </div>
</div>

<div class="container mt-4">
  <div class="row">
    <h3>Harga Part</h3>
    <table class="table table-hover my-0" id="jasaServis">
      <thead>
        <tr>
          <th>Jasa Servis</th>
          <th>Kategori</th>
          <th>Biaya</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($part_produk as $j) : ?>
          <tr>
            <td><?= $j['nama_part'] ?></td>
            <td><?= $j['kategori'] ?></td>
            <td>Rp. <?= number_format($j['biaya_part']) ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>