<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<section class="bg-light pt-2">
  <!-- Carousel -->
  <div class="container ">
    <div id="carouselExampleIndicators" style="background:black" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php foreach ($banner as $key => $b) : ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" class="<?= ($key == 0) ? 'active' : '' ?>" aria-current="true"></button>
        <?php endforeach ?>
      </div>
      <div class="carousel-inner">
        <?php foreach ($banner as $key => $b) : ?>
          <div class="carousel-item  <?= ($key == 0) ? 'active' : '' ?>">
            <img src="<?= base_url() . '/img/banner/' . $b->banner ?>" height="500px" class="img-carousel d-block w-100">
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
        <h3 class="fw-bolder text-secondary"><?= $info->judul ?></h3>
        <p class="text-secondary"><?= $info->slogan ?></p>
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
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1615.0479025418338!2d103.6419543300081!3d-1.623708126507803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588b204a20577%3A0x9bf71b5d8026acad!2sJl.%20RB.%20Siagian%2C%20Kec.%20Jambi%20Sel.%2C%20Kota%20Jambi%2C%20Jambi!5e0!3m2!1sid!2sid!4v1671179941959!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-4 col-12">
          <div class="row">
            <h5 class="fw-bolder">Alamat</h5>
            <p><?= $info->alamat ?></p>
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
            <p>+<?= $info->kontak ?></p>
            <div class="row">
              <div class="col">
                <a href="https://api.whatsapp.com/send?phone=<?= $info->kontak ?>&text=Saya%20mau%20memesan%20...." target="_blank" class="text-light btn btn-success"><i class="fa fa-whatsapp"></i> WhatsApp</a> <a href="tel: <?= $info->kontak ?>" class="text-light btn btn-dark"><i class="fa fa-phone"></i>
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