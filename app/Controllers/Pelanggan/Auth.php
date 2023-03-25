<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;

class auth extends BaseController
{

  public function login()
  {
    return view('pelanggan/auth/login');
  }

  public function register()
  {
    return view('pelanggan/auth/register');
  }
}
