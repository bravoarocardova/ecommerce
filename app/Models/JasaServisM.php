<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaServisM extends Model
{
  protected $table      = 'jasa_servis';
  protected $primaryKey = 'id_jasa_servis';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_jasa', 'biaya_jasa', 'kategori'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
