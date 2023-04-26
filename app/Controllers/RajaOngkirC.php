<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\RajaOngkir;

class RajaOngkirC extends BaseController
{

  private $ro;

  public function __construct()
  {
    $this->ro = new RajaOngkir();
  }

  public function getCity()
  {
    if ($this->request->isAjax()) {
      $province_id = $this->request->getGet('province_id');
      $data = $this->ro->rajaongkir('city', $province_id);
      return $this->response->setJSON($data);
    }
  }

  public function getCost()
  {
    if ($this->request->isAjax()) {
      $get = $this->request->getGet();

      $origin = $get['origin'];
      $destination = $get['destination'];
      $weight = $get['weight'];
      $courier = $get['courier'];

      $data = $this->ro->rajaongkircost($origin, $destination, $weight, $courier);
      return $this->response->setJSON($data);
    }
  }
}
