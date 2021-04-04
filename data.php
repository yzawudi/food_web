<?php
    $conn = new mysqli('localhost', 'root', 'root', 'test');
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM patient where to_days(`create_time`) = to_days(now())";
    $result = $conn->query($sql);
    $res[0] = $result->num_rows;
    $sql2 = "SELECT * FROM patient where TO_DAYS(`create_time`) = TO_DAYS(NOW()) - 1";
    $result2 = $conn->query($sql2);
    $res[1] = $result2->num_rows;
    $sql3 = "select * from `patient` where date_sub(curdate(), INTERVAL 7 DAY) <= date(`create_time`)";
    $result3 = $conn->query($sql3);
    $res[2] = $result3->num_rows;
    $sql4 = "select * from `patient` where date_sub(curdate(), INTERVAL 30 DAY) <= date(`create_time`)";
    $result4 = $conn->query($sql4);
    $res[3] = $result4->num_rows;
    $sql5 = "select * from `patient` where date_sub(curdate(), INTERVAL 7 DAY) <= date(`create_time`)";
    $result5 = $conn->query($sql5);
    $res[4] = $result5->num_rows;
    $date = ['今天', '昨天', '近7天', '本月','今年'];
    $data['data'] = $res;
    $data['categories'] = $date;

    echo json_encode($data);