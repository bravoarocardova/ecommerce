<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasokM extends Model
{
  protected $table      = 'pemasok';
  protected $primaryKey = 'id_pemasok';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_pemasok',  'harga_beli',  'jumlah_beli', 'id_produk', 'total'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
