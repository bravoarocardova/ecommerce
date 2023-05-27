<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembayaranM;
use App\Models\PembelianM;
use App\Models\PembelianProdukM;
use App\Models\ProdukM;

class Penjualan extends BaseController
{

  private $produkM;
  private $pembelianM;
  private $pembelianProdukM;
  private $pembayaranM;

  public function __construct()
  {
    $this->produkM = new ProdukM();
    $this->pembelianM = new PembelianM();
    $this->pembelianProdukM = new PembelianProdukM();
    $this->pembayaranM = new PembayaranM();
  }

  public function index()
  {
    $select = 'pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan';
    $join = ['table' => 'pelanggan', 'cond' => 'pembelian.id_pelanggan = pelanggan.id_pelanggan'];

    $dikemas = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Dikemas',
    ])->find();

    $dikirim = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Dikirim',
    ])->find();

    $selesai = $this->pembelianM->select($select)->join($join['table'], $join['cond'])->where([
      'status_pembelian' => 'Selesai',
    ])->find();
    return view(
      'admin/penjualan/data_penjualan_view',
      [
        'dikemas' => $dikemas,
        'dikirim' => $dikirim,
        'selesai' => $selesai,
      ]
    );
  }

  public function detail_penjualan($id_pembelian)
  {
    if ($this->request->is('put')) {
      $post = $this->request->getPost();
      if (!$this->validate([
        'no_resi' => [
          'label' => 'No Resi',
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

        $data = [
          'id_pembelian' => $id_pembelian,
          'no_resi' => $post['no_resi'],
          'status_pembelian' => 'Dikirim',
          'id_admin' => session()->get('admin')['id_admin'],
        ];
        $this->pembelianM->save($data);
        return redirect()->back()->with('msg', myAlert('success', 'Berhasil Update Resi.'));
      }
    }

    if ($this->request->is('post')) {
      $data = [
        'id_pembelian' => $id_pembelian,
        'status_pembelian' => 'Selesai',
      ];
      $this->pembelianM->save($data);
      return redirect()->back()->with('msg', myAlert('success', 'Berhasil Update data.'));
    }

    $pembelian = $this->pembelianM
      ->select('pembelian.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan, admin.nama as nama_admin')
      ->join('pelanggan', 'pembelian.id_pelanggan = pelanggan.id_pelanggan')
      ->join('admin', 'pembelian.id_admin = admin.id_admin', 'LEFT')
      ->find($id_pembelian);

    $produk = $this->pembelianProdukM->join('produk', 'pembelian_produk.id_produk = produk.id_produk')->where('id_pembelian', $id_pembelian)->find();

    $pembayaran = $this->pembayaranM->where('id_pembelian', $id_pembelian)->first();
    return view(
      'admin/penjualan/detail_penjualan_v',
      [
        'pembelian' => $pembelian,
        'produk' => $produk,
        'pembayaran' => $pembayaran,
      ]
    );
  }
}
