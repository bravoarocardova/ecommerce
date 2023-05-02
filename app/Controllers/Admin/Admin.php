<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianM;
use App\Models\DataServisM;
use App\Models\PembelianProdukM;

class Admin extends BaseController
{

  private $pembelianM;
  private $dataServisM;
  private $pembelianProdukM;

  public function __construct()
  {
    $this->pembelianM = new PembelianM();
    $this->dataServisM  = new DataServisM();
    $this->pembelianProdukM = new PembelianProdukM();
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
}
