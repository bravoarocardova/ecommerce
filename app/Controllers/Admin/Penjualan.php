<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;

class Penjualan extends BaseController
{

  private $produkM;
  private $pembelianM;
  private $pembelianProdukM;

  public function __construct()
  {
    $this->produkM = new ProdukM();
    $this->pembelianM = new PembelianM();
    $this->pembelianProdukM = new PembelianProdukM();
  }

  public function index()
  {
    $select = 'pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan';
    $join = ['table' => 'pelanggan', 'cond' => 'pembelian.id_pelanggan = pelanggan.id_pelanggan'];

    $dikemas = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Dikemas',
    ])->find();

    $dikirim = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Dikirim',
    ])->find();

    $selesai = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Selesai',
    ])->find();
    return view(
      'admin/penjualan/data_penjualan_view',
      [
        'dikemas' => $dikemas,
        'dikirim' => $dikirim,
        'selesai' => $selesai,
      ]
    );
  }

  public function detail_penjualan($id_pembelian)
  {
    $pembelian = $this->pembelianM->select('pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan')->join('pelanggan', 'pembelian.id_pelanggan = pelanggan.id_pelanggan')->find($id_pembelian);

    $produk = $this->pembelianProdukM->join('produk', 'pembelian_produk.id_produk = produk.id_produk')->where('id_pembelian', $id_pembelian)->find();
    // $pembayaran = $this->db->query("SELECT * FROM pembayaran WHERE id_pembelian = '" . $pembelian['id_pembelian'] . "'");
    $pembayaran = [];
    return view(
      'admin/penjualan/detail_penjualan_v',
      [
        'pembelian' => $pembelian,
        'produk' => $produk,
        'pembayaran' => $pembayaran,
      ]
    );
  }
}
