<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Libraries\RajaOngkir;
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
    $rajaOngkir = new RajaOngkir();
    $provinsi = $rajaOngkir->rajaongkir('province');

    return view('pelanggan/auth/register', [
      'provinsi' => json_decode($provinsi)->rajaongkir->results,
    ]);
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
    if (!$this->validate([
      'username_pelanggan' => [
        'label' => 'Username Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]|is_unique[pelanggan.username_pelanggan]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
          'is_unique' => '{field} Sudah Dipakai',
        ],
      ],
      'nama_pelanggan' => [
        'label' => 'Nama Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'email_pelanggan' => [
        'label' => 'Email Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'telepon_pelanggan' => [
        'label' => 'Telepon Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]|numeric',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
          'numeric' => '{field} Harus angka',
        ],
      ],
      'provinsi' => [
        'label' => 'Provinsi',
        'rules' => 'required|min_length[1]|max_length[5]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 1 Karakter',
          'max_length' => '{field} Maksimal 5 Karakter',
        ],
      ],
      'kabkot' => [
        'label' => 'Kab/Kota',
        'rules' => 'required|min_length[1]|max_length[5]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 1 Karakter',
          'max_length' => '{field} Maksimal 5 Karakter',
        ],
      ],
      'alamat_pelanggan' => [
        'label' => 'Alamat Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'alamat_lengkap' => [
        'label' => 'Alamat Lengkap',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'password' => [
        'label' => 'Password',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'password_verify' => [
        'label' => 'Password Verify',
        'rules' => 'required|min_length[4]|max_length[100]|matches[password]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
          'matches' => '{field} tidak cocok'
        ],
      ],
    ])) {
      return redirect()->back()->withInput();
    } else {

      $post = $this->request->getPost();
      $data = [
        'username_pelanggan' => $post['username_pelanggan'],
        'email_pelanggan' => $post['email_pelanggan'],
        'password' => password_hash($post['password'], PASSWORD_DEFAULT),
        'nama_pelanggan' => $post['nama_pelanggan'],
        'telepon_pelanggan' => $post['telepon_pelanggan'],
        'id_province' => $post['provinsi'],
        'id_city' => $post['kabkot'],
        'alamat_pelanggan' => $post['alamat_lengkap'],
        'foto_pelanggan' => 'default.jpg',
        'is_active' => '1',
      ];

      $this->pelangganM->save($data);
      return redirect()->to(base_url() . '/auth/login')->with('msg', myAlert('success', 'Registrasi Berhasil, Silahkan login.'));
    }
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url() . '/');
  }
}
