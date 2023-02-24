<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{

  public function login()
  {
    if ($this->request->is('post')) {
      return d($this->request->getPost());
    }

    return view('admin/auth/login');
  }
}
