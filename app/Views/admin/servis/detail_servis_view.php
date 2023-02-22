<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0" id="printArea">

  <div class="d-print-none">
    <?php if (session()->has('msg')) : ?>
      <?= session()->getFlashdata('msg') ?>
    <?php endif ?>
  </div>

  <div class="card d-print-none">
    <div class="card-body">
      <div class="row">
        <div class="col">
          <a class="btn btn-success" href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang' ?>">
            <i class="align-middle" data-feather="plus-circle"></i> Barang
          </a>
          <a class="btn btn-warning" href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] ?>">
            <i class="align-middle" data-feather="settings"></i> Servis
          </a>
        </div>
        <div class="col d-flex justify-content-end">
          <?php if (!empty($barang_servis)) : ?>
            <a class="btn btn-primary" href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/send' ?>">
              <i class="align-middle" data-feather="send"></i> Beritahu Pelanggan
            </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3>Detail Transaksi</h3>
            </div>
            <div class="col d-flex justify-content-end">
              <?php if ($barang_servis) : ?>
                <button class=" btn btn-info d-print-none" onclick="printDiv('printArea')">
                  <i class="align-middle" data-feather="printer"></i>
                  Cetak
                </button>
              <?php endif ?>
            </div>
          </div>
          <h4>No Transaksi : <?= $detail_servis['no_transaksi'] ?></h4>
          <h5>Tanggal Transaksi : <?= $detail_servis['created_at'] ?></h5>
          <h6>Status : <?= ucwords($detail_servis['status']) . ' ( ' . $detail_servis['updated_at'] . ' ) ' ?> </h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <h5>Nama Pelanggan</h5>
                <p><?= $detail_servis['nama_pelanggan'] ?></p>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <h5>Alamat Pelanggan</h5>
                <p><?= $detail_servis['alamat_pelanggan'] ?></p>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <h5>Nama Pelanggan</h5>
                <p><?= $detail_servis['no_telp_pelanggan'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <?php $total = 0 ?>
          <?php if (!$barang_servis) : ?>
            <a href="<?= base_url() . '/admin/servis/' . $detail_servis['no_transaksi'] . '/barang' ?>" class="btn btn-primary d-print-none">
              <i class="align-middle" data-feather="arrow-up-right"></i>
              Tambahkan Barang
            </a>
          <?php endif ?>
        </div>
        <div class="card-body">
          <ol>
            <?php foreach ($barang_servis as $b) : ?>
              <h4>
                <li><?= $b['nama_barang_servis'] . ' - ' . $b['kerusakan'] ?></li>
              </h4>
              <?php if (!empty($b['servis'])) : ?>
                <table class="table table-hover my-0 mb-3" id="dataServiss">
                  <thead>
                    <tr>
                      <th class="col-8">Jasa Servis</th>
                      <th class="col-4">Biaya Servis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($b['servis'] as $bservis) : ?>
                      <?php $total += $bservis['biaya_servis'] ?>
                      <tr>
                        <td><?= $bservis['nama_jasa'] . ' - ' . $bservis['kategori'] ?></td>
                        <td>Rp. <?= number_format($bservis['biaya_servis']) ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else : ?>
                <p class="text-danger">Tidak Ada Perbaikan</p>
              <?php endif ?>
            <?php endforeach ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h3>Total Biaya</h3>
            </div>
            <div class="col-4">
              <h3>Rp. <?= number_format($total) ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>

<script>
  $(document).ready(function() {
    $('#dataServis').DataTable();
  });
</script>

<?php if (session()->has('waSendUrl')) : ?>
  <script type='text/javascript'>
    function mobilecheck() {
      var check = false;
      (function(a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
      })(navigator.userAgent || navigator.vendor || window.opera);
      return check;
    }

    var isMobile = mobilecheck();
    var url = 'https://';
    url += isMobile ? 'api' : 'web';
    url += '.whatsapp.com/send?<?= session()->getFlashdata('waSendUrl') ?>';

    window.open(url, '_blank');
  </script>
<?php endif ?>

<?= $this->endSection() ?>