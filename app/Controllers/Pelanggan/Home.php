<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\BarangServisM;
use App\Models\DataServisM;
use App\Models\HomepageModel;
use App\Models\ServisM;

class Home extends BaseController
{

  private $homepageModel;
  private $dataServisM;
  private $barangServisM;
  private $servisM;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
    $this->barangServisM  = new BarangServisM();
    $this->dataServisM  = new DataServisM();
    $this->servisM  = new ServisM();
  }

  public function index()
  {
    return view(
      'pelanggan/home',
      [
        'banner' => $this->homepageModel->getBanner(),
        'info' => $this->homepageModel->getInfo(),
        'hari' => $this->homepageModel->getHari(),
      ]
    );
  }

  public function cekservis()
  {
    $noTransaksi = null;
    $detail_servis = [];
    $barang = [];
    if ($this->request->is('post')) {
      $noTransaksi = $this->request->getPost('no_transaksi');
      $detail_servis = $this->dataServisM->select('data_servis.*, admin.nama')->join('admin', 'data_servis.teknisi = admin.id_admin', 'LEFT')->find($noTransaksi);

      if ($detail_servis == null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Tidak ditemukan");
      }
      $barang_servis = $this->barangServisM->where('no_transaksi', $noTransaksi)->findAll();
      $barang = [];
      foreach ($barang_servis as $row) {
        $barang[] = [
          'kd_barang_servis' => $row['kd_barang_servis'],
          'no_transaksi' => $row['no_transaksi'],
          'nama_barang_servis' => $row['nama_barang_servis'],
          'kelengkapan' => $row['kelengkapan'],
          'kerusakan' => $row['kerusakan'],
          'servis' => $this->servisM->where('kd_barang_servis', $row['kd_barang_servis'])->join('jasa_servis', 'id_jasa_servis')->findAll()
        ];
      }
    }

    return view('pelanggan/cek_servis', [
      'no_transaksi' => $noTransaksi,
      'detail_servis' => $detail_servis,
      'barang_servis' => $barang,
    ]);
  }
}
