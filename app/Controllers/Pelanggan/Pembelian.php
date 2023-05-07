<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\HomepageModel;
use App\Models\PembayaranM;
use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;

class Pembelian extends BaseController
{
  private $homepageModel;
  private $produkM;
  private $pembelianM;
  private $pembelianProdukM;
  private $pembayaranM;

  public function __construct()
  {
    $this->homepageModel = new HomepageModel;
    $this->produkM = new ProdukM();
    $this->pembelianM = new PembelianM();
    $this->pembelianProdukM = new PembelianProdukM();
    $this->pembayaranM = new PembayaranM();
  }

  // public function index()
  // {
  //   if ($this->request->getGet('cari')) {
  //     $produk = $this->produkM->like('nama_produk', $this->request->getGet('cari'), 'both')->findAll();
  //   } else {
  //     $produk = $this->produkM->findAll();
  //   }

  //   return view(
  //     'pelanggan/produk/data_produk',
  //     [
  //       'produk' => $produk,
  //       'pencarian' => $this->request->getGet('cari') ?? 'Produk'
  //     ]
  //   );
  // }

  public function pembelian()
  {
    $id_pelanggan = session()->get('pelanggan')['id_pelanggan'];
    $select = 'pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan';
    $join = ['table' => 'pelanggan', 'cond' => 'pembelian.id_pelanggan = pelanggan.id_pelanggan'];

    $belum_bayar = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'Belum Bayar',
    ])->find();

    $dibatalkan = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'Dibatalkan',
    ])->find();

    $dikemas = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'dikemas',
    ])->find();

    $dikirim = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'Dikirim',
    ])->find();

    $selesai = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'pelanggan.id_pelanggan' => $id_pelanggan,
      'status_pembelian' => 'Selesai',
    ])->find();

    return view(
      'pelanggan/pembelian/pembelian_view',
      [
        'belum_bayar' => $belum_bayar,
        'dibatalkan' => $dibatalkan,
        'dikemas' => $dikemas,
        'dikirim' => $dikirim,
        'selesai' => $selesai,
      ]
    );
  }

  public function detail_pembelian($id_pembelian)
  {
    $pembelian = $this->pembelianM->select('pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan')->join('pelanggan', 'pembelian.id_pelanggan = pelanggan.id_pelanggan')->find($id_pembelian);

    if ($pembelian['id_pelanggan'] != session()->get('pelanggan')['id_pelanggan']) {
      return redirect()->back();
    }

    $produk = $this->pembelianProdukM->join('produk', 'pembelian_produk.id_produk = produk.id_produk')->where('id_pembelian', $id_pembelian)->find();
    // $pembayaran = $this->db->query("SELECT * FROM pembayaran WHERE id_pembelian = '" . $pembelian['id_pembelian'] . "'");
    $pembayaran = $this->pembayaranM->where('id_pembelian', $id_pembelian)->first();
    return view(
      'pelanggan/pembelian/detail_pembelian_v',
      [
        'pembelian' => $pembelian,
        'produk' => $produk,
        'pembayaran' => $pembayaran,
      ]
    );
  }

  public function pembayaran_view($id_pembelian)
  {
    $pembelian = $this->pembelianM->find($id_pembelian);
    if ($pembelian == null || $pembelian['id_pelanggan'] != session('pelanggan')['id_pelanggan']) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("NOT FOUND");
    }
    return view(
      'pelanggan/pembelian/pembayaran_view',
      [
        'pembelian' => $pembelian,
      ]
    );
  }

  public function pembayaran_proses($id_pembelian)
  {
    $pembelian = $this->pembelianM->find($id_pembelian);
    if ($pembelian == null || $pembelian['id_pelanggan'] != session('pelanggan')['id_pelanggan']) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("NOT FOUND");
    }

    if (!$this->validate([
      'nama' => [
        'label' => 'Nama',
        'rules' => 'required|min_length[4]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'bank' => [
        'label' => 'Bank',
        'rules' => 'required|min_length[2]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 4 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],
      'jumlah' => [
        'label' => 'Jumlah',
        'rules' => 'required|min_length[2]|max_length[100]',
        'errors' => [
          'required' => '{field} Harus diisi',
          'min_length' => '{field} Minimal 2 Karakter',
          'max_length' => '{field} Maksimal 100 Karakter',
        ],
      ],

      'bukti' => [
        'label' => 'bukti',
        'rules' => 'uploaded[bukti]|mime_in[bukti,image/jpg,image/jpeg,image/png]|max_size[bukti,4096]',
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

      $bukti = $this->request->getFile('bukti');
      $newBukti = $bukti->getRandomName();

      $data = [
        'id_pembelian' => $post['id_pembelian'],

        'nama' => $post['nama'],
        'bank' => $post['bank'],
        'jumlah' => $post['jumlah'],
        'bukti' => $newBukti,
      ];

      if ($this->pembayaranM->save($data)) {
        $bukti->move('img/bukti/', $newBukti);
        $this->pembelianM->update(
          $id_pembelian,
          [
            'status_pembelian' => 'Dikemas',
          ]
        );
        return redirect()->to(base_url() . '/pembelian/' . $id_pembelian)->with('msg', myAlert('success', 'Pembayaran Berhasil'));
      }
    }
  }
}
