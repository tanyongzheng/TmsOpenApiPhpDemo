<?php

function BuildHttpRequestSinData($userId, $apiKey, $body)
        {
            if($body==null){
                $body="";
            }
            $appId = $userId."";
            date_default_timezone_set('PRC'); //设置时区
            $apiTime = date("Y-m-d H:i:s",time());
            $signStr = $appId.$apiTime.$body.$apiKey;
            $sign=md5($signStr);
            $headers = array(
                'appId:'.$appId,
                'time:'.$apiTime,
                'sign:'.$sign,
                'Content-Type:application/json'
            );
            return $headers;
        }