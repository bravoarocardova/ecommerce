<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Libraries\RajaOngkir;
use App\Models\HomepageModel;
use App\Models\ProdukM;

class Produk extends BaseController
{

  private $homepageModel;
  private $produkM;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
    $this->produkM = new ProdukM();
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
    $p = [];
    foreach ($cart->contents() as $produk) {
      $find = $this->produkM->find($produk['id']);
      $p[] = [
        'id' => $find['id_produk'],
        'max' => $find['stok_produk']
      ];
    }
    $max_produk = $p;
    return view(
      'pelanggan/keranjang',
      [
        'cart' => $cart,
        'max_produk' => $max_produk,
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
      'price'   => $post['price'],
      'name'    => $post['name'],
      'options' => array('foto' => $post['foto'], 'berat' => $post['berat'], 'kondisi' => $post['kondisi']),
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
    $p = [];
    foreach ($cart->contents() as $produk) {
      $find = $this->produkM->find($produk['id']);
      $p[] = [
        'id' => $find['id_produk'],
        'max' => $find['stok_produk']
      ];
    }
    $max_produk = $p;
    return view(
      'pelanggan/checkout_v',
      [
        'cart' => $cart,
        'max_produk' => $max_produk,
        'produk_lain' => $this->produkM->orderBy('nama_produk', 'RANDOM')->findAll(8),
        'provinsi' => json_decode($provinsi)->rajaongkir->results,
      ]
    );
  }

  public function checkout_proses()
  {
    $post = $this->request->getPost();
    dd($post);
  }
}
