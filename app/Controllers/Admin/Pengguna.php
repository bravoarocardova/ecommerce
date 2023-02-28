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
          'password' => $post['password'],
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
}
