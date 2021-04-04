<?php

function decodeUnicode($str){
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function($matches){return iconv("UCS-2BE","UTF-8",pack("H*", $matches[1]));}, $str);
}

function getLatLng($address)
{
    $result = array();
    $url = 'http://api.map.baidu.com/geocoding/v3/?address='.$address.'&output=json&ak=ecPuaa12irjWNDXwweBya30E1DavUMmX&callback=showLocation';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);  //设置访问的url地址
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
    $data =  curl_exec($ch);
    $data = str_replace('showLocation&&showLocation(', '', $data);
    $data = str_replace(')', '', $data);
    $data = json_decode($data,true);
    if (!empty($data) && $data['status'] == 0) {
        $result['lat'] = $data['result']['location']['lat'];
        $result['lng'] = $data['result']['location']['lng'];
        return $result;//返回经纬度结果
    }else{
        return null;
    }
}
//患者表
$patient_no = $_POST['patient_no'];
$name =  decodeUnicode($_POST['patient_name']);
$onset_time = $_POST['onset_time'];
$treatment_time = $_POST['treatment_time'];
$antibiotic = $_POST['antibiotic'];
$hospitalized = json_decode(sprintf('"%s"',$_POST['hospitalized']));
$gender = json_decode(sprintf('"%s"',$_POST['gender']));
$id_card = $_POST['id_card'];
$phone = $_POST['phone'];
$province = $_POST['province'];
$address = $_POST['address'];
$address = decodeUnicode($province . "" . $address);
$doctor = decodeUnicode($_POST['doctor']);
$diagnosis = json_decode(sprintf('"%s"',$_POST['diagnosis']));
$symptom = json_decode(sprintf('"%s"',$_POST['symptom']));
$digestive = json_decode(sprintf('"%s"',$_POST['digestive']));
$respiratory = json_decode(sprintf('"%s"',$_POST['respiratory']));
$cardiovascular = json_decode(sprintf('"%s"',$_POST['cardiovascular']));
$urinary = json_decode(sprintf('"%s"',$_POST['urinary']));
$nervousr = json_decode(sprintf('"%s"',$_POST['nervous']));
$skin = json_decode(sprintf('"%s"',$_POST['skin']));

//食品表
$food_name = json_decode(sprintf('"%s"',$_POST['food_name']));
$food_sort = json_decode(sprintf('"%s"',$_POST['food_sort']));
$food_pack = json_decode(sprintf('"%s"',$_POST['food_pack']));
$food_brand = json_decode(sprintf('"%s"',$_POST['food_brand']));
$manufacturer = json_decode(sprintf('"%s"',$_POST['manufacturer']));
$food_address = json_decode(sprintf('"%s"',$_POST['food_address']));
$food_content = json_decode(sprintf('"%s"',$_POST['food_content']));

//标本表
$specimen_sort = json_decode(sprintf('"%s"',$_POST['specimen_sort']));
$specimen_number = json_decode(sprintf('"%s"',$_POST['specimen_number']));
$specimen_count = json_decode(sprintf('"%s"',$_POST['specimen_count']));
$specimen_content = json_decode(sprintf('"%s"',$_POST['specimen_content']));

$data = getLatLng($address);
$address2 = $address;
$address = $data['lat'] . ',' . $data['lng'];

$create_time = date('Y-m-d h:i:s', time());
if(!$patient_no and !$name and !$id_card){
    echo "Error: There is no data passed.";
    exit;
}
// 创建连接
$conn = new mysqli('localhost', 'root', 'root', 'test');
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$q = "INSERT INTO `test`.`patient`( `patient_no`, `onset_time`, `treatment_time`, `antibiotic`, `id_card`, `phone`, `address`, `doctor`, `diagnosis`, `symptom`, 
`digestive`, `respiratory`, `cardiovascular`, `urinary`, `nervous`, `skin`, `name`, `hospitalized`, `gender`, `create_time`,`address2`)
 VALUES ( '$patient_no', '$onset_time', '$treatment_time', $antibiotic, '$id_card', $phone, '$address', '$doctor', '$diagnosis', '$symptom', '$digestive', '$respiratory', '$cardiovascular', '$urinary', '$nervousr', '$skin', '$name', '$hospitalized', '$gender', '$create_time','$address2');
";
$res = $conn->query($q);
$pid = mysqli_insert_id($conn);

$q2 = "INSERT INTO `test`.`food`(`food_name`, `food_sort`, `food_pack`, `food_brand`, `manufacturer`, `food_address`, `food_content`, `create_time`, `pid`) 
VALUES ('$food_name', '$food_sort', '$food_pack', '$food_brand', '$manufacturer', '$food_address', '$food_content', '$create_time', '$pid')";
$res2 = $conn->query($q2);

if ($res2 == false) {
    echo "q2 insert false";
}

$q3 = "INSERT INTO `specimen` (`specimen_sort`, `specimen_number`, `specimen_count`, `specimen_content`, `create_time`, `pid`)
VALUES ( '$specimen_sort', '$specimen_number', '$specimen_count', '$specimen_content', '$create_time', '$pid')";

$res3 = $conn->query($q3);
if ($res3 == false) {
    echo "q3 insert false";
}

if ($res === TRUE) {
    $resx['code'] = '200';
    $resx['status'] = 'success';
    $resx['msg'] = '插入成功';
    echo json_encode($resx);
} else {
    $resx['code'] = '400';
    $resx['status'] = 'success';
    $resx['msg'] = "Error: " . $q . "<br>" . $conn->error;
    echo json_encode($resx);
}
$oid = mysqli_insert_id($conn);
mysqli_close($conn);
?>