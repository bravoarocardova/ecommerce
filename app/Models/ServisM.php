<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisM extends Model
{
  protected $table      = 'servis';
  // protected $primaryKey = 'id_jasa_servis';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['kd_barang_servis', 'id_jasa_servis', 'biaya_servis'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
