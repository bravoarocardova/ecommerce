<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PartProdukM;

class PartProduk extends BaseController
{

  private $partProdukM;

  public function __construct()
  {
    $this->partProdukM  = new PartProdukM();
  }

  // jasa servis
  public function index()
  {
    return view('admin/part_produk/part_produk_view', [
      'part_produk' => $this->partProdukM->findAll()
    ]);
  }

  public function tambah_part_produk()
  {
    if (!$this->validate([
      'nama_part' => [
        'label' => 'Nama Part',
        'rules' => 'required|min_length[1]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 1 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'kategori' => [
        'label' => 'Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 2 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'biaya_part' => [
        'label' => 'Biaya Part',
        'rules' => 'required|min_length[2]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 2 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
    ])) {
      return redirect()->back()->withInput();
    } else {

      $post = $this->request->getPost();
      $data = [
        'nama_part' => $post['nama_part'],
        'kategori' => $post['kategori'],
        'biaya_part' => $post['biaya_part']
      ];
      $this->partProdukM->save($data);
      return redirect()->back()->with('msg', myAlert('success', 'Berhasil tambah data.'));
    }
  }

  public function delete_part_produk($id = null)
  {
    if ($id == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $hapus = $this->partProdukM->delete($id);
    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }

  public function update_part_produk()
  {
    $post = $this->request->getPost();
    $data = [
      'id_part_produk' => $post['id_part_produk'],
      'nama_part' => $post['nama_part'],
      'kategori' => $post['kategori'],
      'biaya_part' => $post['biaya_part']
    ];

    $update = $this->partProdukM->save($data);
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
