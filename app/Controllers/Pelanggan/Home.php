<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\HomepageModel;

class Home extends BaseController
{

  private $homepageModel;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
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
}
