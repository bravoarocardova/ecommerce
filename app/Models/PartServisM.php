<?php

namespace App\Models;

use CodeIgniter\Model;

class PartServisM extends Model
{
  protected $table      = 'part_servis';
  // protected $primaryKey = 'id_jasa_servis';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['kd_barang_servis', 'id_part_produk', 'biaya_part_servis'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
