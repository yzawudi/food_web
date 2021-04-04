<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
        #allmap{width:100%;height:500px;}
        p{margin-left:5px; font-size:14px;}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ecPuaa12irjWNDXwweBya30E1DavUMmX"></script>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <title>给多个点添加信息窗口</title>
</head>
<body>
<div id="allmap"></div>
<p>点击标注点，可查看由纯文本构成的简单型信息窗口</p>
</body>
</html>
<script type="text/javascript">
    // 百度地图API功能
    map = new BMap.Map("allmap");
    // 百度坐标系坐标(地图中需要使用这个)
    var bPoints = new Array();
    //设置中心点
    map.centerAndZoom(new BMap.Point(126.54161509031663,45.808825827952187), 15);
    //后台数据
    <?php
            $conn = new mysqli('localhost', 'root', 'root', 'test');
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }
            $sql = 'SELECT * FROM patient';
            $result = $conn->query($sql);
            $arr = array();
            // 把结果集转换成数组赋值给$row,如果有数据为真
            $i = 0;
            while(!!$row = mysqli_fetch_array($result)){
                $data = explode(",",$row["address"]);
                $arr[$i][0] = floatval($data[1]);
                $arr[$i][1] = floatval($data[0]);
                $arr[$i][2] = $row["address2"];
                $i++;
            }
            mysqli_close($conn);
            $data = json_encode($arr);
            echo "var data_info =".$data;?>
    //信息窗口样式
    var opts = {
        width : 250,     // 信息窗口宽度
        height: 80,     // 信息窗口高度
        title : "<p style='color: red;'>信息窗口</p>" , // 信息窗口标题
        enableMessage:true//设置允许信息窗发送短息
    };
    addMarker(data_info);

    //创建标注点并添加到地图中
    function addMarker(data_info){
        //循环建立标注点
        for(var i=0;i<14;i++){

            var point = new BMap.Point(data_info[i][0],data_info[i][1]); //将标注点转化成地图上的点
            bPoints.push(point); // 添加到百度坐标数组 用于自动调整缩放级别
            var marker = new BMap.Marker(point);  // 创建标注
            var content = data_info[i][2];
            map.addOverlay(marker);               // 将标注添加到地图中
            addClickHandler(content,marker);
        }
    }

    function addClickHandler(content,marker){
        marker.addEventListener("click",function(e){
            openInfo(content,e)}
        );
    }
    function openInfo(content,e){
        var p = e.target;
        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
        var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象
        map.openInfoWindow(infoWindow,point); //开启信息窗口
    }
    // 根据点的数组自动调整缩放级别
    function setZoom(bPoints) {
        var view = map.getViewport(eval(bPoints));
        var mapZoom = view.zoom;
        var centerPoint = view.center;
        map.centerAndZoom(centerPoint, mapZoom);
    }
    map.addControl(new BMap.MapTypeControl());
    map.enableScrollWheelZoom(true);
    setTimeout(function () {
        setZoom(bPoints);
    }, 1000)
</script>