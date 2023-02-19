<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataServisM;
use App\Models\BarangServisM;

class DataServis extends BaseController
{

  private $dataServisM;
  private $barangServisM;

  public function __construct()
  {
    $this->dataServisM  = new DataServisM();
    $this->barangServisM  = new BarangServisM();
  }

  // Data Servis
  public function data_servis()
  {
    return view('admin/servis/data_servis_view', [
      'data_servis' => $this->dataServisM->findAll()
    ]);
  }

  public function tambah_data_servis()
  {
    if (!$this->validate([
      'no_transaksi' => [
        'label' => 'No Transaksi',
        'rules' => 'is_unique[data_servis.no_transaksi]'
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
      'alamat_pelanggan' => [
        'label' => 'Alamat Pelanggan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'no_telp_pelanggan' => [
        'label' => 'No Telpon Pelanggan',
        'rules' => 'required|numeric|min_length[4]|max_length[15]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
          'numeric' => '{field} Harus Angka'
        ],
      ],
    ])) {
      return redirect()->back()->withInput()->with('msg', myAlert('danger', 'Gagal simpan, cek ulang data'));
    } else {

      $post = $this->request->getPost();
      $data = [
        'no_transaksi' => createNoTransaksi('TSV', $this->dataServisM, 'no_transaksi'),
        'nama_pelanggan' => $post['nama_pelanggan'],
        'alamat_pelanggan' => $post['alamat_pelanggan'],
        'no_telp_pelanggan' => $post['no_telp_pelanggan']
      ];
      $simpan = $this->dataServisM->save($data);
      if ($simpan) {
        $type = 'success';
        $msg = 'Berhasil tambah data.';
      } else {
        $type = 'danger';
        $msg = 'Gagal tambah data.';
      }
      return redirect()->back()->with('msg', myAlert($type, $msg));
    }
  }

  public function delete_data_servis($kode = null)
  {
    if ($kode == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $hapus = $this->dataServisM->delete($kode);
    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }
  // End Data Servis

  // Barang Servis
  public function barang_data_servis($kode = null)
  {
    $detail_servis = $this->dataServisM->find($kode);

    if ($detail_servis == null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("Tidak ditemukan");
    }
    return view('admin/servis/barang_data_servis_view', [
      'detail_servis' => $detail_servis,
      'barang_servis' => $this->barangServisM->findAll()
    ]);
  }


  public function tambah_barang_servis($noTransaksi = null)
  {
    if (!$this->validate([
      'kd_barang_servis' => [
        'label' => 'Kode Barang',
        'rules' => 'is_unique[data_servis.no_transaksi]'
      ],
      'nama_barang_servis' => [
        'label' => 'Nama Barang Servis',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'kelengkapan' => [
        'label' => 'Kelengkapan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'kerusakan' => [
        'label' => 'Kerusakan',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'jumlah' => [
        'label' => 'Jumlah',
        'rules' => 'required|numeric|min_length[1]|max_length[15]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
          'numeric' => '{field} Harus Angka'
        ],
      ],
    ])) {
      return redirect()->back()->withInput()->with('msg', myAlert('danger', 'Gagal simpan, cek ulang data'));
    } else {
      $post = $this->request->getPost();
      $data = [
        'kd_barang_servis' => createNoTransaksi('KBS', $this->barangServisM, 'kd_barang_servis'),
        'no_transaksi' => $noTransaksi,
        'nama_barang_servis' => $post['nama_barang_servis'],
        'kelengkapan' => $post['kelengkapan'],
        'kerusakan' => $post['kerusakan'],
        'jumlah' => $post['jumlah']
      ];
      $simpan = $this->barangServisM->save($data);
      if ($simpan) {
        $type = 'success';
        $msg = 'Berhasil tambah data.';
      } else {
        $type = 'danger';
        $msg = 'Gagal tambah data.';
      }
      return redirect()->back()->with('msg', myAlert($type, $msg));
    }
  }

  public function delete_barang_servis($kode = null)
  {
    if ($kode == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $hapus = $this->barangServisM->delete($kode);
    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }

  public function update_barang_servis()
  {
    $post = $this->request->getPost();
    $data = [
      'kd_barang_servis' => $post['kd_barang_servis'],
      'nama_barang_servis' => $post['nama_barang_servis'],
      'kelengkapan' => $post['kelengkapan'],
      'kerusakan' => $post['kerusakan'],
      'jumlah' => $post['jumlah']
    ];

    $update = $this->barangServisM->save($data);
    if ($update) {
      $type = 'success';
      $msg = 'Berhasil diubah.';
    } else {
      $type = 'danger';
      $msg = 'Gagal diubah.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }
  // End Barang Servis

}
