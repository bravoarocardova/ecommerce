<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\HomepageModel;
use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;

class Pembelian extends BaseController
{
  private $homepageModel;
  private $produkM;
  private $pembelianM;
  private $pembelianProdukM;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
    $this->produkM = new ProdukM();
    $this->pembelianM = new PembelianM();
    $this->pembelianProdukM = new PembelianProdukM();
  }

  // public function index()
  // {
  //   if ($this->request->getGet('cari')) {
  //     $produk = $this->produkM->like('nama_produk', $this->request->getGet('cari'), 'both')->findAll();
  //   } else {
  //     $produk = $this->produkM->findAll();
  //   }

  //   return view(
  //     'pelanggan/produk/data_produk',
  //     [
  //       'produk' => $produk,
  //       'pencarian' => $this->request->getGet('cari') ?? 'Produk'
  //     ]
  //   );
  // }

  public function pembelian()
  {
    $id_pelanggan = session()->get('pelanggan')['id_pelanggan'];
    $select = 'pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan';
    $join = ['table' => 'pelanggan', 'cond' => 'pembelian.id_pelanggan = pelanggan.id_pelanggan'];

    $belum_bayar = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'Belum Bayar',
    ])->find();

    return view(
      'pelanggan/pembelian/pembelian_view',
      [
        'belum_bayar' => $belum_bayar
      ]
    );
  }

  public function detail_pembelian($id_pembelian)
  {
    $pembelian = $this->pembelianM->select('pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan')->join('pelanggan', 'pembelian.id_pelanggan = pelanggan.id_pelanggan')->find($id_pembelian);

    if ($pembelian['id_pelanggan'] != session()->get('pelanggan')['id_pelanggan']) {
      return redirect()->back();
    }

    $produk = $this->pembelianProdukM->join('produk', 'pembelian_produk.id_produk = produk.id_produk')->where('id_pembelian', $id_pembelian)->find();
    // $pembayaran = $this->db->query("SELECT * FROM pembayaran WHERE id_pembelian = '" . $pembelian['id_pembelian'] . "'");
    $pembayaran = [];
    return view(
      'pelanggan/detail_pembelian_v',
      [
        'pembelian' => $pembelian,
        'produk' => $produk,
        'pembayaran' => $pembayaran,
      ]
    );
  }
}
