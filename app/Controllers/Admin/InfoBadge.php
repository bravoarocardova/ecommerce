<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataServisM;
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
}
