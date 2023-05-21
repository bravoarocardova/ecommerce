<?php

namespace App\Models;

use CodeIgniter\Model;

class PromosiM extends Model
{
  protected $table      = 'promosi';
  protected $primaryKey = 'id_promosi';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['gambar', 'text', 'tipe_promosi'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
