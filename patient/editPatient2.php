<?php


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

$patient_no = $_POST['patient_no'];
$name =  json_decode(sprintf('"%s"',$_POST['patient_name']));
$onset_time = $_POST['onset_time'];
$treatment_time = $_POST['treatment_time'];
$antibiotic = $_POST['antibiotic'];
$hospitalized = json_decode(sprintf('"%s"',$_POST['hospitalized']));
$gender = json_decode(sprintf('"%s"',$_POST['gender']));
$id_card = $_POST['id_card'];
$phone = $_POST['phone'];
//$province = $_POST['province'];
$address = $_POST['address'];
$doctor = json_decode(sprintf('"%s"',$_POST['doctor']));
$diagnosis = json_decode(sprintf('"%s"',$_POST['diagnosis']));
$symptom = json_decode(sprintf('"%s"',$_POST['symptom']));
$digestive = json_decode(sprintf('"%s"',$_POST['digestive']));
$respiratory = json_decode(sprintf('"%s"',$_POST['respiratory']));
$cardiovascular = json_decode(sprintf('"%s"',$_POST['cardiovascular']));
$urinary = json_decode(sprintf('"%s"',$_POST['urinary']));
$nervous = json_decode(sprintf('"%s"',$_POST['nervous']));
$skin = json_decode(sprintf('"%s"',$_POST['skin']));

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
$q = "UPDATE `test`.`patient` SET `patient_no` = '$patient_no', `onset_time` = '$onset_time', `treatment_time` = '$treatment_time', 
`antibiotic` = '$antibiotic', `id_card` = '$id_card', `phone`='$phone', `address`= '$address', `doctor` = '$doctor', `diagnosis` = '$diagnosis', `symptom` = '$symptom', 
`digestive` = '$digestive', `respiratory` = '$respiratory', `cardiovascular` = '$cardiovascular', `urinary` = '$urinary', `nervous` = '$nervous', `skin` = '$skin',
 `name` = '$name', `hospitalized` = '$hospitalized', `gender` = '$gender', `create_time` ='$create_time', `address2` = '$address2' WHERE `patient_no` = '$patient_no'";
if ($conn->query($q) === TRUE) {
    $res['code'] = '200';
    $res['status'] = 'success';
    $res['msg'] = '插入成功';
    echo json_encode($res);
} else {
    $res['code'] = '400';
    $res['status'] = 'success';
    $res['msg'] = "Error: " . $q . "<br>" . $conn->error;
    echo json_encode($res);
}
mysqli_close($conn);
?>