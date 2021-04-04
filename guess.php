<?php

//1. 短时间内增加10条病例数 1天之内
//2. 小范围内出现了多例病例
//3. 判断食物类型 食物是否有相似点

$status = 0;
// 创建连接
$conn = new mysqli('localhost', 'root', 'root', 'test');
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT * FROM patient where to_days(`create_time`) = to_days(now())";

$res = $conn->query($sql);

while($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
}

$patient_num = $res->num_rows;

for ($i = 0; $i < $patient_num; $i++) { 
    $arr = explode(",",$rows[$i]['address']);
    $sum = 0;
    for ($j = $i; $j < $patient_num; $j++){ 
        $arr2 = explode(",",$rows[$j]['address']);
        if (float($arr[0]) - float($arr2[0]) < 0.2 && float($arr[1]) - float($arr2[1]) < 0.2){
            $status = 1;
        }
    }
}


if ($patient_num > 5) {
    $status = 1;
}
// if ( $patient_num >= 2 ) {
//     echo  1;
// }
echo $patient_num;