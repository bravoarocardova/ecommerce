<?= $this->extend('pelanggan/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container p-0 mt-4">
  <div class="container" id="produk">

    <!-- <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-arrow-left opacity-10"></i> Kembali</a> -->

    <?php if (session()->has('msg')) : ?>
      <?= session()->getFlashdata('msg') ?>
    <?php endif ?>

    <div class="row my-3">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>
              <i class="fa fa-book me-sm-1 text-dark"></i>
              Produk
            </h3>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Kondisi</th>
                  <th>Berat</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $total_berat = 0; ?>
                <?php foreach ($cart->contents() as $produk) : ?>
                  <?php
                  $max = 0;
                  foreach ($max_produk as $r) {
                    if ($produk['id'] == $r['id']) {
                      $max = $r['max'];
                    }
                  }
                  ?>
                  <tr>
                    <td width="15%">
                      <span class=""> <?= $produk['qty'] ?></span>
                    </td>
                    <td><img src="<?= base_url() . '/img/produk/' . $produk['options']['foto'] ?>" class="img-fluid rounded-start avatar" alt="Cover"></td>
                    <td width="25%"><?= $produk['name'] ?></td>
                    <td><?= $produk['options']['kondisi'] ?></td>
                    <td><?= $produk['options']['berat'] * $produk['qty'] ?> g</td>
                    <td>Rp. <?= number_format($produk['subtotal'] ?? 0) ?></td>

                  </tr>
                  <?php $total_berat += $produk['options']['berat'] * $produk['qty']; ?>
                <?php endforeach ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
            <div class="row mb-4 border-bottom">
              <div class="col-md-6 offset-md-4">
                <div class="d-flex justify-content-between">
                  <h4>
                    Total Berat
                  </h4>
                  <h4>
                    <?= number_format($total_berat) ?> g
                  </h4>
                </div>
                <div class="d-flex justify-content-between">
                  <h4>
                    Sub Total
                  </h4>
                  <h4>
                    Rp. <?= number_format($cart->total()) ?>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3>
              <i class="fa fa-book me-sm-1 text-dark"></i>
              Checkout
            </h3>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="mb-3">
                  <label for="provinsi" class="form-label">Provinsi</label>
                  <select class="form-select  <?= validation_show_error('provinsi') ? 'is-invalid' : '' ?>" id="provinsi" name="provinsi">
                    <option value="">Pilih Provinsi</option>
                    <?php foreach ($provinsi as $p) : ?>
                      <option value="<?= $p->province_id ?>" <?php if (old('provinsi', '') == '<?= $p->province_id ?>') echo 'selected' ?>><?= $p->province ?></option>
                    <?php endforeach ?>
                  </select>
                  <div class="invalid-feedback">
                    <?= validation_show_error('provinsi') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="kabkot" class="form-label">Kabupaten/Kota</label>
                  <select class="form-select  <?= validation_show_error('kabkot') ? 'is-invalid' : '' ?>" id="kabkot" name="kabkot">
                    <option value="">Pilih Kabupaten/Kota</option>

                  </select>
                  <div class="invalid-feedback">
                    <?= validation_show_error('kabkot') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="ongkir" class="form-label">Service</label>
                  <select class="form-select  <?= validation_show_error('ongkir') ? 'is-invalid' : '' ?>" id="service" name="ongkir">
                    <option value="">Pilih Service</option>
                  </select>
                  <div class="invalid-feedback">
                    <?= validation_show_error('ongkir') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <p>Estimasi : <span id="estimasi"></span></p>
                </div>
                <div class="mb-3">
                  <h5>Ongkir : Rp. <span id="ongkir"></span></h5>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="alamat_lengkap">Alamat Lengkap</label>
                  <textarea disabled class="form-control <?= validation_show_error('alamat_lengkap') ? 'is-invalid' : '' ?>" name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="2"><?= old('alamat_lengkap', '') ?></textarea>
                  <div class="invalid-feedback">
                    <?= validation_show_error('alamat_lengkap') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-lg-6">
                      <h5>Total Pembayaran :</h5>
                    </div>
                    <div class="col-lg-6">
                      <h5> Rp. <span id="total_pembayaran"></span></h5>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="tujuan" id="tujuan">
              <input type="hidden" name="ekspedisi" id="ekspedisi">
              <div class="row">
                <div class="d-flex justify-content-evenly">
                  <button type="submit" disabled class="btn btn-primary p-3"><i class="fa fa-shopping-cart opacity-10 me-2"></i> Checkout</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $('document').ready(function() {
    let ongkir = 0;

    $('#provinsi').on('change', function() {
      $('#kabkot').empty();
      $('#service').empty();
      const province_id = $(this).val();
      $.ajax({
        url: "<?= base_url() . '/rajaongkir/getCity' ?>",
        type: "GET",
        data: {
          'province_id': province_id
        },
        dataType: 'json',
        success: function(data) {
          const result = data['rajaongkir']['results'];
          $('#kabkot').append($('<option>', {
            text: "Pilih Kabupaten/Kota"
          }));
          $('#service').append($('<option>', {
            text: "Pilih Service"
          }));
          for (const res of result) {
            $('#kabkot').append($('<option>', {
              value: res.city_id,
              text: res.city_name
            }));
          }
        }
      })
    });

    $('#kabkot').on('change', function() {
      const city_id = $(this).val();
      $('#service').empty();
      $('#alamat_lengkap').val('');
      $("#alamat_lengkap").prop('disabled', true);
      $.ajax({
        url: "<?= base_url() . '/rajaongkir/getCost' ?>",
        type: "GET",
        data: {
          'origin': <?= App\Libraries\RajaOngkir::$origin ?>,
          'destination': city_id,
          'weight': <?= $total_berat ?>,
          'courier': 'jne'
        },
        dataType: 'json',
        success: function(data) {
          $("#alamat_lengkap").prop('disabled', false);
          const result = data['rajaongkir']['results'][0]['costs'];
          $('#service').append($('<option>', {
            text: "Pilih Service"
          }));
          for (const res of result) {
            $('#service').append($('<option>', {
              value: res.cost[0].value,
              text: res.description + " (" + res.service + ")",
              etd: res.cost[0].etd
            }));
          }
        }
      })
    });

    $('#service').on('change', function() {
      const estimasi = $('option:selected', this).attr('etd');
      ongkir = parseInt($(this).val());
      $('#ongkir').html(numberWithCommas(ongkir));
      $('#estimasi').html(estimasi + " Hari");
      const total_pembayaran = <?= $cart->total() ?> + ongkir;
      $('#total_pembayaran').html(numberWithCommas(total_pembayaran));
      $('#ekspedisi').val($('option:selected', this).text());
    });

    $('#alamat_lengkap').on('change', function() {
      var provinsi = $('#provinsi option:selected').text();
      var kabkot = $('#kabkot option:selected').text();
      var alamat = $(this).val();
      $("[type=submit]").prop('disabled', false);
      console.log(provinsi + kabkot + alamat);
      var alamat_lengkap = `${alamat}, ${kabkot}, ${provinsi}`;
      $('#tujuan').val(alamat_lengkap);
    });

  });

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
</script>

<?= $this->endSection() ?>