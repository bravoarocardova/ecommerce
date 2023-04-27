<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>
<div class="bg-light p-4" id="produk">
  <div class="container">
    <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>

    <div class="row justify-content-end">
      <div class="col-6">
        <?= session()->get('msg'); ?>
      </div>
    </div>
    <div id="printDiv">
      <div class="row text-center">
        <h4 class="fw-bold text-primary text-gradient">Detail Pembelian</h4>
      </div>

      <div class="row">
        <div class="col-md-4">
          <h3>Pembelian</h3>
          Tangal Transaksi : <?php echo $pembelian['created_at']; ?> <br>
          <p>
            Tangal Update : <?php echo $pembelian['updated_at']; ?> <br>

            Ekspedisi : <?php echo $pembelian['ekspedisi']; ?><br>

            Berat : <?php echo number_format($pembelian['total_berat']); ?> g<br>

            Ongkir : Rp. <?php echo number_format($pembelian['ongkir']); ?><br>

            Status : <?= ($pembelian['status_pembelian'] == 'Belum Bayar') ? "<span class='text-danger'>Bayar Sebelum (<span class='text-success'>" . date("Y-m-d H:i:s", strtotime($pembelian['created_at']) + 60 * 60) . "</span>)</span>" : $pembelian['status_pembelian'] ?> <br>

            No Resi : <?php echo $pembelian['no_resi']; ?><br>
          </p>

        </div>
        <div class="col-md-4">
          <h3>Pelanggan</h3>

          Nama : <strong><?php echo $pembelian['nama_pelanggan']; ?></strong> <br>
          <p>
            Telepon : <?php echo $pembelian['telepon_pelanggan']; ?> <br>
            Email : <?php echo $pembelian['email_pelanggan']; ?> <br>
            Alamat : <?php echo $pembelian['tujuan']; ?>
          </p>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div id="printDiv2">
        <table class="table align-items-center mb-0" id="datatable">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                No
              </th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Nama</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Harga</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Jumlah</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
            <?php $no = 1;
            foreach ($produk as $r) : ?>
              <?php $total += $r['subtotal'] ?>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <h6 class="mb-0 text-sm"><?= $no++ ?></h6>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $r['nama_produk'] ?></p>
                </td>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs font-weight-bold mb-0">Rp. <?= number_format($r['harga_produk']) ?></p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-secondary text-xs font-weight-bold"><?= number_format($r['jumlah']) ?></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-primary text-xs font-weight-bold">Rp. <?= number_format($r['subtotal']) ?></span>
                </td>
              </tr>
            <?php endforeach ?>

            <?php if ($pembelian['ongkir'] != '0') : ?>
              <th>

              </th>
              <tr>
                <th colspan="4" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Biaya Lainnya</th>
              </tr>
              <tr>
                <td class="align-middle text-center" colspan="4">
                  <span class="text-xs font-weight-bold">Ongkir</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-primary text-xs font-weight-bold">Rp. <?= number_format($pembelian['ongkir']) ?></span>
                </td>
              </tr>
            <?php endif ?>
            <tr>

            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Total</th>
              <th class="text-center">
                <span class="text-primary text-xl font-weight-bold">Rp. <?= number_format($total + $pembelian['ongkir']) ?></span>
              </th>
            </tr>
          </tfoot>
        </table>
      </div>

      <?php if ($pembelian['status_pembelian'] == 'Belum Bayar') : ?>
        <div class="row">
          <div class="col-md-6">
            <br>
            <div class="alert alert-info">
              <p class="text-dark">Silakan melakukan pembayaran Rp. <?php echo number_format($total + $pembelian['ongkir']); ?> ke <br>
                <strong>BANK BRI 0393-0100-3205-535 AN. SmartComp</strong>

              </p>

            </div>
          </div>
          <div class="col-md-6">
            <br>
            <a href="<?= base_url('produk/pembayaran/' . $pembelian['id_pembelian']) ?>" class="btn btn-success bg-gradient ">Konfirmasi Bayar</a>
          </div>
        </div>
      <?php endif ?>

      <?php if ($pembayaran != null) : ?>
        <div class="col-md-6">
          <br>
          <a href="<?= base_url('img/bukti/' . $pembayaran['bukti'])  ?>" target="_blank" class="btn btn-info bg-gradient ">Bukti Transfer</a>
        </div>
      <?php endif ?>
      <div class="col-md-6">
        <br>
        <button" target="_blank" onclick="printDiv('printDiv','printDiv2')" class="btn btn-info">
          <i class="align-middle" data-feather="printer"></i>
          Cetak
          </button>
      </div>
      <?php if (isAdmininstrator()) : ?>
        <?php if ($pembelian['status_pembelian'] == 'Menunggu Verifikasi') : ?>
          <div class="col-md-6">
            <br>
            <a href="<?= base_url('admin/transaksi/diproses/' . $pembelian['id_pembelian']) ?>" class="btn btn-success bg-gradient ">Proses</a>
          </div>
        <?php elseif ($pembelian['status_pembelian'] == 'Diproses') : ?>
          <div class="col-md-6">
            <br>
            <a href="<?= base_url('admin/transaksi/dipinjam/' . $pembelian['id_pembelian']) ?>" class="btn btn-success bg-gradient ">Dipinjam</a>
          </div>
        <?php elseif ($pembelian['status_pembelian'] == 'Dipinjam') : ?>
          <div class="col-md-6">
            <br>
            <button class="btn btn-success bg-gradient " data-bs-toggle="modal" data-bs-target="#ModalDenda">Di Kembalikan</button>
          </div>

        <?php endif ?>
      <?php endif ?>


    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  function printDiv(divName1, divName2) {
    var printContents1 = document.getElementById(divName1).innerHTML;
    var printContents2 = document.getElementById(divName2).innerHTML;

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents1 + printContents2;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>
<?= $this->endSection() ?>