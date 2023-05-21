<?php

namespace App\Models;

use CodeIgniter\Model;

class PartProdukM extends Model
{
  protected $table      = 'part_produk';
  protected $primaryKey = 'id_part_produk';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_part', 'biaya_part', 'kategori'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
