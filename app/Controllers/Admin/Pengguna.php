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

    $profile = $this->adminM->find($id);

    if ($profile == null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
    }

    return view(
      'admin/pengguna/profile_view',
      [
        'profile_admin' => $profile
      ]
    );
  }

  public function tambah_pengguna()
  {
    if ($this->request->is('post')) {
      if (!$this->validate([
        'username' => [
          'label' => 'Username',
          'rules' => 'required|min_length[4]|max_length[100]|is_unique[admin.username]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'is_unique' => '{field} Sudah Dipakai'
          ],
        ],
        'nama' => [
          'label' => 'Nama',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'email' => [
          'label' => 'Email',
          'rules' => 'required|min_length[4]|max_length[100]|valid_email',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'valid_email' => '{field} tidak valid'
          ],
        ],
        'no_telp' => [
          'label' => 'No Telp',
          'rules' => 'required|min_length[4]|max_length[15]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 15 Karakter',
            'numeric' => '{field} Harus angka'
          ],
        ],
        'role' => [
          'label' => 'Role',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'status' => [
          'label' => 'Status',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Harus diisi'
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
        'foto' => [
          'label' => 'Foto',
          'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]',
          'errors' => [
            'uploaded' => '{field} Harus ada yang diupload',
            'mime_in' => '{field} Harus [jpg, jpeg, png]',
            'max_size' => '{field} Maksimal 4mb'
          ],
        ],
      ])) {
        return redirect()->back()->withInput();
      } else {
        $post = $this->request->getVar();

        $foto = $this->request->getFile('foto');
        $newFoto = $foto->getRandomName();

        $data = [
          'username' => $post['username'],
          'nama' => $post['nama'],
          'email' => $post['email'],
          'no_telp' => $post['no_telp'],
          'password' => password_hash($post['password'], PASSWORD_DEFAULT),
          'foto' => $newFoto,
          'role' => $post['role'],
          'is_active' => $post['status']
        ];

        if ($this->adminM->save($data)) {
          $foto->move('img/avatars/', $newFoto);
          return redirect()->to(base_url() . '/admin/pengguna')->with('msg', myAlert('success', 'Berhasil ditambah'));
        }
      }
    }
    return view('admin/pengguna/tambah_pengguna_view');
  }

  public function delete_pengguna_admin($id)
  {
    if ($id == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $dataAdmin = $this->adminM->find($id);
    if ($dataAdmin['foto'] != 'default.jpg') {
      unlink(base_url() . '/img/avatars/' . $dataAdmin['foto']);
    }
    $hapus = $this->adminM->delete($id);
    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }

  public function edit_profile()
  {
    $post = $this->request->getVar();

    if (empty($post['id_admin'])) {
      $id_admin = session()->get('admin')['id_admin'];
    } else {
      $id_admin = $post['id_admin'];
    }
    $dataLama = $this->adminM->find($id_admin);

    switch ($post['edit']) {
      case 'profil':
        if ($dataLama['username'] != $post['username']) {
          $roleUsername = 'required|min_length[4]|max_length[100]|is_unique[admin.username]';
        } else {
          $roleUsername = 'required|min_length[4]|max_length[100]';
        }

        $ruleFoto = 'mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]';
        $foto = $this->request->getFile('foto');
        if ($foto->isValid()) {
          $ruleFoto = 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]';
        }

        $ruleProfil = [
          'username' => [
            'label' => 'Username',
            'rules' => $roleUsername,
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
              'is_unique' => '{field} Sudah Dipakai'
            ],
          ],
          'nama' => [
            'label' => 'Nama',
            'rules' => 'required|min_length[4]|max_length[100]',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
            ],
          ],
          'email' => [
            'label' => 'Email',
            'rules' => 'required|min_length[4]|max_length[100]|valid_email',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
              'valid_email' => '{field} tidak valid'
            ],
          ],
          'no_telp' => [
            'label' => 'No Telp',
            'rules' => 'required|min_length[4]|max_length[15]|numeric',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 15 Karakter',
              'numeric' => '{field} Harus angka'
            ],
          ],
          'foto' => [
            'label' => 'Foto',
            'rules' => $ruleFoto,
            'errors' => [
              'uploaded' => '{field} Harus ada yang diupload',
              'mime_in' => '{field} Harus [jpg, jpeg, png]',
              'max_size' => '{field} Maksimal 4mb'
            ],
          ],
        ];
        if (!$this->validate($ruleProfil)) {
          $type = 'danger';
          $msg = 'Gagal update profil!.';
        } else {
          $data = [
            'id_admin' => $id_admin,
            'username' => $post['username'],
            'nama' => $post['nama'],
            'email' => $post['email'],
            'no_telp' => $post['no_telp'],
            'role' => $post['role'] ?? $dataLama['role'],
            'is_active' => $post['status'] ?? $dataLama['is_active']
          ];

          if ($foto->isValid()) {
            $newFoto = $foto->getRandomName();
            $data['foto'] = $newFoto;
            $foto->move('img/avatars/', $newFoto);

            if ($dataLama['foto'] != 'default.jpg') {
              unlink(base_url() . '/img/avatars/' . $dataLama['foto']);
            }
          }

          $this->adminM->save($data);
          $type = 'success';
          $msg = 'Berhasil update profil!.';
          if (session()->get('admin')['id_admin'] == $id_admin) {
            $newSession['admin'] = [
              'id_admin' => session()->get('admin')['id_admin'],
              'nama' => $data['nama'],
              'foto' => $data['foto'] ?? $dataLama['foto'],
              'role' => $dataLama['role'],
              'isLoggedIn' => TRUE
            ];
            session()->set($newSession);
          }
        }
        break;
      case 'password':
        $rulePassword = [
          'new_password' => [
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
            'rules' => 'required|min_length[4]|max_length[100]|matches[new_password]',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
              'matches' => '{field} tidak cocok'
            ],
          ],
        ];

        if (!$this->validate($rulePassword)) {
          $type = 'danger';
          $msg = 'Gagal update password!.';
        } else {
          if (!password_verify($post['old_password'], $dataLama['password'])) {
            session()->setFlashdata('_ci_validation_errors', [
              'old_password' => 'Password Tidak cocok'
            ]);
            $type = 'danger';
            $msg = 'Gagal update password!.';
          } else {
            $data = [
              'id_admin' => $id_admin,
              'password' => password_hash($post['new_password'], PASSWORD_DEFAULT),
            ];
            $this->adminM->save($data);
            $type = 'success';
            $msg = 'Berhasil update password!.';
          }
        }
        break;
      default:
        $type = 'danger';
        $msg = 'Gagal update!.';
    }
    return redirect()->back()->withInput()->with('msg', myAlert($type, $msg));
  }
}
