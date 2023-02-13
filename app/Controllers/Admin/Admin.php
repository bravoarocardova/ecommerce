<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JasaServisM;

class Admin extends BaseController
{
  protected $helpers = ['form'];

  public function dashboard()
  {
    return view('admin/dashboard');
  }

  // jasa servis
  public function jasa_servis()
  {
    $jasaServisM  = new JasaServisM();

    return view('admin/jasa_servis/jasa_servis_view', [
      'jasa_servis' => $jasaServisM->findAll()
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
      $jasaServisM  = new JasaServisM();
      $post = $this->request->getPost();
      $data = [
        'nama_jasa' => $post['nama_jasa'],
        'kategori' => $post['kategori'],
        'biaya_jasa' => $post['biaya_jasa']
      ];
      $jasaServisM->save($data);
      return redirect()->to(base_url('/admin/jasa_servis'))->with('msg', 'Berhasil tambah data.');
    }
  }
  // end jasa servis


}
