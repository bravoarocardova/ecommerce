<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianM extends Model
{
  protected $table      = 'pembelian';
  protected $primaryKey = 'id_pembelian';

  protected $useAutoIncrement = false;

  protected $returnType     = 'array';

  protected $allowedFields = ['id_pelanggan', 'tujuan', 'ekspedisi', 'total_berat', 'ongkir',  'total_pembelian', 'status_pembelian', 'no_resi', 'id_admin'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
