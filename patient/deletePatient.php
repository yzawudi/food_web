<?php
    $no = $_POST['no'];
    // 创建连接
    $conn = new mysqli('localhost', 'root', 'root', 'test');
    // Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $q = "SELECT * FROM `patient` WHERE patient_no = $no";
    if ($conn->query($q) == TRUE) {
        $sql = "DELETE FROM `patient` WHERE patient_no = $no";
        if ($conn->query($sql) == TRUE){
            $res['code'] = '200';
            $res['status'] = 'success';
            $res['msg'] = '插入成功';
            echo json_encode($res);
        }else{
            $res['code'] = '400';
            $res['status'] = 'success';
            $res['msg'] = "Error: " . $sql . "<br>" . $conn->error;
            echo json_encode($res);
        }
    } else {
        $res['code'] = '400';
        $res['status'] = 'success';
        $res['msg'] = "不存在记录";
        echo json_encode($res);
    }
