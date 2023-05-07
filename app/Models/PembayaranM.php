<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranM extends Model
{
  protected $table      = 'pembayaran';
  protected $primaryKey = 'id_pembayaran';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = [
    'id_pelanggan', 'id_pembelian',  'nama',  'bank',  'jumlah',  'bukti',  'created_at',  'updated_at'
  ];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
