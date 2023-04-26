<?php

namespace App\Libraries;

class RajaOngkir
{

  private $url = "https://api.rajaongkir.com/starter/";
  private $apiKey = "007fd77a5f5e694d6bc9a347b13c64f2";
  public static $origin = 156; // origin = {province_id jambi : 156}

  public function rajaongkir($method, $id_province = null)
  {

    $endPoint = $this->url . $method;

    if ($id_province != null) {
      $endPoint = $endPoint . "?province=" . $id_province;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $endPoint,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: " . $this->apiKey
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
  }


  public function rajaongkircost($origin, $destination, $weight, $courier)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->url . "cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: " . $this->apiKey,
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    return $response;
  }
}
