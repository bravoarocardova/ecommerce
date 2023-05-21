<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingM extends Model
{
  protected $table      = 'setting';
  protected $primaryKey = 'id_setting';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_aplikasi', 'alamat', 'telepon', 'email', 'lokasi'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
