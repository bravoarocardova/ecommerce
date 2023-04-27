<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianProdukM extends Model
{
  protected $table      = 'pembelian_produk';
  protected $primaryKey = 'id_pembelian_produk';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['id_pembelian', 'id_produk', 'jumlah', 'subtotal'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
