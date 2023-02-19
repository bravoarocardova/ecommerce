<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangServisM;
use App\Models\DataServisM;
use App\Models\JasaServisM;

class Admin extends BaseController
{

  public function dashboard()
  {
    return view('admin/dashboard');
  }
}
