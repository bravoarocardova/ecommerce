<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\PdfGenerator;
use App\Models\DataServisM;
use App\Models\PembelianM;

class Laporan extends BaseController
{
  public function penjualan()
  {
    if ($this->request->is('post')) {
      $dataPembelian = new PembelianM();
      $pdfGenerator = new PdfGenerator();

      $post = $this->request->getVar();
      $tanggal = $post['tanggal'];
      $pecahTanggal = explode(' - ', $tanggal);
      $tglMulai = date('Y-m-d', strtotime($pecahTanggal[0]));
      $tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));

      $filename = 'Laporan_penjualan_' . $tglMulai . '_' . $tglAkhir;

      $data = [
        'title' => $filename,
        'tgl' => $tanggal,
        'penjualan' => $dataPembelian->select('pembelian.*, pelanggan.nama_pelanggan')
          ->join('pelanggan', 'pembelian.id_pelanggan = pelanggan.id_pelanggan')
          ->where('status_pembelian = "Dibatalkan" AND DATE(pembelian.created_at) BETWEEN "' . $tglMulai . '" AND "' . $tglAkhir . '"')->findAll(),
      ];

      $html = view('admin/laporan/laporan_penjualan_pdf', $data);

      return $pdfGenerator->generate($html, $filename, 'A4', 'portrait');
    }
    return view('admin/laporan/laporan_penjualan_view');
  }

  public function servis()
  {
    if ($this->request->is('post')) {
      $dataServis = new DataServisM();
      $pdfGenerator = new PdfGenerator();

      $post = $this->request->getVar();
      $tanggal = $post['tanggal'];
      $pecahTanggal = explode(' - ', $tanggal);
      $tglMulai = date('Y-m-d', strtotime($pecahTanggal[0]));
      $tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));

      $filename = 'Laporan_servis_' . $tglMulai . '_' . $tglAkhir;

      $data = [
        'title' => $filename,
        'tgl' => $tanggal,
        'servis' => $dataServis->where('status = "selesai" AND DATE(created_at) BETWEEN "' . $tglMulai . '" AND "' . $tglAkhir . '"')->findAll(),
      ];

      $html = view('admin/laporan/laporan_servis_pdf', $data);

      return $pdfGenerator->generate($html, $filename, 'A4', 'portrait');
    }
    return view('admin/laporan/laporan_servis_view');
  }
}
