<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DataServisM;

class ApiAdmin extends BaseController
{

  private $dataServisM;

  public function __construct()
  {
    $this->dataServisM = new DataServisM();
  }

  public function autocomplete_servis()
  {
    if ($this->request->isAjax()) {
      $post = $this->request->getPost();
      $nama = $post['q'];
      $limit = $post['limit'];

      $data = $this->dataServisM->select('nama_pelanggan, alamat_pelanggan')->like('nama_pelanggan', $nama)->limit($limit)->find();
      return $this->response->setJSON($data);
    }
  }
}
