<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataServisM;
use App\Models\BarangServisM;
use App\Models\JasaServisM;
use App\Models\ServisM;

class DataServis extends BaseController
{

  private $dataServisM;
  private $barangServisM;
  private $servisM;
  public function __construct()
  {
    $this->dataServisM  = new DataServisM();
    $this->barangServisM  = new BarangServisM();
    $this->servisM  = new ServisM();
  }

  // Data Servis
  public function data_servis($noTransaksi = null)
  {

    if ($noTransaksi != null) {
      $detail_servis = $this->dataServisM->find($noTransaksi);

      if ($detail_servis == null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Tidak ditemukan");
      }
      $barang_servis = $this->barangServisM->where('no_transaksi', $noTransaksi)->findAll();
      $barang = [];
      foreach ($barang_servis as $row) {
        $barang[] = [
          'kd_barang_servis' => $row['kd_barang_servis'],
          'no_transaksi' => $row['no_transaksi'],
          'nama_barang_servis' => $row['nama_barang_servis'],
          'kelengkapan' => $row['kelengkapan'],
          'kerusakan' => $row['kerusakan'],
          'servis' => $this->servisM->where('kd_barang_servis', $row['kd_barang_servis'])->join('jasa_servis', 'id_jasa_servis')->findAll()
        ];
      }
      $jasaServisM  = new JasaServisM();
      return view('admin/servis/servis_view', [
        'detail_servis' => $detail_servis,
        'barang_servis' => $barang,
        'jasa_servis' => $jasaServisM->findAll()
      ]);
    }

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
        'no_telp_pelanggan' => '62' . $post['no_telp_pelanggan']
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
  public function barang_data_servis($noTransaksi = null)
  {
    $detail_servis = $this->dataServisM->find($noTransaksi);

    if ($detail_servis == null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("Tidak ditemukan");
    }
    return view('admin/servis/barang_data_servis_view', [
      'detail_servis' => $detail_servis,
      'barang_servis' => $this->barangServisM->where('no_transaksi', $noTransaksi)->findAll()
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
      ]
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

  // Servis
  public function tambah_servis_barang()
  {
    if (!$this->validate([
      'id_servis' => [
        'label' => 'Servis',
        'rules' => 'required|min_length[1]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'biaya_servis' => [
        'label' => 'Biaya Servis',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],

      ],
    ])) {
      return redirect()->back()->withInput()->with('msg', myAlert('danger', 'Gagal simpan, cek ulang data'));
    } else {

      $post = $this->request->getPost();
      $data = [
        'kd_barang_servis' => $post['kd_barang_servis'],
        'id_jasa_servis' => $post['id_servis'],
        'biaya_servis' => $post['biaya_servis']
      ];

      if (empty($this->servisM->where($data)->find())) {
        $simpan = $this->servisM->save($data);
        if ($simpan) {
          $type = 'success';
          $msg = 'Berhasil tambah data.';
        } else {
          $type = 'danger';
          $msg = 'Gagal tambah data.';
        }
      } else {
        $type = 'danger';
        $msg = 'Sudah ditambahkan.';
      }
      return redirect()->back()->with('msg', myAlert($type, $msg));
    }
  }

  public function delete_servis_barang($kd_barang = null, $id_jasa = null)
  {
    if ($kd_barang == null && $id_jasa == null) {
      // throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
      return redirect()->back();
    }
    $hapus = $this->servisM->where([
      'kd_barang_servis' => $kd_barang,
      'id_jasa_servis' => $id_jasa
    ])->delete();

    if ($hapus) {
      $type = 'success';
      $msg = 'Berhasil dihapus.';
    } else {
      $type = 'danger';
      $msg = 'Gagal dihapus.';
    }
    return redirect()->back()->with('msg', myAlert($type, $msg));
  }
  // End Servis

}
