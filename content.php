<?php
    // 创建连接
    $conn = new mysqli('localhost', 'root', 'root', 'test');
    // Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $time = date("Y-m-d");
    echo  $time;