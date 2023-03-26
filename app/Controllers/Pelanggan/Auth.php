<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PelangganM;

class auth extends BaseController
{

  private $pelangganM;

  public function __construct()
  {
    $this->pelangganM = new PelangganM();
  }

  public function login()
  {
    return view('pelanggan/auth/login');
  }

  public function register()
  {
    return view('pelanggan/auth/register');
  }

  public function proses_login()
  {
    $post = $this->request->getPost();
    $pelangganCheck = $this->pelangganM->where(
      [
        'username_pelanggan' => $post['username_pelanggan'],
        'is_active' => '1'
      ]
    )->first();
    if ($pelangganCheck) {
      $passVerif = password_verify($post['password'], $pelangganCheck['password']);
      // $passVerif = $post['password'] == $pelangganCheck['password'];
      if ($passVerif) {
        $userPelanggan['pelanggan'] = [
          'id_pelanggan' => $pelangganCheck['id_pelanggan'],
          'nama' => $pelangganCheck['nama_pelanggan'],
          'foto' => $pelangganCheck['foto_pelanggan'],
          'role' => 'pelanggan',
          'isLoggedIn' => TRUE
        ];

        session()->set($userPelanggan);
        return redirect()->to(base_url() . '/');
      } else {
        $msg = 'Username/Password tidak cocok';
      }
    } else {
      $msg = 'Username tidak ditemukan';
    }
    return redirect()->back()->with('msg', myAlert('danger', $msg));
  }

  public function proses_register()
  {
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url() . '/');
  }
}
