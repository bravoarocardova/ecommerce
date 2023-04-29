<?php

use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;
use CodeIgniter\Model;

/**
 * helper buat alert session
 * 
 * @param string $type classname
 * @param string $msg
 * @return html alert
 */
function myAlert($type, $msg)
{
  return "<div class='alert alert-$type' role='alert'>
      $msg
    </div>";
}

/**
 * helper buat no_transaksi
 * 
 * @param string $kode
 * @param Model $model
 * @param int $offset field - $kode
 * @param int $length panjang String 0
 * @return string 
 */
function createNoTransaksi($kode, Model $model, $field, $offset = 3, $length = 8)
{
  $lastKode = $model->selectMax($field)->first();
  $lastKode = (int) substr($lastKode[$field], $offset);
  $lastKode++;
  return $kode . sprintf("%0" . $length . "s", $lastKode);
}

// User Role
function isAdmininstrator()
{
  $sess = session()->get('admin') ?? session()->get('pelanggan');
  return $sess['role'] == 'admin';
}

function isKasir()
{
  $sess = session()->get('admin') ?? session()->get('pelanggan');
  return $sess['role'] == 'kasir';
}

function isTeknisi()
{
  $sess = session()->get('admin') ?? session()->get('pelanggan');
  return $sess['role'] == 'teknisi';
}
// End User Role

// Cek Transaksi Dibatalkan
function cekDibatalkan()
{
  $pembelianM = new PembelianM();
  $pembelian = $pembelianM->where('status_pembelian', 'Belum Bayar')->find();

  $pembelianProdukM = new PembelianProdukM();

  $produkM = new ProdukM();

  // Mendapatkan data dengan status_pembelian belum bayar lebih dari 1 jam
  $getDibatalkan = [];
  foreach ($pembelian as  $row) {
    if (strtotime(date("Y-m-d H:i:s")) > strtotime($row['created_at']) + 60 * 60) {
      $getDibatalkan[] = [
        'id_pembelian' => $row['id_pembelian'],
        'status_pembelian' => 'Dibatalkan',
      ];
    }
  }

  // Jika data yang belum bayar tidak kosong jalankan ini
  if (!empty($getDibatalkan)) {
    // Mendapatkan jumlah stok produk
    $stok = $produkM->select('DISTINCT(produk.id_produk), stok_produk')
      ->join('pembelian_produk', 'produk.id_produk = pembelian_produk.id_produk')
      ->join('pembelian', 'pembelian_produk.id_pembelian = pembelian.id_pembelian')
      ->where('pembelian.status_pembelian', 'Belum Bayar')
      ->find();

    // Mendapatkan data produk yang dibatalkan
    $produk = [];
    foreach ($getDibatalkan as $r) {
      $getProduk = $pembelianProdukM->where('id_pembelian', $r['id_pembelian'])->find();

      foreach ($getProduk as $g) {

        $produk[] = [
          'id_produk' => $g['id_produk'],
          'jumlah' => $g['jumlah'],
        ];
      }
    }

    // sorting data produk dari id_produk terbesar
    arsort($produk);
    $prev = 0;
    $setProduk = [];
    // set produk yang belum dibayar ke data untuk di update
    foreach ($produk as  $r) {
      if ($prev == $r['id_produk']) { // Jika id_produk sama dengan sebelumnya stok produk ditambah dengan stok sebelumnya
        $index = array_search($r['id_produk'], array_column($setProduk, 'id_produk'));
        $setProduk[$index]['stok_produk'] += $r['jumlah'];
      } else { //Jika id_produk tidak sama dengan produk sebelumnya tambahkan sebagai data baru
        $setProduk[] = [
          'id_produk' => $r['id_produk'],
          'stok_produk' => $r['jumlah'],
        ];
      }

      $prev = $r['id_produk'];
    }

    // Update SetProduk dengan stok sebelumnya yang ada di database stok
    foreach ($setProduk as $sp) {
      $indexStok = array_search($sp['id_produk'], array_column($stok, 'id_produk'));
      $indexSetProduk = array_search($sp['id_produk'], array_column($setProduk, 'id_produk'));
      $setProduk[$indexSetProduk]['stok_produk'] += $stok[$indexStok]['stok_produk'];
    }

    // Jalankan update dengan batch
    $pembelianM->updateBatch($getDibatalkan, 'id_pembelian');
    if (!empty($setProduk)) {
      $produkM->updateBatch($setProduk, 'id_produk');
    }
  }

  return true;
}
