<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminM;

class Pengguna extends BaseController
{

  private $adminM;

  public function __construct()
  {
    $this->adminM = new AdminM();
  }

  public function index()
  {

    return view(
      'admin/pengguna/data_pengguna_view',
      [
        'pengguna_admin' => $this->adminM->findAll()
      ]
    );
  }

  public function set_status($id)
  {
    $pengguna = $this->adminM->find($id);
    $data['id_admin'] = $id;
    if ($pengguna['is_active'] == 0) {
      $data['is_active'] = 1;
    } else {
      $data['is_active'] = 0;
    }
    $this->adminM->save($data);

    return redirect()->back();
  }

  public function profile($id = null)
  {
    if ($id == null) {
      $id = session()->get('admin')['id_admin'];
    }

    return view(
      'admin/pengguna/profile_view',
      [
        'profile_admin' => $this->adminM->find($id)
      ]
    );
  }
}
