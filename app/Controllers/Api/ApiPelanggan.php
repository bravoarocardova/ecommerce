<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PembelianM;

class ApiPelanggan extends BaseController
{

  private $pembelianM;

  public function __construct()
  {
    $this->pembelianM = new PembelianM();
  }

  public function getCountPesanan()
  {
    if ($this->request->isAjax()) {
      $id_pelanggan = session()->get('pelanggan')['id_pelanggan'];
      $where = "id_pelanggan = '$id_pelanggan' AND (status_pembelian = 'Belum Bayar' OR status_pembelian = 'Menunggu Konfirmasi')";
      $data = $this->pembelianM->where($where)->countAllResults();
      return $this->response->setJSON($data);
    }
  }
}
