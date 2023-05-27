<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<section class="bg-light pt-2">
  <!-- Carousel -->
  <div class="container ">
    <div id="carouselExampleIndicators" style="background:black" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php foreach ($promosi_gambar as $key => $b) : ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" class="<?= ($key == 0) ? 'active' : '' ?>" aria-current="true"></button>
        <?php endforeach ?>
      </div>
      <div class="carousel-inner">
        <?php foreach ($promosi_gambar as $key => $b) : ?>
          <div class="carousel-item  <?= ($key == 0) ? 'active' : '' ?>">
            <img src="<?= base_url() . '/img/promosi/' . $b['gambar'] ?>" height="500px" class="img-carousel d-block w-100">
          </div>
        <?php endforeach ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- end Carousel -->

  <!-- keuntungan -->
  <div class="container mt-4 ">
    <div class="text-center mb-4">
      <div class="row">
        <h3 class="fw-bolder text-secondary"><?= $info['nama_aplikasi'] ?></h3>
        <h1 class="text-danger min-vh-25 h-25" id="text-promotion">
          <?= $promosi_text[0] ?>
        </h1>
      </div>
      <div class="row m-4 d-flex justify-content-center">
        <div class="col-6 col-md-4">
          <div class="row">
            <div class="text-center">
              <img src="<?= base_url() . '/img/icons/hargamurah.png' ?>" class="card-img-top w-25">
            </div>
          </div>
          <div class="row">
            <p class="text-secondary fw-bold">Harga Murah</p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="row">
            <div class="text-center">
              <img src="<?= base_url() . '/img/icons/' . "bestcamera.png" ?>" class="card-img-top w-25">
            </div>
          </div>
          <div class="row text-center">
            <p class="text-secondary fw-bold">Produk Terbaik</p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="row">
            <div class="text-center">
              <img src="<?= base_url() . '/img/icons/' . "pelayananterbaik.png" ?>" class="card-img-top w-25">
            </div>
          </div>
          <div class="row">
            <p class="text-secondary fw-bold">Pelayanan Terbaik</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Keuntungan -->

  <img src="<?= base_url() . '/img/icons/wavesNegative.svg' ?>" alt="" width="100%" class="bg-">

</section>

<section>
  <!-- Lokasi -->
  <div class="bg-white mb-4 mt-4" id="lokasi">
    <div class="container p-4">
      <div class="row text-center">
        <h4 class="fw-bold text-secondary">Lokasi</h4>
      </div>
      <div class="row mt-4">
        <div class="col-lg-8 col-12">
          <iframe src="<?= $info['lokasi'] ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-4 col-12">
          <div class="row">
            <h5 class="fw-bolder">Alamat</h5>
            <p><?= $info['alamat'] ?></p>
          </div>
          <div class="row">
            <h5 class="fw-bolder">Jam Buka</h5>
            <table class="table">
              <?php foreach ($hari as $h) : ?>
                <tr>
                  <td><?= $h->hari ?></td>
                  <td><?= $h->jam ?></td>
                </tr>
              <?php endforeach ?>
            </table>
          </div>
          <div class="row">
            <h5 class="fw-bolder">Kontak</h5>
            <p>+<?= $info['telepon'] ?></p>
            <p><?= $info['email'] ?></p>
            <div class="row">
              <div class="col">
                <a href="https://api.whatsapp.com/send?phone=<?= $info['telepon'] ?>&text=Saya%20mau%20memesan%20...." target="_blank" class="text-light btn btn-success"><i class="fa fa-whatsapp"></i> WhatsApp</a> <a href="tel: <?= $info['telepon'] ?>" class="text-light btn btn-dark"><i class="fa fa-phone"></i>
                  Telepon</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Lokasi -->
  <div id="waButton" style="z-index:1000"></div>
</section>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
  (function() {
    var words = <?= json_encode($promosi_text) ?>,
      i = 0;
    setInterval(function() {
      $('#text-promotion').fadeOut(function() {
        $(this).html(words[(i = (i + 1) % words.length)]).fadeIn();
      });
    }, 5000)
  })();
</script>

<?= $this->endSection() ?>