<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Libraries\RajaOngkir;
use App\Models\BarangServisM;
use App\Models\DataServisM;
use App\Models\HomepageModel;
use App\Models\JasaServisM;
use App\Models\PartProdukM;
use App\Models\PelangganM;
use App\Models\PromosiM;
use App\Models\ServisM;
use App\Models\SettingM;
use App\Models\PartServisM;

class Home extends BaseController
{

  private $homepageModel;
  private $dataServisM;
  private $barangServisM;
  private $servisM;
  private $pelangganM;
  private $settingM;
  private $promosiM;
  private $partServisM;
  private $partProdukM;
  private $jasaServisM;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
    $this->barangServisM  = new BarangServisM();
    $this->dataServisM  = new DataServisM();
    $this->servisM  = new ServisM();
    $this->pelangganM = new PelangganM();
    $this->settingM = new SettingM();
    $this->promosiM = new PromosiM();
    $this->partServisM = new PartServisM();
    $this->jasaServisM  = new JasaServisM();
    $this->partProdukM  = new PartProdukM();
  }

  public function index()
  {
    $promosi_text = $this->promosiM->where('tipe_promosi', 'text')->find();
    $text = [];
    foreach ($promosi_text as $pt) {
      $text[] = $pt['text'];
    }

    return view(
      'pelanggan/home',
      [
        'promosi_gambar' => $this->promosiM->where('tipe_promosi', 'gambar')->find(),
        'promosi_text' => $text,
        'info' => $this->settingM->find()[0],
        'hari' => $this->homepageModel->getHari(),
      ]
    );
  }

  public function cekservis()
  {
    $noTransaksi = $this->request->getGet('no_transaksi');
    $detail_servis = [];
    $barang = [];
    if ($noTransaksi != null) {
      $detail_servis = $this->dataServisM->select('data_servis.*, admin.nama')->join('admin', 'data_servis.teknisi = admin.id_admin', 'LEFT')->find($noTransaksi);

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
          'servis' => $this->servisM->where('kd_barang_servis', $row['kd_barang_servis'])->join('jasa_servis', 'id_jasa_servis')->findAll(),
          'part' => $this->partServisM->where('kd_barang_servis', $row['kd_barang_servis'])->join('part_produk', 'id_part_produk')->findAll(),
        ];
      }
    }

    return view('pelanggan/cek_servis', [
      'no_transaksi' => $noTransaksi,
      'detail_servis' => $detail_servis,
      'barang_servis' => $barang,
    ]);
  }

  public function biaya_servis()
  {
    return view(
      'pelanggan/biaya_servis',
      [
        'jasa_servis' => $this->jasaServisM->findAll(),
        'part_produk' => $this->partProdukM->findAll()
      ]
    );
  }

  public function profile()
  {
    $rajaOngkir = new RajaOngkir();
    $provinsi = $rajaOngkir->rajaongkir('province');

    $id = session()->get('pelanggan')['id_pelanggan'];
    $profile = $this->pelangganM->find($id);

    if ($profile == null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak Ditemukan');
    }

    return view(
      'pelanggan/profile_view',
      [
        'profile' => $profile,
        'provinsi' => json_decode($provinsi)->rajaongkir->results,
      ]
    );
  }

  public function edit_profile()
  {
    $post = $this->request->getVar();

    $id_pelanggan = session()->get('pelanggan')['id_pelanggan'];
    $dataLama = $this->pelangganM->find($id_pelanggan);

    switch ($post['edit']) {
      case 'profil':
        if ($dataLama['username_pelanggan'] != $post['username_pelanggan']) {
          $roleUsername = 'required|min_length[4]|max_length[100]|is_unique[pelanggan.username_pelanggan]';
        } else {
          $roleUsername = 'required|min_length[4]|max_length[100]';
        }

        $ruleFoto = 'mime_in[foto_pelanggan,image/jpg,image/jpeg,image/png]|max_size[foto_pelanggan,4096]';
        $foto = $this->request->getFile('foto_pelanggan');
        if ($foto->isValid()) {
          $ruleFoto = 'uploaded[foto_pelanggan]|mime_in[foto_pelanggan,image/jpg,image/jpeg,image/png]|max_size[foto_pelanggan,4096]';
        }

        $ruleProfil = [
          'username_pelanggan' => [
            'label' => 'Username Pelanggan',
            'rules' => $roleUsername,
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
              'is_unique' => '{field} Sudah Dipakai'
            ],
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
          'email_pelanggan' => [
            'label' => 'Email Pelanggan',
            'rules' => 'required|min_length[4]|max_length[100]|valid_email',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
              'valid_email' => '{field} tidak valid'
            ],
          ],
          'telepon_pelanggan' => [
            'label' => 'No Telp Pelanggan',
            'rules' => 'required|min_length[4]|max_length[15]|numeric',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 15 Karakter',
              'numeric' => '{field} Harus angka'
            ],
          ],
          'foto_pelanggan' => [
            'label' => 'Foto Pelanggan',
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
            'id_pelanggan' => $id_pelanggan,
            'username_pelanggan' => $post['username_pelanggan'],
            'nama_pelanggan' => $post['nama_pelanggan'],
            'email_pelanggan' => $post['email_pelanggan'],
            'telepon_pelanggan' => $post['telepon_pelanggan'],
          ];

          if ($foto->isValid()) {
            $newFoto = $foto->getRandomName();
            $data['foto_pelanggan'] = $newFoto;
            $foto->move('img/avatars/', $newFoto);

            if ($dataLama['foto_pelanggan'] != 'default.jpg') {
              unlink(FCPATH . '/img/avatars/' . $dataLama['foto_pelanggan']);
            }
          }

          $this->pelangganM->save($data);
          $type = 'success';
          $msg = 'Berhasil update profil!.';
          if (session()->get('pelanggan')['id_pelanggan'] == $id_pelanggan) {
            $newSession['pelanggan'] = [
              'id_pelanggan' => session()->get('pelanggan')['id_pelanggan'],
              'nama' => $data['nama_pelanggan'],
              'foto' => $data['foto_pelanggan'] ?? $dataLama['foto_pelanggan'],
              'role' => 'pelanggan',
              'isLoggedIn' => TRUE
            ];
            session()->set($newSession);
          }
        }
        break;
      case 'alamat':
        $ruleAlamat = [
          'provinsi' => [
            'label' => 'Provinsi',
            'rules' => 'required|min_length[1]|max_length[5]',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 1 Karakter',
              'max_length' => '{field} Maksimal 5 Karakter',
            ],
          ],
          'kabkot' => [
            'label' => 'Kab/Kota',
            'rules' => 'required|min_length[1]|max_length[5]',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 1 Karakter',
              'max_length' => '{field} Maksimal 5 Karakter',
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
          'alamat_lengkap2' => [
            'label' => 'Alamat Lengkap',
            'rules' => 'required|min_length[4]|max_length[100]',
            'errors' => [
              'required' => '{field} Harus diisi',
              'min_length' => '{field} Minimal 4 Karakter',
              'max_length' => '{field} Maksimal 100 Karakter',
            ],
          ],
        ];

        if (!$this->validate($ruleAlamat)) {
          $type = 'danger';
          $msg = 'Gagal update alamat!.';
        } else {

          $data = [
            'id_pelanggan' => session()->get('pelanggan')['id_pelanggan'],
            'id_province' => $post['provinsi'],
            'id_city' => $post['kabkot'],
            'alamat_pelanggan' => $post['alamat_lengkap2']
          ];
          $this->pelangganM->save($data);
          $type = 'success';
          $msg = 'Berhasil update alamat!.';
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
              'id_pelanggan' => $id_pelanggan,
              'password' => password_hash($post['new_password'], PASSWORD_DEFAULT),
            ];
            $this->pelangganM->save($data);
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
