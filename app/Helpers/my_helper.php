<?php

use App\Models\DataServisM;
use CodeIgniter\Model;

/**
 * helper buat alert session
 * 
 * @param string $type classname
 * @param string $msg
 * @return html alert
 */
function myAlert($type, $msg)
{
  return "<div class='alert alert-$type' role='alert'>
      $msg
    </div>";
}

/**
 * helper buat no_transaksi
 * 
 * @param string $kode
 * @param Model $model
 * @param int $offset field - $kode
 * @return string 
 */
function createNoTransaksi($kode, Model $model, $field, $offset = 3)
{
  $lastKode = $model->selectMax($field)->first();
  $lastKode = (int) substr($lastKode[$field], $offset);
  $lastKode++;
  return $kode . sprintf("%08s", $lastKode);
}
