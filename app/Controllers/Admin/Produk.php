<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukM;

class Produk extends BaseController
{

  private $produkM;

  public function __construct()
  {
    $this->produkM = new ProdukM();
  }

  public function index()
  {
    return view(
      'admin/produk/data_produk_view',
      [
        'data_produk' => $this->produkM->findAll()
      ]
    );
  }

  public function form_tambah()
  {
    if ($this->request->is('post')) {
      if (!$this->validate([
        'nama_produk' => [
          'label' => 'Nama Produk',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'harga_produk' => [
          'label' => 'Harga Produk',
          'rules' => 'required|min_length[3]|max_length[100]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 3 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'kondisi' => [
          'label' => 'Kondisi',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'stok' => [
          'label' => 'Stok',
          'rules' => 'required|min_length[1]|max_length[15]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 15 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'berat' => [
          'label' => 'Berat',
          'rules' => 'required|min_length[1]|max_length[100]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'deskripsi' => [
          'label' => 'Deskripsi',
          'rules' => 'required|min_length[4]|max_length[1000]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'foto_produk' => [
          'label' => 'Foto Produk',
          'rules' => 'uploaded[foto_produk]|mime_in[foto_produk,image/jpg,image/jpeg,image/png]|max_size[foto_produk,4096]',
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

        $foto = $this->request->getFile('foto_produk');
        $newFoto = $foto->getRandomName();

        $data = [
          'nama_produk' => $post['nama_produk'],
          'harga_produk' => $post['harga_produk'],
          'kondisi_produk' => $post['kondisi'],
          'stok_produk' => $post['stok'],
          'foto_produk' => $newFoto,
          'berat_produk' => $post['berat'],
          'deskripsi_produk' => $post['deskripsi']
        ];

        if ($this->produkM->save($data)) {
          $foto->move('img/produk/', $newFoto);
          return redirect()->to(base_url() . '/admin/produk')->with('msg', myAlert('success', 'Berhasil ditambah'));
        }
      }
    }
    return view(
      'admin/produk/form_tambah_produk'
    );
  }

  public function form_edit($id)
  {
    if ($this->request->is('put')) {

      $dataLama = $this->produkM->find($id);

      $foto = $this->request->getFile('foto_produk');
      if ($foto->isValid()) {
        $ruleFoto = 'uploaded[foto_produk]|mime_in[foto_produk,image/jpg,image/jpeg,image/png]|max_size[foto_produk,4096]';
      } else {
        $ruleFoto = 'mime_in[foto_produk,image/jpg,image/jpeg,image/png]|max_size[foto_produk,4096]';
      }

      if (!$this->validate([
        'nama_produk' => [
          'label' => 'Nama Produk',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'harga_produk' => [
          'label' => 'Harga Produk',
          'rules' => 'required|min_length[3]|max_length[100]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 3 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'kondisi' => [
          'label' => 'Kondisi',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'stok' => [
          'label' => 'Stok',
          'rules' => 'required|min_length[1]|max_length[15]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 15 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'berat' => [
          'label' => 'Berat',
          'rules' => 'required|min_length[1]|max_length[100]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'deskripsi' => [
          'label' => 'Deskripsi',
          'rules' => 'required|min_length[4]|max_length[1000]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'foto_produk' => [
          'label' => 'Foto Produk',
          'rules' => $ruleFoto,
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

        $foto = $this->request->getFile('foto_produk');
        $newFoto = $foto->getRandomName();

        $data = [
          'id_produk' => $id,
          'nama_produk' => $post['nama_produk'],
          'harga_produk' => $post['harga_produk'],
          'kondisi_produk' => $post['kondisi'],
          'stok_produk' => $post['stok'],
          'berat_produk' => $post['berat'],
          'deskripsi_produk' => $post['deskripsi']
        ];

        if ($foto->isValid()) {
          $newFoto = $foto->getRandomName();
          $data['foto_produk'] = $newFoto;
          $foto->move('img/produk/', $newFoto);

          if (file_exists(FCPATH . '/img/produk/' . $dataLama['foto_produk'])) {
            unlink(FCPATH . '/img/produk/' . $dataLama['foto_produk']);
          }
        }

        if ($this->produkM->save($data)) {
          return redirect()->to(base_url() . '/admin/produk')->with('msg', myAlert('success', 'Berhasil disimpan'));
        }
      }
    }
    return view(
      'admin/produk/form_edit_produk',
      [
        'data_produk' => $this->produkM->find($id)
      ]
    );
  }

  public function delete_produk($id)
  {

    $dataProduk = $this->produkM->find($id);

    $hapus = $this->produkM->delete($id);

    if ($hapus) {
      if (file_exists(FCPATH . '/img/produk/' . $dataProduk['foto_produk'])) {
        unlink(FCPATH . '/img/produk/' . $dataProduk['foto_produk']);
      }
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }
}
