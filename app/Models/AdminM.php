<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminM extends Model
{
  protected $table      = 'admin';
  protected $primaryKey = 'id_admin';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['username', 'nama', 'email', 'no_telp', 'password', 'foto', 'role', 'is_active'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
