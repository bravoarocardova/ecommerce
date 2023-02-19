<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JasaServisM;

class JasaServis extends BaseController
{

  private $jasaServisM;

  public function __construct()
  {
    $this->jasaServisM  = new JasaServisM();
  }

  // jasa servis
  public function jasa_servis()
  {
    return view('admin/jasa_servis/jasa_servis_view', [
      'jasa_servis' => $this->jasaServisM->findAll()
    ]);
  }

  public function tambah_jasa_servis()
  {
    if (!$this->validate([
      'nama_jasa' => [
        'label' => 'Nama Jasa',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'kategori' => [
        'label' => 'Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'biaya_jasa' => [
        'label' => 'Biaya Jasa',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
    ])) {
      return redirect()->back()->withInput();
    } else {

      $post = $this->request->getPost();
      $data = [
        'nama_jasa' => $post['nama_jasa'],
        'kategori' => $post['kategori'],
        'biaya_jasa' => $post['biaya_jasa']
      ];
      $this->jasaServisM->save($data);
      return redirect()->back()->with('msg', myAlert('success', 'Berhasil tambah data.'));
    }
  }

  public function delete_jasa_servis($id = null)
  {
    if ($id == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $hapus = $this->jasaServisM->delete($id);
    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }

  public function update_jasa_servis()
  {
    $post = $this->request->getPost();
    $data = [
      'id_jasa_servis' => $post['id_jasa_servis'],
      'nama_jasa' => $post['nama_jasa'],
      'kategori' => $post['kategori'],
      'biaya_jasa' => $post['biaya_jasa']
    ];

    $update = $this->jasaServisM->save($data);
    if ($update) {
      $type = 'success';
      $msg = 'Berhasil diubah.';
    } else {
      $type = 'danger';
      $msg = 'Gagal diubah.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }

  // end jasa servis
}
