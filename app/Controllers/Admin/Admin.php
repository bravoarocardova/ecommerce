<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianM;
use App\Models\DataServisM;
use App\Models\PembelianProdukM;
use App\Models\PromosiM;
use App\Models\SettingM;

class Admin extends BaseController
{

  private $pembelianM;
  private $dataServisM;
  private $pembelianProdukM;
  private $settingM;
  private $promosiM;

  public function __construct()
  {
    $this->pembelianM = new PembelianM();
    $this->dataServisM  = new DataServisM();
    $this->pembelianProdukM = new PembelianProdukM();
    $this->settingM = new SettingM();
    $this->promosiM = new PromosiM();
  }

  public function dashboard()
  {

    $getchartpendapatan = $this->pembelianM->select('YEAR(pembelian.`updated_at`) as year, MONTH(pembelian.`updated_at`) as month, SUM(total_pembelian) as pendapatan')
      ->where("YEAR(pembelian.`updated_at`) = '" . date('Y') . "' AND `status_pembelian` = 'Selesai'")
      ->groupBy('YEAR(pembelian.`updated_at`), MONTH(pembelian.`updated_at`)')
      ->orderBy('1,2')->find();

    $getchartterjual = $this->pembelianProdukM->select('YEAR(pembelian.`updated_at`) as year, MONTH(pembelian.`updated_at`) as month, SUM(jumlah) as terjual ')
      ->join('pembelian', 'pembelian_produk.id_pembelian = pembelian.id_pembelian')
      ->where("YEAR(pembelian_produk.`updated_at`) = '" . date('Y') . "' AND `status_pembelian` = 'Selesai'")
      ->groupBy('YEAR(pembelian.`updated_at`), MONTH(pembelian.`updated_at`)')
      ->orderBy('1,2')->find();


    $chartPendapatan = null;
    $chartTerjual = null;

    for ($i = 1; $i <= 12; $i++) {

      foreach ($getchartpendapatan as $g) {
        if ($g['month'] == $i) {
          $chartPendapatan[] = $g['pendapatan'];
        } else {
          $chartPendapatan[] = 0;
        }
      }

      foreach ($getchartterjual as $g) {
        if ($g['month'] == $i) {
          $chartTerjual[] = $g['terjual'];
        } else {
          $chartTerjual[] = 0;
        }
      }
    }

    return view(
      'admin/dashboard',
      [
        'pendapatan_penjualan' =>  $this->pembelianM->selectSum('total_pembelian', 'pendapatan')
          ->where(
            [
              'status_pembelian' => 'Selesai',
              'MONTH(updated_at)' => date('m'),
              'YEAR(updated_at)' => date('Y')
            ]
          )->first(),

        'penjualan_produk' => $this->pembelianProdukM->selectSum('jumlah')
          ->join('pembelian', 'pembelian_produk.id_pembelian = pembelian.id_pembelian')
          ->where(
            [
              'pembelian.status_pembelian' => 'Selesai',
              'MONTH(pembelian.updated_at)' => date('m'),
              'YEAR(pembelian.updated_at)' => date('Y')
            ]
          )->first(),

        'servis_masuk' => $this->dataServisM->select()
          ->where("status IS NULL OR `status` NOT IN ('selesai','dibatalkan')")->countAllResults(),

        'pendapatan_servis' => $this->dataServisM->selectSum('total_biaya')
          ->where(
            [
              'status' => 'selesai',
              'MONTH(updated_at)' => date('m'),
              'YEAR(updated_at)' => date('Y')
            ]
          )->first(),
        'chart_pendapatan' => $chartPendapatan,
        'chart_terjual' => $chartTerjual,
      ]
    );
  }

