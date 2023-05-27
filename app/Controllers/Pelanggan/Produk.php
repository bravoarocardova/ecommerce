<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Libraries\RajaOngkir;
use App\Models\HomepageModel;
use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;

class Produk extends BaseController
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

  public function index()
  {
    if ($this->request->getGet('cari')) {
      $produk = $this->produkM->like('nama_produk', $this->request->getGet('cari'), 'both')->findAll();
    } else {
      $produk = $this->produkM->findAll();
    }

    return view(
      'pelanggan/produk/data_produk',
      [
        'produk' => $produk,
        'pencarian' => $this->request->getGet('cari') ?? 'Produk'
      ]
    );
  }

  public function detail_produk($id)
  {
    $produk = $this->produkM->find($id);
    if (!$produk) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException($id . ' Tidak Ditemukan');
    }
    return view(
      'pelanggan/produk/detail_produk',
      [
        'produk' => $produk,
        'produk_lain' => $this->produkM->orderBy('nama_produk', 'RANDOM')->findAll(8)
      ]
    );
  }

  public function keranjang()
  {
    $cart = \Config\Services::cart();

    $cart_pr = [];
    foreach ($cart->contents() as $i => $produk) {
      $produk['detail'] = $this->produkM->find($produk['id']);
      $cart_pr[$i] = $produk;
    }

    return view(
      'pelanggan/keranjang',
      [
        'cart' => $cart_pr,
        'produk_lain' => $this->produkM->orderBy('nama_produk', 'RANDOM')->findAll(8)
      ]
    );
  }

  public function tambah_keranjang()
  {
    $cart = \Config\Services::cart();

    $post = $this->request->getPost();

    // Insert an array of values
    $cart->insert(array(
      'id'      => $post['id'],
      'qty'     => $post['qty'],
      'price'   => 0,
      'name'    => "cartItem",
      // 'options' => array('foto' => $post['foto'], 'berat' => $post['berat'], 'kondisi' => $post['kondisi']),
    ));

    return redirect()->back()->with('msg', myAlert('success', 'Berhasil ditambahkan ke keranjang.'));
  }

  public function update_keranjang()
  {
    $cart = \Config\Services::cart();

    $post = $this->request->getPost();
    foreach ($post['qty'] as $index => $value) {
      $cart->update(array(
        'rowid'      => $index,
        'qty'     => $value,
      ));
    }

    return redirect()->back()->with('msg', myAlert('success', 'Berhasil update data keranjang.'));
  }

  public function hapus_keranjang($rowid)
  {
    $cart = \Config\Services::cart();

    $cart->remove($rowid);

    return redirect()->back()->with('msg', myAlert('success', 'Berhasil dihapus dari keranjang.'));
  }

  // Checkout
  public function checkout_info()
  {
    $rajaOngkir = new RajaOngkir();
    $provinsi = $rajaOngkir->rajaongkir('province');

    $cart = \Config\Services::cart();

    $cart_pr = [];
    foreach ($cart->contents() as $i => $produk) {
      $produk['detail'] = $this->produkM->find($produk['id']);
      $cart_pr[$i] = $produk;
    }

    return view(
      'pelanggan/pembelian/checkout_v',
      [
        'cart' => $cart_pr,
        'produk_lain' => $this->produkM->orderBy('nama_produk', 'RANDOM')->findAll(8),
        'provinsi' => json_decode($provinsi)->rajaongkir->results,
      ]
    );
  }

  public function checkout_proses()
  {
    $post = $this->request->getPost();
    $cart = \Config\Services::cart();

    $id_pembelian = createNoTransaksi('PBR', $this->pembelianM, 'id_pembelian');

    $cart_pr = [];
    foreach ($cart->contents() as $i => $produk) {
      $produk['detail'] = $this->produkM->find($produk['id']);
      $cart_pr[$i] = $produk;
    }

    $cartItem = [];
    $total_berat = 0;
    $total = 0;
    foreach ($cart_pr as $cp) {
      $total_berat += $cp['detail']['berat_produk'] * $cp['qty'];
      $subtotal = 0;

      if ($cp['detail']['diskon'] != 0) {
        $harga = ($cp['detail']['harga_produk'] - ($cp['detail']['harga_produk'] * ($cp['detail']['diskon'] / 100)));
      } else {
        $harga = $cp['detail']['harga_produk'];
      }

      $subtotal = $harga * $cp['qty'];
      $total += $subtotal;

      $cartItem[] = [
        'id_pembelian' => $id_pembelian,
        'id_produk' => $cp['id'],
        'jumlah' => $cp['qty'],
        'subtotal' => $subtotal,
      ];
    }

    $data = [
      'id_pembelian' => $id_pembelian,
      'id_pelanggan' => session()->get('pelanggan')['id_pelanggan'],
      'ekspedisi' => $post['ekspedisi'],
      'total_berat' => $total_berat,
      'tujuan' => $post['tujuan'],
      'ongkir' => $post['ongkir'],
      'total_pembelian' => $total,
      'status_pembelian' => 'Belum Bayar',
    ];

    if ($this->pembelianM->save($data)) {
      if ($this->pembelianProdukM->insertBatch($cartItem)) {
        $cart->destroy();
      }
    }

    return redirect()->to(base_url() . '/pembelian/' . $id_pembelian);
  }
}
