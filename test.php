<?php

    $url = 'http://api.map.baidu.com/geocoding/v3/?address='."哈尔滨师范大学".'&output=json&ak=ecPuaa12irjWNDXwweBya30E1DavUMmX&callback=showLocation';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);  //设置访问的url地址
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
    $data =  curl_exec($ch);
    $data = str_replace('showLocation&&showLocation(', '', $data);
    $data = str_replace(')', '', $data);
    $data = json_decode($data,true);
    $result['lat'] = $data['result']['location']['lat'];
    $result['lng'] = $data['result']['location']['lng'];
    var_dump($result);
    die();
//    if (!empty($data) && $data['status'] == 0) {
//        $result['lat'] = $data['result']['location']['lat'];
//        $result['lng'] = $data['result']['location']['lng'];
//        return $result;//返回经纬度结果
//    }else{
//        return null;
//    }
