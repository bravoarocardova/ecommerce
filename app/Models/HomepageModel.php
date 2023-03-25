<?php

namespace App\Models;

class HomepageModel
{

  public function getBanner()
  {
    $data = [
      [
        'id_banner' => '1',
        'tanggal' => '2021-11-12',
        'banner' => 'product-1-min.jpg'
      ],
      [
        'id_banner' => '2',
        'tanggal' => '2021-11-12',
        'banner' => 'product-2-min.jpg'
      ],
      [
        'id_banner' => '3',
        'tanggal' => '2021-11-12',
        'banner' => 'product-3-min.jpg'
      ]
    ];

    $data = json_encode($data);
    $data = json_decode($data);
    return $data;
  }

  public function getInfo()
  {
    $data = [
      'id' => '1',
      'judul' => 'KEUNTUNGAN MEMBELI DI SMARTCOMP STORE',
      'slogan' => 'KEPUASAN KONSUMEN adalah prioritas utama kami, didukung team yang mumpuni, mesin yang terdepan di bidangnya dan service yang selalu update, menjadikan Angkasa Putra solusi terdepan untuk mempercayakan dokumen anda.',
      'alamat' => 'Jl. RB Siagian, Kec Pal Merah. Sari, Kec. Kota Jambi,',
      'kontak' => '6282372233'
    ];
    $data = json_encode($data);
    $data = json_decode($data);
    return $data;
  }

  public function getHari()
  {
    $data = [
      [
        'id' => '1',
        'hari' => 'Senin',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '2',
        'hari' => 'Selasa',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '3',
        'hari' => 'Rabu',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '4',
        'hari' => 'Kamis',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '5',
        'hari' => 'Jumat',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '6',
        'hari' => 'Sabtu',
        'jam' => '09.00 - 17.00'
      ],
      [
        'id' => '7',
        'hari' => 'Minggu',
        'jam' => 'Tutup'
      ]
    ];

    $data = json_encode($data);
    $data = json_decode($data);
    return $data;
  }
}
