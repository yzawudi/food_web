<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $create_time = date('Y-m-d h:i:s', time());
    if(!$username and !$password and !$email){
        echo "Error: There is no data passed.";
        exit;
    }
    if(!$username or !$password or !$email){
        echo "Error: Some data did not be passed.";
        exit;
    }
    // 创建连接
    $conn = new mysqli('localhost', 'root', 'root', 'test');
    // Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $q = "INSERT INTO user (`username`, `password`, `email`, `create_time`) VALUES ('$username', '$password', '$email', '$create_time')";
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