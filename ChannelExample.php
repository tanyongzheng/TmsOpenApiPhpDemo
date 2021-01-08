<?php
  require "SignHelper.php";
  require "ApiConfig.php";

  function GetAllChannel(){
      global  $base_url ,$user_id,$api_key;
      $headers=BuildHttpRequestSinData($user_id,$api_key,null);
      $ch =curl_init($base_url."Channel/GetAll");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $curl_rs = curl_exec($ch);
      $curl_rs_arr = json_decode($curl_rs, true);
      //print_r($curl_rs_arr);
      echo json_encode($curl_rs_arr);
  }
