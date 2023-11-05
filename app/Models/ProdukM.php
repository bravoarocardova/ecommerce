<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukM extends Model
{
  protected $table      = 'produk';
  protected $primaryKey = 'id_produk';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';

  protected $allowedFields = ['nama_produk', 'harga_produk', 'foto_produk', 'kondisi_produk', 'deskripsi_produk', 'stok_produk', 'berat_produk', 'garansi', 'diskon', 'warna'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