  public function setting_view()
  {

    if ($this->request->is('put')) {
      if (!$this->validate([
        'nama_aplikasi' => [
          'label' => 'Nama Aplikasi',
          'rules' => 'required|min_length[4]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 4 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'alamat' => [
          'label' => 'Alamat',
          'rules' => 'required|min_length[1]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'telepon' => [
          'label' => 'Telepon',
          'rules' => 'required|min_length[1]|max_length[15]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 15 Karakter',
          ],
        ],
        'email' => [
          'label' => 'Email',
          'rules' => 'required|min_length[1]|max_length[100]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
            'max_length' => '{field} Maksimal 100 Karakter',
          ],
        ],
        'lokasi' => [
          'label' => 'Lokasi',
          'rules' => 'required|min_length[1]',
          'errors' => [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} Minimal 1 Karakter',
          ],
        ],
      ])) {
        return redirect()->back()->withInput();
      } else {
        $post = $this->request->getPost();

        $data = [
          'id_setting' => $post['id_setting'],
          'nama_aplikasi' => $post['nama_aplikasi'],
          'alamat' => $post['alamat'],
          'telepon' => $post['telepon'],
          'email' => $post['email'],
          'lokasi' => $post['lokasi'],
        ];

        $simpan = $this->settingM->save($data);
        if ($simpan) {

          $type = 'success';
          $msg = 'Berhasil simpan data.';
        } else {
          $type = 'danger';
          $msg = 'Gagal simpan data.';
        }
        return redirect()->to(base_url() . '/admin/setting')->with('msg', myAlert($type, $msg));
      }
    }

    return view('admin/setting/setting_v', [
      'setting' => $this->settingM->find()[0]
    ]);
  }

  // Promosi
  public function data_promosi()
  {
    return view(
      'admin/promo/data_promo_view',
      [
        'data_promo' => $this->promosiM->findAll()
      ]
    );
  }

  public function proses_tambah_promosi()
  {
    $post = $this->request->getVar();
    if ($this->request->is('post')) {
      switch ($post['tipe']) {

        case 'gambar':
          if (!$this->validate([
            'gambar' => [
              'label' => 'Gambar',
              'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,4096]',
              'errors' => [
                'uploaded' => '{field} Harus ada yang diupload',
                'mime_in' => '{field} Harus [jpg, jpeg, png]',
                'max_size' => '{field} Maksimal 4mb'
              ],
            ],
          ])) {
            return redirect()->back()->withInput();
          } else {

            $gambar = $this->request->getFile('gambar');
            $newGambar = $gambar->getRandomName();


            $data = [
              'gambar' => $newGambar,
              'tipe_promosi' => 'gambar',
            ];

            if ($this->promosiM->save($data)) {
              $gambar->move('img/promosi/', $newGambar);
              return redirect()->to(base_url() . '/admin/promosi')->with('msg', myAlert('success', 'Berhasil ditambah'));
            }
          }
          break;

        case 'text':
          if (!$this->validate([
            'text' => [
              'label' => 'Text',
              'rules' => 'required|min_length[1]|max_length[100]',
              'errors' => [
                'required' => '{field} Harus diisi',
                'min_length' => '{field} Minimal 4 Karakter',
                'max_length' => '{field} Maksimal 100 Karakter',
              ],
            ],
          ])) {
            return redirect()->back()->withInput();
          } else {

            $data = [
              'text' => $post['text'],
              'tipe_promosi' => 'text',
            ];

            if ($this->promosiM->save($data)) {
              return redirect()->to(base_url() . '/admin/promosi')->with('msg', myAlert('success', 'Berhasil ditambah'));
            }
          }
          break;
        default:
          return;
      }
    }
    return redirect()->back();
  }

  public function delete_promosi($id)
  {

    $dataPromosi = $this->promosiM->find($id);

    $hapus = $this->promosiM->delete($id);

    if ($hapus) {
      if ($dataPromosi['tipe_promosi'] == 'gambar') {
        if (file_exists(FCPATH . '/img/promosi/' . $dataPromosi['gambar'])) {
          unlink(FCPATH . '/img/promosi/' . $dataPromosi['gambar']);
        }
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
