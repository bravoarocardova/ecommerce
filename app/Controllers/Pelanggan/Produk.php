<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
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
}
