<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminM;

class Auth extends BaseController
{

  private $adminM;

  public function __construct()
  {
    $this->adminM = new AdminM();
  }

  public function login()
  {
    if ($this->request->is('post')) {
      $post = $this->request->getPost();
      $adminCheck = $this->adminM->where(
        [
          'username' => $post['username'],
          'is_active' => 1
        ]
      )->first();
      if ($adminCheck) {
        // $passVerif = password_verify($post['password'],$adminCheck['password']);
        $passVerif = $post['password'] == $adminCheck['password'];
        if ($passVerif) {
          $userAdminSess['admin'] = [
            'id_admin' => $adminCheck['id_admin'],
            'nama' => $adminCheck['nama'],
            'foto' => $adminCheck['foto'],
            'role' => $adminCheck['role']
          ];

          session()->set($userAdminSess);
          return redirect()->to(base_url() . '/admin/dashboard');
        } else {
          $msg = 'Username/Password tidak cocok';
        }
      } else {
        $msg = 'Username tidak ditemukan';
      }
      return redirect()->back()->with('msg', myAlert('danger', $msg));
    }

    return view('admin/auth/login');
  }
}
