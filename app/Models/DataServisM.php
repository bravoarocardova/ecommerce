<?php

namespace App\Models;

use CodeIgniter\Model;

class DataServisM extends Model
{
  protected $table      = 'data_servis';
  protected $primaryKey = 'no_transaksi';

  protected $useAutoIncrement = false;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_pelanggan', 'alamat_pelanggan', 'no_telp_pelanggan', 'status'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';
}
