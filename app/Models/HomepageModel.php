<?php

namespace App\Models;

class HomepageModel
{
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
