<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataServisM;
use App\Models\PembelianM;
use CodeIgniter\API\ResponseTrait;

class InfoBadge extends BaseController
{

  use ResponseTrait;

  public function badgeDataServis()
  {
    $dataServis = new DataServisM();
    $count = [
      'jumlah' => $dataServis->where("status IS NULL OR status = 'menunggu konfirmasi' OR status = 'diproses'")->countAllResults()
    ];

    // return $this->response->setJSON($count);
    return $this->respond($count);
  }

  public function badgeDataPenjualan()
  {
    $dataPembelian = new PembelianM();
    $count = [
      'jumlah' => $dataPembelian->where("status_pembelian = 'Dikemas' OR status_pembelian = 'Dikirim'")->countAllResults()
    ];

    return $this->respond($count);
  }
}
