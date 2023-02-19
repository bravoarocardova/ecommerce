<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangServisM extends Model
{
  protected $table      = 'barang_servis';
  protected $primaryKey = 'kd_barang_servis';

  protected $useAutoIncrement = false;

  protected $returnType     = 'array';

  protected $allowedFields = ['no_transaksi', 'nama_barang_servis', 'kelengkapan', 'kerusakan', 'jumlah'];
}
