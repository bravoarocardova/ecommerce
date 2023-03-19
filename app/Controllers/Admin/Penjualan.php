<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Penjualan extends BaseController
{

  public function index()
  {
    return view('admin/penjualan/data_penjualan_view');
  }
}
