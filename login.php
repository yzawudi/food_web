<?php
/*开启会话*/
//session_start();
$data=$_POST;
/*获取登录表单提交过来的数据*/
$user=$data['Username'];
$pwd=$data['Password'];
// 创建连接
$conn = new mysqli('localhost', 'root', 'root', 'test');
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "select * from `user` where username='$user' and password='$pwd'";

$result = $conn->query($sql);

/*如果数据存在，即用户登录成功*/
if ($result) {
    /*将用户名和昵称存在服务器，可以多个页面使用*/
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username'];
    // 判断是否正确
    $res['code'] = '200';
    $res['status'] = 'success';
    $res['msg'] = 'ok';
    echo json_encode($res);
}else{/*用户名或密码错误*/
    $res['code'] = '400';
    $res['status'] = 'error';
    $res['msg'] = '用户名或密码错误';
    echo json_encode($res);
}