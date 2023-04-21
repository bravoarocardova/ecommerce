<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganM extends Model
{
  protected $table      = 'pelanggan';
  protected $primaryKey = 'id_pelanggan';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['username_pelanggan', 'nama_pelanggan', 'email_pelanggan', 'telepon_pelanggan', 'password', 'foto_pelanggan', 'is_active'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
