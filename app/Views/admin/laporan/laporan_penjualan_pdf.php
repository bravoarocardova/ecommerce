<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <style>
    #table {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #table td,
    #table th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #table tr:hover {
      background-color: #ddd;
    }

    #table th {
      padding-top: 10px;
      padding-bottom: 10px;
      text-align: left;
      background-color: #1C1F50;
      color: white;
    }
  </style>
</head>

<body>
  <!-- <img src="<?= base_url('/img/avatars/default.jpg') ?>"> -->
  <div style="text-align:center">
    <h2>Smartcomp Store</h2>
    <h6>Jl. RB Siagian, Kec Pal Merah. Sari, Kec. Kota Jambi</h6>
    <hr>
    <h3>Laporan Data Penjualan</h3>
    <h5><?= $tgl ?></h5>
  </div>
  <table id="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>No Transaksi</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal Transaksi</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      $total = 0;
      foreach ($penjualan as $r) : $total += $r['total_pembelian'] ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $r['id_pembelian'] ?></td>
          <td><?= $r['nama_pelanggan'] ?></td>
          <td><?= $r['created_at'] ?></td>
          <td>Rp. <?= number_format($r['total_pembelian']) ?></td>
        </tr>
      <?php endforeach ?>
      <tr>
        <td colspan="4">Total</td>
        <td>Rp. <?= number_format($total) ?></td>
      </tr>
    </tbody>
  </table>
  <br>
  <br>
  <div style="text-align:right">
    <p>Jambi, <?= date('d-m-Y') ?></p>
    <br><br>
    <p><?= session()->get('admin')['nama'] ?></p>
  </div>
</body>

</html>