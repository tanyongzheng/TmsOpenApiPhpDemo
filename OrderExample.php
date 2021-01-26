<?php
require "SignHelper.php";
require "ApiConfig.php";

function CheckAddress(){
    global  $base_url ,$user_id,$api_key;

    $params = array();
    $params['ToName'] = "Mr Lee";
    $params['ToCompany'] = "";
    $params['ToCountryCode'] = "US";
    $params['ToAddress1'] = "6859 Del Mar Terrace";
    $params['ToAddress2'] = "";
    $params['ToProvince'] = "FL";
    $params['ToCity'] = "Naples";
    $params['ToPostCode'] = "34105";
    $params['ToContact'] = "13800138000";
    $params['ChannelCode'] = "USPSABC1";

    $params_json = json_encode($params);

    $headers=BuildHttpRequestSinData($user_id,$api_key,$params_json);
    $ch =curl_init($base_url."Order/CheckAddress");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $curl_rs = curl_exec($ch);
    var_dump($curl_rs);
    $curl_rs_arr = json_decode($curl_rs, true);

    $success = $curl_rs_arr['success'];
    $msg = $curl_rs_arr['msg'];

    if($success){
        echo '地址正确';
    }else{
        echo $msg;
    }

}


function CreateOrder(){
    global  $base_url ,$user_id,$api_key;

    $params_json = '{
  "UserId": 0,
  "ReferCode": "Test123456789",
  "ChannelCode": "USPSABC1",
  "Weight": 0.345,
  "ToCountryName": "US",
  "ToPostCode": "34105",
  "ToName": "Mr Lee",
  "ToAddress1": "6859 Del Mar Terrace",
  "ToAddress2": "",
  "ToProvince": "FL",
  "ToCity": "Naples",
  "ToCompany": "Test Company",
  "ToContact": "13800138000",
  "IsSecure": 0,
  "IsSign": 0,
  "IsSignatureRequired": 0,
  "IsReject": 0,
  "IsBatery": 0,
  "OverseaWarehouseCode":"LAX",
  "OrderPackages": [
    {
      "Length": 2,
      "Width": 3,
      "Height": 4,
      "Weight": 0.345,
      "ParcelCode": "A11111111111",
      "Count": 1,
      "OrderDetails": [
        {
          "ReferNo": "SKU001",
          "CnDesc": "\u5305\u5305",
          "EnDesc": "bag",
          "CustomcCode": "1111111111",
          "SalesPrice": 0.123,
          "ProductCount": 1,
          "ProductWeight": 0.02
        },
        {
          "ReferNo": "SKU002",
          "CnDesc": "\u624B\u673A\u58F3",
          "EnDesc": "phone cell",
          "CustomcCode": "2222222222",
          "SalesPrice": 0.234,
          "ProductCount": 1,
          "ProductWeight": 0.03
        }
      ]
    }
  ]
}';

    $headers=BuildHttpRequestSinData($user_id,$api_key,$params_json);
    $ch =curl_init($base_url."Order/CreateOrder");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $curl_rs = curl_exec($ch);
    var_dump($curl_rs);
    $curl_rs_arr = json_decode($curl_rs, true);

    $status = $curl_rs_arr['Status'];
    $track_no = $curl_rs_arr['TrackNo'];
    $OrderCode= $curl_rs_arr['OrderCode'];
    $ReferCode = $curl_rs_arr['ReferCode'];

    if($status== 'success'){
        echo '<br/>创建成功！<br/>';
        echo 'OrderCode:'.$OrderCode.'<br/>';
        echo 'TrackNo:'.$track_no.'<br/>';
    }

}