<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PemasokM;
use App\Models\ProdukM;

class BarangMasuk extends BaseController
{

  private $produkM;
  private $pemasokM;

  public function __construct()
  {
    $this->produkM = new ProdukM();
    $this->pemasokM = new PemasokM();
  }

  public function index()
  {
    return view(
      'admin/barang_masuk/data_barang_masuk_view',
      [
        'data_pemasok' => $this->pemasokM->select('pemasok.*, produk.nama_produk, produk.id_produk')
          ->join('produk', 'pemasok.id_produk = produk.id_produk')
          ->findAll()
      ]
    );
  }

  public function form_tambah()
  {
    if ($this->request->is('post')) {
      if (!$this->validate([
        // pemasok
        'nama_pemasok' => [
          'label' => 'Nama Pemasok',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'harga_beli' => [
          'label' => 'Harga Beli',
          'rules' => 'required|min_length[3]|max_length[100]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 3 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        'jumlah_beli' => [
          'label' => 'Jumlah Beli',
          'rules' => 'required|min_length[1]|max_length[15]|numeric',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 15 Karakter',
            'numeric' => '{field} Harus angka',
          ],
        ],
        // Produk
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
        // 'stok' => [
        //   'label' => 'Stok',
        //   'rules' => 'required|min_length[1]|max_length[15]|numeric',
        //   'errors' => [
        //     'required' => '{field} Harus diisi',
        //     'min_length' => '{field} Minimal 1 Karakter',
        //     'max_length' => '{field} Maksimal 15 Karakter',
        //     'numeric' => '{field} Harus angka',
        //   ],
        // ],
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
          'rules' => 'required|min_length[4]|max_length[5000]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 5000 Karakter',
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
          'stok_produk' => $post['jumlah_beli'],
          'foto_produk' => $newFoto,
          'berat_produk' => $post['berat'],
          'deskripsi_produk' => $post['deskripsi']
        ];

        if ($this->produkM->save($data)) {
          $foto->move('img/produk/', $newFoto);
          $dataPemasok = [
            'nama_pemasok' => $post['nama_pemasok'],
            'harga_beli' => $post['harga_beli'],
            'jumlah_beli' => $post['jumlah_beli'],
            'id_produk' => $this->produkM->getInsertID(),
            'total' => $post['harga_beli'] * $post['jumlah_beli'],
          ];
          $this->pemasokM->save($dataPemasok);
          return redirect()->to(base_url() . '/admin/barang_masuk')->with('msg', myAlert('success', 'Berhasil ditambah'));
        }
      }
    }
    return view(
      'admin/barang_masuk/form_tambah_barang_masuk'
    );
  }

  public function form_edit($id)
  {
    $pemasok = $this->pemasokM->find($id);
    $produk = $this->produkM->find($pemasok['id_produk']);
    return view(
      'admin/barang_masuk/form_edit_barang_masuk',
      [
        'pemasok' => $pemasok,
        'produk' => $produk,
      ]
    );
  }

  public function delete_barang_masuk($id)
  {
    $dataPemasok = $this->pemasokM->find($id);
    if ($this->delete_produk($dataPemasok['id_produk'])) {
      $this->pemasokM->delete($id);
      return redirect()->to(base_url() . '/admin/barang_masuk')->with('msg', myAlert('success', 'Berhasil dihapus'));
    }
  }

  private function delete_produk($id)
  {

    $dataProduk = $this->produkM->find($id);

    $hapus = $this->produkM->delete($id);

    if ($hapus) {
      if (file_exists(FCPATH . '/img/produk/' . $dataProduk['foto_produk'])) {
        unlink(FCPATH . '/img/produk/' . $dataProduk['foto_produk']);
      }
      return true;
    } else {
      return false;
    }
  }
}
